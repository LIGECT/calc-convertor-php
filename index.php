<?php

echo "Выберите режим: 1 - Калькулятор, 2 - Конвертер\n";
$choice = (int)trim(fgets(STDIN));

echo "Вы выбрали: " . $choice . "\n";

if ($choice === 1) {
    $result = calculate();
    echo "Результат: {$result}\n";
} elseif ($choice === 2) {
    echo "Выберите тип конверсии: 'cm2in', 'kg2lb', 'm2ft', 'c2f': ";
    $type = trim(fgets(STDIN));

    if (empty($type)) {
        echo "Ошибка! Тип конверсии не может быть пустым.\n";
        exit;
    }

    $result = converter($type);
    echo "Результат конверсии: " . round($result, 2) . "\n";
} else {
    echo "Неверный выбор.\n";
}

function converter($type)
{
    $value = getNumberFromUser("Введите число: ");

    switch ($type) {
        case 'c2f':
            return $value * 9 / 5 + 32;
        case 'm2ft':
            return $value * 3.28084;
        case 'cm2in':
            return $value * 0.393701;
        case 'kg2lb':
            return $value * 2.20462;
        default:
            return "Ошибка: неизвестный тип конверсии!";
    }
}

function calculate()
{
    $num1 = getNumberFromUser("Введите первое число: ");
    $num2 = getNumberFromUser("Введите второе число: ");

    echo "Введите операцию: ";
    $operation = trim(fgets(STDIN));


    switch ($operation) {
        case '**':
            return $num1 ** $num2;
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
    while (true) {
        echo $prompt;
        $input = trim(fgets(STDIN));

        if (is_numeric($input)) {
            return strpos($input, '.') === false ? (int)$input : (float)$input;
        }

        echo "Ошибка: '$input' не является числом! Попробуйте еще раз.\n";
    }
}
