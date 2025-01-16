<?php

function getDB():PDO{
    static $db=null;
    if(is_null($db)){
        $db = new PDO("sqlite:database.db");
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }
    return $db;
}
function initBD():string
{
    $db = getDB();
    $db->query("PRAGMA foreign_keys = ON;");
    $db->query("CREATE TABLE  IF NOT EXISTS `categories` (
	`id` INTEGER PRIMARY KEY AUTOINCREMENT UNIQUE,
	`category` TEXT NOT NULL
);");
    $db->query("CREATE TABLE IF NOT EXISTS `posts` (
	`id` INTEGER  PRIMARY KEY AUTOINCREMENT UNIQUE,
	`title` TEXT NOT NULL,
	`text` TEXT NOT NULL,
	`id_category` INTEGER,
FOREIGN KEY(`id_category`) REFERENCES `categories`(`id`) ON DELETE RESTRICT
);");

    $db=null;
    return "Структура БД построена";
}

function seedBD():string{
    $posts = [
        "пятница" => "наконец-то последнийрабочий день в этом уходящем году!!!",
        "2024" => "прощай этот год",
        "2025" => "скоро новый год",
        "новость" => "тестовая новость",
        "выходной" => "наконец-то выходной в этом уходящем году!!!",
        "ура" => "праздник в этом уходящем году!!!"
    ];

    $db = getDb();
    initBD();
    $strQuery = "INSERT INTO posts (title, text, id_category) VALUES('начало', 'первая запись', 4)";
    $categor = 1;
    foreach ($posts as $title => $text) {
        ((int)$categor > 4) ? $categor = 1 : $categor;

        $strQuery = $strQuery . ",('$title', '$text', $categor)";
        $categor++;
    }
    $strQuery = $strQuery . ";";

    $db->query("DELETE FROM posts;");
    $db->query("DELETE FROM categories;");
    $db->query("INSERT INTO categories VALUES (1, 'News'),(2, 'Politics'),(3, 'Sport'),(4, 'IT');");
    $result = $db->query($strQuery);
    if ($result) {
        return "Данные добавлены" . PHP_EOL;
    }

    return "Данные не добавлены" . PHP_EOL;
}
