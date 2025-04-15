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
    echo "Введите первое число: ";
    $input1 = trim(fgets(STDIN));
    $num1 = (float)$input1;

    echo "Введите второе число: ";
    $input2 = trim(fgets(STDIN));
    $num2 = (float)$input2;

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
