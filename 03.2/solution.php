<?php

$input_path = __DIR__ . '/real-input.txt';

$input = file_get_contents($input_path);

$banks = explode("\n", $input);

$joltage_sum = 0;

foreach($banks as $bank) {
    $batteries = str_split($bank);
    $digits = '';

    for($i = 11; $i >= 0; $i--) {
        $all_but_last_i = array_slice($batteries, 0, count($batteries) - $i);
        $max = max($all_but_last_i);
        array_splice($batteries, 0, array_search($max, $batteries) + 1);
        $digits .= $max;
    }

    $joltage_sum += (int)$digits;
}

echo $joltage_sum;
