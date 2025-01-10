<?php

function read(): mixed
{
    $filename=parse_ini_file('config.ini')['db_name'];
    $fullFileName=__DIR__.'/'.$filename;
    if(!file_exists($fullFileName)){
        return "Файл не найден";
    }

    $file = fopen($fullFileName, 'r');
    $text =  array();
    while (!feof($file)) {
        $str = fgets($file);
        if (!empty($str)) {
            $text[] = $str;
        }
    }
    fclose($file);
    return  $text;
}
