<?php

function addPost(): string
{
    $header = "";
    $body = "";
    $db = getDb();
    do {
        $header = readline("Введите заголовок поста: ");
        $body = readline("Введите текст поста: ");
    } while (validate($header) || validate($body));

    $categories = readAllСategory();

    foreach ($categories as $categ) {
        echo implode(": ", $categ) . PHP_EOL;
    }
    do {
        $id = (int)readline("Введите id категории: ");
        if ($id < 1 || $id > count($categories)) {
            $id = null;
        }
    } while (is_null($id));

    $strQuery = "INSERT INTO posts (title, text, id_category) VALUES(:title, :text, :id_category)";
    $stmt = $db->prepare($strQuery);
    $stmt->execute(['title' => $header, 'text' => $body, 'id_category' => $id]);

    if (!$stmt) {
        return "Пост не добавлен" . PHP_EOL;
    }
    return "Пост добавлен" . PHP_EOL;
}

function readAllPosts(): string
{
    $db=getDB();
    $stmt=$db->query("SELECT p.id, p.title, p.text, c.category
        FROM posts p
        JOIN categories c 
        ON c.id=p.id_category;");
    $result=$stmt->fetchAll();
    if (!$result) {
        return "Нет постов";
    }
    return arrayToString($result);
}

function readPost(): string
{
  /*  if (isset($_SERVER['argv'][2])) {
        $posts = read();
        if (count($posts)==0) {
            return handleError("Постов нет");
        }

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

    return handleError("Введите номер поста");*/
    $db=getDB();
    do {
        $id = (int)readline("Введите id поста: ");
    } while (empty($id));
    $stmt = $db->prepare("SELECT p.id, p.title, p.text ,c.category FROM posts p JOIN categories c ON p.id_category = c.id WHERE p.id = :id;");
    $stmt->execute(['id' => $id]);

    $result = $stmt->fetch();
    if (!$result) {
        return "Пост с id = $id не найден";
    }
    return implode(" ", $result) . PHP_EOL;
}

function  deletePosts()
{
    $db = getDb();

    do {
        $id = (int)readline("Введите id поста: ");
    } while (empty($id));

    $stmt = $db->prepare("DELETE FROM posts  WHERE id = :id;");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    if (!$stmt->rowCount()) {
        return "Пост с id = $id не найден";
    }
    return "Пост с id = $id удален" . PHP_EOL;
}

function clearPosts(): string
{
    $db = getDb();
    $sql = "DELETE FROM posts;";
    $countRows = $db->exec($sql);
    if (!$countRows) {
        return "Посты не удалены";
    }

    return "Постов удалено $countRows";
}

function searchPost(): string
{
    $db = getDb();
    do {
        $contentPost = readline("Введите текст для поиска: ");
    } while (validate($contentPost));
    $stmt = $db->prepare("SELECT p.id, p.title, p.text ,c.category 
    FROM posts p JOIN categories c 
    ON p.id_category = c.id 
    WHERE p.title like :content OR p.text like :content;");
    $stmt->execute(['content' => "%$contentPost%"]);

    $searchPosts = $stmt->fetchAll();

    if (count($searchPosts) < 1) {
        return "Пост с строкой = $contentPost не найден";
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


function arrayToString(mixed $posts): string
{
    $strread = "";
    foreach ($posts as $post) {
        $strread = $strread . "id: " . $post["id"] . " title: " . $post["title"] . " text: " . $post["text"] . " category: " . $post["category"] . PHP_EOL;
        // $strread = $strread . implode(" ", $post) . PHP_EOL;
    }

    return $strread;
}
function readAllСategory(): mixed
{
    $db = getDb();
    $stmt = $db->query("SELECT * FROM categories");
    $result = $stmt->fetchAll();
    if (!$result) {
        return "Нет категории";
    }

    return $result;
}