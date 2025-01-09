<?php

function write(string $str): string
{
    $file = fopen(__DIR__ . '/db.txt', 'a');

    $status = fputs($file, $str . PHP_EOL);
    fclose($file);

    if ($status === false) {
        return "Пост не добавлен: " . $str;
    }

    return "Пост добавлен: " . $str;
}

function writeArr(mixed $str): bool
{
    $str =implode( $str);
    $file = fopen(__DIR__ . '/db.txt', 'w');
    $status = fputs($file, $str . PHP_EOL);
    fclose($file);
    return $status ;
}

function clear(): string
{

    $file = fopen(__DIR__ . '/db.txt', 'w');

    $status = fputs($file, "");
    fclose($file);

    if ($status === false) {
        return "Посты не удалены";
    }

    return "Все посты удалены";
}
