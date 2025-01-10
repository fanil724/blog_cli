<?php

function main(): string
{
    $command = parseCommand();
    if (function_exists($command)) {
        $result = $command();
    } else {
        $result = PHP_EOL . handleError("Нет такой функции") . PHP_EOL .  handleHelp();
    }

    return $result;
}

function parseCommand(): string
{
    $functionName = 'handleHelp';
    if (isset($_SERVER['argv'][1])) {
        $functionName = match ($_SERVER['argv'][1]) {
            'add-post' => 'addPost',
            'search-post' => 'searchPost',
            'read-post' => 'readPost',
            'readall-post' => 'readAllPosts',
            'clear-post' => 'clearPosts',
            'delete-post' => 'deletePosts',
            'victorina' => 'startVictorina',
            'help' => $functionName,
            default => ""
        };
    }
    return $functionName;
}
