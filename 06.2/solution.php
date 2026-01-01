<?php

$input_path = __DIR__ . '/real-input.txt';

$input = file_get_contents($input_path);

$lines = explode("\n", $input);
$rows = array_map(fn($l) => str_split($l), $lines);

$problems = [];
$sum = 0;

foreach($rows[count($rows) - 1] as $ci => $c) {
    if($c === '+' || $c === '*') {
        $problems[] = ['group' => $ci, 'numbers' => [], 'operator' => $c];
    }
}



foreach($problems as $pi => $p) {
    // var_dump('z'.$pi);
    foreach($rows as $ri => $r) {
        foreach($r as $ci => $c) {
            if(isset($problems[$pi+1]) && $ci < $problems[$pi+1]['group'] && $ci >= $problems[$pi]['group']) {
                if(!isset($problems[$pi]['numbers'][$ci])) {
                    $problems[$pi]['numbers'][$ci] = '';
                }

                if(!in_array($c, ['+','*']))
                    $problems[$pi]['numbers'][$ci] .= $c;
            } else if($pi === array_key_last($problems) && $ci >= $problems[$pi]['group']) {
                if(!isset($problems[$pi]['numbers'][$ci])) {
                    $problems[$pi]['numbers'][$ci] = '';
                }
                
                if(!in_array($c, ['+','*']))
                    $problems[$pi]['numbers'][$ci] .= $c;
            }
        }
    }
}

foreach($problems as $pi => $p) {
    $numbers = array_filter($p['numbers'], fn($item) => trim($item));
    $numbers = array_map(fn($item) => (int)$item,$numbers);
    $sum += $p['operator'] === '+' ? array_sum($numbers) : array_product($numbers);
}

echo $sum;

