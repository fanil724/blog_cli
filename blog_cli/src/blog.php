<?php

function addPost(): string
{
    $header = "";
    $body = "";

    //Заголовок и тело поста считывайте тут же через readline
    //обработайте ошибки
    //в случае успеха верните тект что пост добавлен
    do {
        $header = readline("Введите заголовок поста: ");
        $body = readline("Введите текст поста: ");
    } while (validate($header) || validate($body));
    $posts[] = $header;
    $posts[] = $body;

    date_default_timezone_set("Europe/Moscow");
    $dateime = date('d.m.Y h:i');
    $posts[] = $dateime;
    //print_r($posts);
    $post = implode(" ::: ", $posts);

    return write($post);
}

function readAllPosts(): string
{

    return arrayToString(read());
}

function readPost(): string
{

    if (isset($_SERVER['argv'][2])) {
        $posts = read();
        $idpost = $_SERVER['argv'][2];
        // print($idpost . PHP_EOL);
        if (!is_numeric($idpost)) {
            return handleError("Введите номер поста");
        }

        if ($idpost < 0 || $idpost >= count($posts)) {
            return handleError("Введите номер поста от 0 до " . count($posts));
        }
        $strread = $posts[$idpost];

        $str = str_replace(":::", " ", $strread);
        return $str;
    }

    return handleError("Введите номер поста");
}

function clearPosts(): string
{
    return clear();
}

function searchPost(): string
{

    do {
        $contentPost = readline("Введите текст для поиска: ");
    } while (validate($contentPost));
    $posts = read();

    $searchPosts = filterPost($posts, $contentPost);
    if (count($searchPosts) <= 0) {
        return handleError("Не найденно постов с такими данными: $contentPost");
    }
    return arrayToString($searchPosts);
}
function validate($str): bool
{
    if (empty($str)) {
        echo handleError("Строка пустая!!!");
        return true;
    }
    return false;
}

function filterPost(mixed $posts, string $contentPost): mixed
{
    $filterPosts = array();
    foreach ($posts as $post) {
        if (str_contains($post, $contentPost)) {
            $filterPosts[] = $post;
        }
    }
    return $filterPosts;
}

function arrayToString(mixed $posts): string
{
    $strread = implode("", $posts);
    $str = str_replace(":::", " ", $strread);
    return $str;
}
