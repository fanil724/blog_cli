<?php

function write(string $str): bool
{
    $filename=parse_ini_file('config.ini')['db_name'];
    $fullFileName=__DIR__.'/'.$filename;
    if(!file_exists($fullFileName)){
        return false;
    }

    $file = fopen($fullFileName, 'a');

    $status = fputs($file, $str . PHP_EOL);
    fclose($file);

    return $status;
}

function writeArr(mixed $str): bool
{
    $filename=parse_ini_file('config.ini')['db_name'];
    $fullFileName=__DIR__.'/'.$filename;
    if(!file_exists($fullFileName)){
        return false;
    }

    $str =implode( $str);
    $file = fopen($fullFileName, 'w');
    $status = fputs($file, $str . PHP_EOL);
    fclose($file);
    return $status ;
}

function clear(): bool
{
    $filename=parse_ini_file('config.ini')['db_name'];
    $fullFileName=__DIR__.'/'.$filename;
    if(!file_exists($fullFileName)){
        return false;
    }

    $file = fopen($fullFileName, 'w');
    $status = fputs($file, "");
    fclose($file);
    return $status;
}
