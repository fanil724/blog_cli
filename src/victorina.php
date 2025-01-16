<?php

function startVictorina():string{
    $questions = [
        ["request" => "В какой стране жители пишут желания на бумаге, сжигают её и добавляют пепел в бокал шампанского?", "answers" => [1 => "Италия", 2 => "Испания", 3 => "Мексика", 4 => "Япония"], "responce" => 2],
        ["request" => "Где принято встречать Новый год в белом?", "answers" => [1 => "Бразилия", 2 => "Финляндия", 3 => "Австралия", 4 => "Индия"], "responce" => 1],
        ["request" => "Какую еду традиционно подают на Новый год в Японии?", "answers" => [1 => "Суши", 2 => "Лапшу соба", 3 => "Традиционный рис с овощами", 4 => "Торт моти"], "responce" => 2],
        ["request" => "Как называется рождественская история про Скруджа?", "answers" => [1 => "«Рождественская песнь»", 2 => "«Подарок волхвов»", 3 => "«Щелкунчик»"], "responce" => 1],
        ["request" => "В какой стране Санта-Клаус носит имя Йоулупукки?", "answers" => [1 => "Финляндия", 2 => "Норвегия", 3 => "Швеция", 4 => "Исландия"], "responce" => 1],
        ["request" => "Что обычно едят северные олени Санты?", "answers" => [1 => "Траву", 2 => "Морковь", 3 => "Ягоды"], "responce" => 2]
    ];
    $countPositive = 0;
    $countQuestions = count($questions);
    foreach ($questions as $question) {
    do {
        echo PHP_EOL;
        echo "\033[45m\t\tНовогодняя викторина!!!\033[0m" . PHP_EOL;
        echo "" . $question["request"] . PHP_EOL;
        foreach ($question["answers"] as $key => $quest) {
            echo "\t" . $key . ". " . $quest . PHP_EOL;
        }
        $responce = readline("Выбирите ответ(цифрой один из варианторв ответа):");
        echo PHP_EOL;
    } while (validateResponce($responce, count($question["answers"])));
    echo PHP_EOL;
    if ((int)$responce === $question["responce"]) {
        echo "\033[32m\tВерный ответ!!!\033[0m" . PHP_EOL;
        $countPositive++;
    } else {
        echo "\033[31m\tНЕПРАВЛЬНЫЙ ОТВЕТ\033[0m" . PHP_EOL;
    }
    }
    return "\033[32m\t\tПравильных ответов: $countPositive / $countQuestions \033[0m" . PHP_EOL;
}
 function validateResponce($str, $count): bool
{
    $bolcheck = (int) $str < 1 || (int) $str > $count;
    if ($bolcheck) {
        echo "\033[31m\t\tНе правильный ввод!!!\033[0m" . PHP_EOL;
    }
    return $bolcheck;
}