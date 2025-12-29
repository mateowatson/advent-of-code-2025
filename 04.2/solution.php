<?php

$input_path = __DIR__ . '/real-input.txt';

$input = file_get_contents($input_path);

$moveable_rolls = 0;

$grid = explode("\n", $input);
foreach($grid as $i => $row) {
    $grid[$i] = str_split($row);
}

function get_rolls(&$grid, &$moveable_rolls) {
    $moved_something = false;
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
                    $moveable_rolls++;
                    $grid[$row][$col] = '.';
                    $moved_something = true;
                }
            }
        }
    }
    if($moved_something) {
        get_rolls($grid, $moveable_rolls);
    }
}
get_rolls($grid, $moveable_rolls);
echo $moveable_rolls;