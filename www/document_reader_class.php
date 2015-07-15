<?php
ini_set('display_errors', true);
//Класс состоит из
//function __construct($full_file_patch)
//function __destruct
//function get_file_data($full_file_patch)
//function WinToUtf8($data)
//function set_filezise($filesize)
//function set_parsed_file_suffix($parsedfilesuffix)
//set_full_file_patch($full_file_patch)
//function generateRandStr($length)
//public function Utf8ToWin($s)
//public function generatemd5salt($length)
//require "database_connection_base_class.php";
//************************************************************************************************************************************
class document_reader_class {
   public $rows_array;//=array();
   public $filesize;//=1048576;
   public $parsedfilesuffix;//='_parsed;
   public $full_file_patch;//'xyz'
//************************************************************************************************************************************
function __construct($full_file_patch) 
{
	try {
		//Создаем конструктор класса
		$this->$full_file_patch=$full_file_patch;
	} catch (Exception $e) {
    	echo $this->WinToUtf8('Ошибка в классе: document_reader_class функция: __construct($full_file_patch) код: '),  $e->getMessage(), "\n";
	}
}
//************************************************************************************************************************************
function __destruct() {

}
//************************************************************************************************************************************
function get_file_data($full_file_patch)
{
		try {
		$fline='';
		//Получаем данные из файла
		$this->$full_file_patch=$full_file_patch;

    if (file_exists($this->$full_file_patch) or die ($this->WinToUtf8('Файл не сущуствует или перемещен.').$this->$full_file_patch)) {
        $fp_in = fopen($this->$full_file_patch, "r");
        while (!feof($fp_in)) {
               $fline.=fread($fp_in,filesize($this->$full_file_patch));
               //echo $fline.'<br></br>';
        }
        fclose($fp_in);
        return $fline;
        //return 1;
    }
	
	} catch (Exception $e) {
    	echo $this->WinToUtf8('Ошибка в классе: document_reader_class функция: get_file_data($full_file_patch) код: '),  $e->getMessage(), "\n";
	}
}
//************************************************************************************************************************************
function set_filezise($filesize) 
{
    $this->$filesize=$filesize;
	return 1;
}
//************************************************************************************************************************************
function set_parsed_file_suffix($parsedfilesuffix)
{
    $this->$parsedfilesuffix=$parsedfilesuffix;
	return 1;
}
//************************************************************************************************************************************
function set_full_file_patch($full_file_patch)
{
	$this->$full_file_patch=$full_file_patch;
	return 1;
}
public function Utf8ToWin($s)
        {
            $byte2=false;
            for ($c=0;$c<strlen($s);$c++)
            {
               $i=ord($s[$c]);
               if ($i<=127) $out.=$s[$c];
                   if ($byte2){
                       $new_c2=($c1&3)*64+($i&63);
                       $new_c1=($c1>>2)&5;
                       $new_i=$new_c1*256+$new_c2;
                   if ($new_i==1025){
                       $out_i=168;
                   } else {
                       if ($new_i==1105){
                           $out_i=184;
                       } else {
                           $out_i=$new_i-848;
                       }
                   }
                   $out.=chr($out_i);
                   $byte2=false;
                   }
               if (($i>>5)==6) {
                   $c1=$i;
                   $byte2=true;
               }
            }
            return $out;
        }
//************************************************************************************************************************************ 
public function WinToUtf8($data)
{
    if (is_array($data))
    {
        $d = array();
        foreach ($data as $k => &$v) $d[WinToUtf8($k)] = WinToUtf8($v);
        return $d;
    }
    if (is_string($data))
    {
        if (function_exists('iconv')) return iconv('cp1251', 'utf-8//IGNORE//TRANSLIT', $data);
        if (! function_exists('cp1259_to_utf8')) include_once 'cp1259_to_utf8.php';
        return WinToUtf8($data);
    }
    if (is_scalar($data) or is_null($data)) return $data;
    #throw warning, if the $data is resource or object:
    trigger_error('An array, scalar or null type expected, ' . gettype($data) . ' given!', E_USER_WARNING);
    return $data;
}
//************************************************************************************************************************************
function generateRandStr($length)
{
    $randstr = "";
    for($i=0; $i<$length; $i++){
        $randnum = mt_rand(0,61);
        if($randnum < 10){
            $randstr .= chr($randnum+48);
        }else if($randnum < 36){
            $randstr .= chr($randnum+55);
        }else{
            $randstr .= chr($randnum+61);
        }
    }
    return $randstr;
} 
//************************************************************************************************************************************
public function generatemd5salt($length)
{
  return md5($this->generateRandStr($length));
}
//Функция чтения данных JSON
function read_json_data($item_id)
{
	try {
		$dir = '';
		$file = 'site_text_main.json';
		
		switch ($item_id)
		{	case "Text_data1":
			//print 'get_last_message File '.$value.' was found <br></br>';
			if (file_exists($dir."".$file) or die ('Error opening file '.$dir."".$file)) {
				//print 'File '.$dir.'/'.$file.' was opened <br></br>';
				$site_text=$this->load_json_utf8($dir."".$file);
				return $site_text["Text_data1"];
			}
			break;
		}
	} catch (Exception $e) {
		echo 'Exception raises : ',  $e->getMessage(), "<br>";
	}
}

function load_json_utf8($filename)
{
	try {
		$content_str = file_get_contents($filename);
		$content_str=substr(
				$content_str,
				min(
						strpos($content_str.'[','['),
						strpos($content_str.'{','{')
				)
		);
		$arr_replace_utf = array('\u0410', '\u0430','\u0411','\u0431','\u0412','\u0432',
				'\u0413','\u0433','\u0414','\u0434','\u0415','\u0435','\u0401','\u0451','\u0416',
				'\u0436','\u0417','\u0437','\u0418','\u0438','\u0419','\u0439','\u041a','\u043a',
				'\u041b','\u043b','\u041c','\u043c','\u041d','\u043d','\u041e','\u043e','\u041f',
				'\u043f','\u0420','\u0440','\u0421','\u0441','\u0422','\u0442','\u0423','\u0443',
				'\u0424','\u0444','\u0425','\u0445','\u0426','\u0446','\u0427','\u0447','\u0428',
				'\u0448','\u0429','\u0449','\u042a','\u044a','\u042b','\u044b','\u042c','\u044c',
				'\u042d','\u044d','\u042e','\u044e','\u042f','\u044f');
		$arr_replace_cyr = array('А', 'а', 'Б', 'б', 'В', 'в', 'Г', 'г', 'Д', 'д', 'Е', 'е',
				'Ё', 'ё', 'Ж','ж','З','з','И','и','Й','й','К','к','Л','л','М','м','Н','н','О','о',
				'П','п','Р','р','С','с','Т','т','У','у','Ф','ф','Х','х','Ц','ц','Ч','ч','Ш','ш',
				'Щ','щ','Ъ','ъ','Ы','ы','Ь','ь','Э','э','Ю','ю','Я','я');
		return json_decode(str_replace($arr_replace_utf,$arr_replace_cyr,$content_str),true);
		//$bom = chr(0xEF).chr(0xBB).chr(0xBF);
		//$content_str = file_get_contents($filename);
		//if(substr_compare($bom, $content_str, 0, strlen($bom)) == 0)
		//$content_str = substr($content_str, strlen($bom));
		//return json_decode($content_str);
	} catch (Exception $e) {
		echo 'Exception raises : ',  $e->getMessage(), "<br>";
	}
}

}
?>