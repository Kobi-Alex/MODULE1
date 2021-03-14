<?php
/**
 * Змінна $airports містить масив масивів аеропортів (див. Airports.php)
 * Створити функцію, яка повертає унікальну першу літеру кожного імені аеропорту
 * в алфавітному порядку
 *
 * Створіть тест PhpUnit (GetUniqueFirstLettersTest), який перевірить цю поведінку
 *
 * @param  array  $airports
 * @return string[]
 */
    function getUniqueFirstLetters(array $airports)
    {

        $result = array_unique(array_map(function($airport){
            return $airport['name'][0]; 
        }, $airports));
        natsort($result);
        return $result;
    }

    // SORT_REGULAR - нормальное сравнение элементов (типы не меняются)
    // SORT_NUMERIC - элементы сравниваются как числа
    // SORT_STRING - элементы сравниваются как строки
    // SORT_LOCALE_STRING - сравнивает элементы как строки, с учётом текущей локали.

    