<?php

// not working at all

$input_path = __DIR__ . '/test-input.txt';

$input = file_get_contents($input_path);

$banks = explode("\n", $input);

$joltage_sets = '';

$joltage_sum = 0;

foreach($banks as $bank) {
    $bs = array_reverse(str_split($bank));
    $h = null;
    $sh = null;
    $hi = null;
    $shi = null;
    foreach($bs as $i => $b) {
        if($b > $h) {
            if($sh) {
                $sh = $h;
            }
            $h = $b;
            $hi = $i;
        } else if($b > $sh) {
            $sh = $b;
            $shi = $i;
        }
    }
    $joltage_sets .= "$h $sh<br>";
    $joltage_sum += (int)($h.$sh);
}

echo $joltage_sets;
echo $joltage_sum;
