<?php

$input_path = __DIR__ . '/real-input.txt';

$input = file_get_contents($input_path);

$banks = explode("\n", $input);

$joltage_sum = 0;

foreach($banks as $bank) {
    $batteries = str_split($bank);
    $all_but_last = array_slice($batteries, 0, count($batteries) - 1);
    $first = max($all_but_last);
    $rest = array_slice($batteries, array_search($first, $batteries) + 1);
    $second = max($rest);
    $joltage_sum += (int)($first.$second);
}

echo $joltage_sum;
