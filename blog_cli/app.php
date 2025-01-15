<?php


require __DIR__ . '/vendor/autoload.php';
//print_r(PDO::getAvailableDrivers());
try {
    $result = main();

    echo $result;
}
catch (PDOException|Exception $e){
    echo handleError($e->getMessage());
}
