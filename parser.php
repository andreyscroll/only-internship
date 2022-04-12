<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("parser");
?>

<?php
use \Bitrix\Main\Loader;

class VacanciesCsvImporter
{
	private $iBlockId;
	private $csvFilepath;
	private $data = [];
	private $arProps = [];
	private $arImport = [];
	private $el;
	
	/**
	* Конструктор 
	* Подключаем модуль iblock
	* Устанавливаем путь к csv файлу
	*
	*/
	public function __construct(string $path)
	{
		if(!Loader::includeModule('iblock')){
			ShowError("Модуль Информационных блоков не установлен");
			return;
		}
	
		if(pathinfo($path)['extension'] === 'csv'){
			$this->csvFilepath = $path;
		} else {
			ShowError("Файл импорта должен быть в формате csv");
		}

		$this->el = new CIBlockElement;
	}
	
	/**
	* Загрузка свойств инфоблока типа "Список" (Enum)
	*
	*/
	private function loadPropertiesEnum()
	{
		$rsProp = CIBlockPropertyEnum::GetList(
			["SORT" => "ASC", "VALUE" => "ASC"],
			['IBLOCK_ID' => $this->iBlockId]
		);
		while ($arProp = $rsProp->Fetch()) {
			$key = trim($arProp['VALUE']);
			$this->arProps[$arProp['PROPERTY_CODE']][$key] = $arProp['ID'];
		}

		if(isset($this->arProps)){
			return true;
		}
	}
	
	/**
	* Парсинг CSV файла в массив $PROP
	*
	*/
	private function parseCsv()
	{
		$row = 1;
		$csv = fopen($this->csvFilepath, "r");
		if($csv)
		{
			while (($data = fgetcsv($csv, 1000, ",")) !== false)
			{
				if ($row == 1) {
					$row++;
					continue;
				}
				$row++;
				
				$PROP['ACTIVITY'] = $data[9];
				$PROP['FIELD'] = $data[11];
				$PROP['OFFICE'] = $data[1];
				$PROP['LOCATION'] = $data[2];
				$PROP['REQUIRE'] = $data[4];
				$PROP['DUTY'] = $data[5];
				$PROP['CONDITIONS'] = $data[6];
				$PROP['EMAIL'] = $data[12];
				$PROP['DATE'] = date('d.m.Y');
				$PROP['TYPE'] = $data[8];
				$PROP['SALARY_TYPE'] = '';
				$PROP['SALARY_VALUE'] = $data[7];
				$PROP['SCHEDULE'] = $data[10];


				if ($PROP['SALARY_VALUE'] == '-') {
				    $PROP['SALARY_VALUE'] = '';
				} elseif ($PROP['SALARY_VALUE'] == 'по договоренности') {
				    $PROP['SALARY_VALUE'] = '';
				    $PROP['SALARY_TYPE'] = $this->arProps['SALARY_TYPE']['договорная'];
				} else {
				    $arSalary = explode(' ', $PROP['SALARY_VALUE']);
				    if ($arSalary[0] == 'от' || $arSalary[0] == 'до') {
					$PROP['SALARY_TYPE'] = $this->arProps['SALARY_TYPE'][$arSalary[0]];
					array_splice($arSalary, 0, 1);
					$PROP['SALARY_VALUE'] = implode(' ', $arSalary);
				    } else {
					$PROP['SALARY_TYPE'] = $this->arProps['SALARY_TYPE']['='];
				    }
				}
				
				
				$temp =[];
				$temp['NAME'] = $data[3];
				$temp['PROP'] = $PROP;

				$this->data[] = $temp;
			}


			
			fclose($csv);

			return true;
		}
		
	}
	
	/**
	* Составление массива для импорта
	*
	*/
	private function buildArImport()
	{
		for($i = 0; $i < count($this->data); $i++)
		{
			foreach ($this->data[$i]['PROP'] as $key => &$value)
			{
	            $value = $this->formatValue($value);

	            if ($this->arProps[$key])
	            {
	                foreach ($this->arProps[$key] as $propKey => $propVal)
	                {
	                    // if ($key == 'OFFICE') {
	                    //     $value = strtolower($value);
	                    //     if ($value == 'центральный офис') {
	                    //         $value .= 'свеза ' . $data[2];
	                    //     } elseif ($value == 'лесозаготовка') {
	                    //         $value = 'свеза ресурс ' . $value;
	                    //     } elseif ($value == 'свеза тюмень') {
	                    //         $value = 'свеза тюмени';
	                    //     }
	                    //     $arSimilar[similar_text($value, $propKey)] = $propVal;
	                    // }

	                    if (stripos($propKey, $value) !== false) {
	                        $value = $propVal;
	                        break;
	                    }

	                    if (similar_text($propKey, $value) > 50) {
	                        $value = $propVal;
	                    }
	                }

	                // if ($key == 'OFFICE' && !is_numeric($value)) {
	                //     ksort($arSimilar);
	                //     $value = array_pop($arSimilar);
	                // }
	            }
	        }
	        $this->arImport[] = $this->data[$i];
		}

		//$this->arImport = $this->data;
			
	}
	
	/**
	* Запуск импорта
	*
	*/
	public function run()
	{
		if(!$this->parseCsv()){
			echo 'Ошибка парсинга CSV файла';
		}
		
		if(!$this->loadPropertiesEnum()){
			echo 'Ошибка загрузки свойств ифоблока типа "Список"';
		}

		$this->buildArImport();

		$this->import();
	}
	
	/**
	* Установка ID инфоблока
	*
	*/
	public function setIBlockId(int $id)
	{
		$this->iBlockId = $id;
	}
	
	/**
	* Удаление элементов инфоблока перед импортом новых элементов
	*
	*/
	public function deleteElements()
	{
		$rsElements = CIBlockElement::GetList([], ['IBLOCK_ID' => $this->iBlockId], false, false, ['ID']);
		while ($element = $rsElements->GetNext())
		{
			CIBlockElement::Delete($element['ID']);
		}
	}

	private function formatValue($value)
	{
		$value = trim($value);
    $value = str_replace('\n', '', $value);
    if (stripos($value, '•') !== false) {
        $value = explode('•', $value);
        array_splice($value, 0, 1);
        foreach ($value as &$str){
            $str = trim($str);
        }
    }
    return $value;
	}

	/**
	* Import
	*
	*/
	private function import()
	{
		global $USER;
		
		if(isset($this->arImport))
		{
			foreach($this->arImport as $item)
			{
				$arLoadProductArray = [
		            "MODIFIED_BY" => $USER->GetID(),
		            "IBLOCK_SECTION_ID" => false,
		            "IBLOCK_ID" => $this->iBlockId,
		            "PROPERTY_VALUES" => $item['PROP'],
		            "NAME" => $item['NAME'],
		            "ACTIVE" => empty($item['PROP']['SCHEDULE']) ? 'N' : 'Y',
		        ];

		        if ($PRODUCT_ID = $this->el->Add($arLoadProductArray)) {
		            echo "Добавлен элемент с ID : " . $PRODUCT_ID . "<br>";
		        } else {
		            echo "Error: " . $this->el->LAST_ERROR . '<br>';
		        }
			}
		}
			
		
	}

	/**
	* Дамп массивов
	*
	*/
	public function getData()
	{
		echo '<pre>';
		print_r($this->data);
		echo '</pre>';
	}

	public function getArProps()
	{
		echo '<pre>';
		print_r($this->arProps);
		echo '</pre>';
	}

	public function getArImport()
	{
		echo '<pre>';
		print_r($this->arImport);
		echo '</pre>';
	}
}


if (!$USER->IsAdmin()) {
    LocalRedirect('/');
}


$importer = new VacanciesCsvImporter('vacancy.csv');
$importer->setIBlockId(10);

// $importer->deleteElements();

$importer->run();

?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
