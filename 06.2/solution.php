<?php

$input_path = __DIR__ . '/test-input.txt';

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
            $max_digits = strlen(((string)max($problems[$idx])));
            var_dump($max_digits);
            $problem = [];


            foreach($problems[$idx] as $pn) {
                $num = str_pad($pn, $max_digits, 'x', STR_PAD_RIGHT);
                $digits = str_split($num);
                var_dump($num);
                foreach($digits as $didx => $digit) {
                    // var_dump($digit, $didx);

                    if($digit === 'x') {
                        break;
                    }
                    if(!isset($problem[$didx])) {
                        $problem[$didx] = '';
                    }
                    $problem[$didx] .= $digit;
                }
            }
            // var_dump($problem);
            $problem = array_map(fn($pr) => (int)$pr, $problem);
            var_dump($problem);
            if($n === '+') {
                var_dump(array_sum($problem));
                $sum += array_sum($problem);
            } else {
                var_dump(array_product($problem));
                $sum += array_product($problem);
            }
        }
    }
}
// $pos = strpos($problems[0][2], '0');
// var_dump($problems);

echo $sum;