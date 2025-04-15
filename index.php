<?php

echo "Выберите режим: 1 - Калькулятор, 2 - Конвертер\n";
$choice = (int)trim(fgets(STDIN));

echo "Вы выбрали: " . $choice . "\n";

if ($choice === 1) {
    $result = calculate();
    echo "Результат: " . $result . "\n";
}

function calculate()
{
    $num1 = getNumberFromUser("Введите первое число: ");
    $num2 = getNumberFromUser("Введите второе число: ");

    echo "Введите операцию: ";
    $operation = trim(fgets(STDIN));


    switch ($operation) {
        case '+':
            return $num1 + $num2;
        case '-':
            return $num1 - $num2;
        case '*':
            return $num1 * $num2;
        case '/':
            if ($num2 != 0) {
                return $num1 / $num2;
            } else {
                return "Ошибка! Деление на ноль.";
            }
        default:
            return "Некорректная операция!";
    }
}

function getNumberFromUser($prompt): float|int
{
    //code
    while (true) {
        echo $prompt;
        $input = trim(fgets(STDIN));

        if (is_numeric($input)) {
            return strpos($input, '.') === false ? (int)$input : (float)$input;
        }

        echo "Ошибка: '$input' не является числом! Попробуйте еще раз.\n";
    }
}
