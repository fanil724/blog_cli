<?php

function handleError(string $error): string
{
    return "\033[31m\t" . $error . " \r\n \033[97m";
}

function handleHelp(): string
{
    $help = <<<HELP
    Доступные команды
help - вывод данной подсказки
add-post - создать новый пост
search-post - найти пост 
read-post - считать пост по ид
readall-post - считат все посты
clear-post - удалить все посты
HELP;
    return $help;
}