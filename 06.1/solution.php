<?php

$input_path = __DIR__ . '/real-input.txt';

$input = file_get_contents($input_path);

$lines = explode("\n", $input);
$lines = array_map(fn($l) => explode(" ", $l), $lines);
$lines = array_map(fn($l) => array_values(array_filter($l, fn($item) => $item !== '')), $lines);

$problems = [];
$sum = 0;

foreach($lines as $lidx => $l) {
    foreach($l as $idx => $n) {
        if(!isset($problems[$idx])){
            $problems[$idx] = [];
        }
        if($lidx < count($lines) - 1) {
            $problems[$idx][] = (int)$n;
        } else {
            if($n === '+') {
                $sum += array_sum($problems[$idx]);
            } else {
                $sum += array_product($problems[$idx]);
            }
        }
    }
}

echo $sum;