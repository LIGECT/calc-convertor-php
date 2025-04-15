<?php

echo colorize("====================================\n", ConsoleColor::BRIGHT_BLUE);
echo colorize("||     КОНВЕРТЕР И КАЛЬКУЛЯТОР    ||\n", ConsoleColor::BRIGHT_MAGENTA);
echo colorize("====================================\n", ConsoleColor::BRIGHT_BLUE);


echo colorize("Выберите режим:\n", ConsoleColor::BRIGHT_CYAN);
echo colorize("1 - Калькулятор\n", ConsoleColor::BRIGHT_YELLOW);
echo colorize("2 - Конвертер\n", ConsoleColor::BRIGHT_YELLOW);
$choice = (int)trim(fgets(STDIN));

echo colorize("Вы выбрали: " . $choice . "\n", ConsoleColor::BRIGHT_MAGENTA);

if ($choice === 1) {
    $result = calculate();
    echo colorize("Результат: {$result}\n", ConsoleColor::BRIGHT_GREEN);
} elseif ($choice === 2) {
    echo colorize("Доступные типы конверсии:\n", ConsoleColor::BRIGHT_CYAN);
    echo colorize("'cm2in' - сантиметры в дюймы\n", ConsoleColor::BRIGHT_YELLOW);
    echo colorize("'kg2lb' - килограммы в фунты\n", ConsoleColor::BRIGHT_YELLOW);
    echo colorize("'m2ft'  - метры в футы\n", ConsoleColor::BRIGHT_YELLOW);
    echo colorize("'c2f'   - цельсии в фаренгейты\n", ConsoleColor::BRIGHT_YELLOW);
    echo colorize("Выберите тип конверсии: ", ConsoleColor::BRIGHT_GREEN);
    $type = trim(fgets(STDIN));

    if (empty($type)) {
        echo colorize("Ошибка! Тип конверсии не может быть пустым.\n", ConsoleColor::BRIGHT_RED . ConsoleColor::BG_BLACK);
        exit;
    }

    $result = converter($type);
    echo colorize("Результат конверсии: " . round($result, 2) . "\n", ConsoleColor::BRIGHT_GREEN);
} else {
    echo colorize("Неверный выбор. Пожалуйста, введите 1 или 2\n", ConsoleColor::BRIGHT_RED);
}

function converter($type)
{
    $value = getNumberFromUser(colorize("Введите число: ", ConsoleColor::BRIGHT_CYAN));

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
    $num1 = getNumberFromUser(colorize("Введите первое число: ", ConsoleColor::BRIGHT_CYAN));
    $num2 = getNumberFromUser(colorize("Введите второе число: ", ConsoleColor::BRIGHT_CYAN));

    echo colorize("Доступные операции:\n", ConsoleColor::BRIGHT_CYAN);
    echo colorize("+  - сложение\n", ConsoleColor::BRIGHT_YELLOW);
    echo colorize("-  - вычитание\n", ConsoleColor::BRIGHT_YELLOW);
    echo colorize("*  - умножение\n", ConsoleColor::BRIGHT_YELLOW);
    echo colorize("/  - деление\n", ConsoleColor::BRIGHT_YELLOW);
    echo colorize("** - возведение в степень\n", ConsoleColor::BRIGHT_YELLOW);
    echo colorize("Введите операцию: ", ConsoleColor::BRIGHT_GREEN);
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
                echo colorize("Ошибка! Деление на ноль.\n", ConsoleColor::BRIGHT_RED . ConsoleColor::BG_BLACK);
            }
        default:
            echo colorize("Некорректная операция!\n", ConsoleColor::BRIGHT_RED);
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

        echo colorize("Ошибка: '{$input}' не является числом! Попробуйте еще раз.\n", ConsoleColor::BRIGHT_RED);
    }
}

class ConsoleColor
{
    const GRAY = "\033[1;30m";
    const BRIGHT_RED = "\033[1;31m";
    const BRIGHT_GREEN = "\033[1;32m";
    const BRIGHT_YELLOW = "\033[1;33m";
    const BRIGHT_BLUE = "\033[1;34m";
    const BRIGHT_MAGENTA = "\033[1;35m";
    const BRIGHT_CYAN = "\033[1;36m";
    const BRIGHT_WHITE = "\033[1;37m";

    const BG_BLACK   = "\033[40m";
    const BG_RED     = "\033[41m";
    const BG_GREEN   = "\033[42m";
    const BG_YELLOW  = "\033[43m";
    const BG_BLUE    = "\033[44m";
    const BG_MAGENTA = "\033[45m";
    const BG_CYAN    = "\033[46m";
    const BG_WHITE   = "\033[47m";

    const RESET = "\033[0m";
}

function colorize($text, $color)
{
    return $color . $text . ConsoleColor::RESET;
}
