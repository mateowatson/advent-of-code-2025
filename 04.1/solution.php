<?php

$input_path = __DIR__ . '/real-input.txt';

$input = file_get_contents($input_path);

$moveable_roll = 0;

$grid = explode("\n", $input);
foreach($grid as $i => $row) {
    $grid[$i] = str_split($row);
}

foreach($grid as $row => $cols) {
    foreach($cols as $col => $space) {
        if($space === '@') {
            $adj = [];

            if(isset($grid[$row-1])) {
                $adj[] = $grid[$row-1][$col-1] ?? null;
                $adj[] = $grid[$row-1][$col] ?? null;
                $adj[] = $grid[$row-1][$col+1] ?? null;
            }
            
            $adj[] = $grid[$row][$col-1] ?? null;
            $adj[] = $grid[$row][$col+1] ?? null;

            if(isset($grid[$row+1])) {
                $adj[] = $grid[$row+1][$col-1] ?? null;
                $adj[] = $grid[$row+1][$col] ?? null;
                $adj[] = $grid[$row+1][$col+1] ?? null;
            }
            $adj = array_filter($adj, fn($v) => $v === '@');
            if(count($adj) < 4) {
                $moveable_roll++;
            }
        }
    }
}

echo $moveable_roll;