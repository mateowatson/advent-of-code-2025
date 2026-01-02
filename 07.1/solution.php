<?php

$input_path = __DIR__ . '/real-input.txt';

$input = file_get_contents($input_path);

$grid = explode("\n", $input);
$grid = array_map(fn($item) => str_split($item), $grid);

$has_started = false;

$times_beam_split = 0;

for($ri = 0; $ri < count($grid); $ri++) {
    $r = $grid[$ri];
    for($ci = 0; $ci < count($r); $ci++) {
        $c = $grid[$ri][$ci];

        $top = null;
        $bottom = null;
        $left = null;
        $right = null;
        $current = $c;

        if($ri !== 0)
            $top = $grid[$ri-1][$ci];
        if($ri !== count($grid) - 1)
            $bottom = $grid[$ri+1][$ci];
        if($ci !== 0)
            $left = $grid[$ri][$ci-1];
        if($ci !== count($r) - 1)
            $right = $grid[$ri][$ci+1];

        if($c === 'S') {
            $has_started = true;

            $bottom = '|';
        } else if($has_started && $c === '.') {
            if($top === '|') {
                $current = '|';
            }
        } else if($has_started && $c === '^') {
            if($top === '|') {
                $times_beam_split++;
                if($left === '.') {
                    $left = '|';
                }
                if($right === '.') {
                    $right = '|';
                }
            }
        }


        if($ri !== 0)
            $grid[$ri-1][$ci] = $top;
        if($ri !== count($grid) - 1)
            $grid[$ri+1][$ci] = $bottom;
        if($ci !== 0)
            $grid[$ri][$ci-1] = $left;
        if($ci !== count($r) - 1)
            $grid[$ri][$ci+1] = $right;
        $grid[$ri][$ci] = $current;
    }
}

echo implode("\n", array_map(fn($rows) => implode('', $rows), $grid));
echo "\n";
echo "Times beam split: $times_beam_split";