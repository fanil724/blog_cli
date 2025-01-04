<?php

function read(): mixed
{
    $file = fopen(__DIR__ . '/db.txt', 'r');
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
