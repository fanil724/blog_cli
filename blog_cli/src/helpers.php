<?php

function handleError(string $error): string
{
    return "\033[31m\t" . $error . " \r\n \033[97m";
}

function handleHelp(): string
{
   // throw new Exception('какая то ошибка');
    $help = <<<HELP
    Доступные команды
help - вывод данной подсказки
migrate - инициализация структуры бд
seed -  заполнит БД данными
add-post - создать новый пост
search-post - найти пост 
read-post - считать пост по ид
readall-post - считат все посты
clear-post - удалить все посты
delete-post - удалить посты по ид
victorina - участвовать в новогодней викторине
HELP;
    return $help;
}