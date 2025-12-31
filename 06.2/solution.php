<?php

// 6390681 too low
// 25708293098210 too high
// 5841154827 too low
// 10184396490692 nor right

$input_path = __DIR__ . '/test-input.txt';

$input = file_get_contents($input_path);

$lines = explode("\n", $input);
$rows = array_map(fn($l) => str_split($l), $lines);
$num_cols = strlen(max(explode(" ", $input)));
// echo $num_cols;

$indexes = [];
$sum = 0;

foreach($rows as $row_i => $row) {
    foreach($row as $col_i => $col) {
        if(!isset($indexes[$col_i])) {
            $indexes[$col_i] = [];
        }
        $indexes[$col_i][] = $col;
    }
}
// var_dump($indexes);
foreach($indexes as $idx => $index) {
    $operator = $index[array_key_last($index)];
    array_pop($index);
    // var_dump($index, $operator);
    if($operator === ' ') continue;
    $problem = [];

    // var_dump($index);
    for($count = $idx; $count < $idx + count($index); $count ++) {
        // var_dump($count);
        // if(isset($indexes[$count]))
            $problem[] = implode('', $indexes[$count]);
    }
    // $problem = array_filter($problem, fn($item) => $item);
    $problem = array_map(fn($item) => (int)$item, $problem);
    // var_dump($problem);
    if($operator === '+') {
        $sum += array_sum($problem);
    } else {
        $sum += array_product($problem);
    }
}

echo $sum;