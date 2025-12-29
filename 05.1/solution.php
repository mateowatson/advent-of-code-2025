<?php

$input_path = __DIR__ . '/real-input.txt';

$input = file_get_contents($input_path);

$parts = explode("\n\n", $input);

$ranges = explode("\n", $parts[0]);

$ingredients = explode("\n", $parts[1]);

$available_num = 0;

foreach($ingredients as $i) {
    foreach($ranges as $r) {
        $range = explode("-", $r);
        if((int)$i >= (int)$range[0] && (int)$i <= (int)$range[1]) {
            $available_num++;
            break;
        }
    }
}

echo $available_num;