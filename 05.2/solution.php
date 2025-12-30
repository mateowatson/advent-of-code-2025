<?php

$input_path = __DIR__ . '/real-input.txt';

$input = file_get_contents($input_path);

$parts = explode("\n\n", $input);

$ranges = explode("\n", $parts[0]);

$available_sum = 0;

$new_range = '';
$delete_ranges = [];

$stop = false;

while(!$stop) {
    $delete_ranges = [];
    $new_range = '';
    
    foreach($ranges as $idx => $r) {
        $range = explode("-", $r);
        $start = (int)$range[0];
        $end = (int)$range[1];
        $found = false;

        foreach($ranges as $idx2 => $r2) {
            if($idx2 === $idx) continue;
            $range2 = explode("-", $r2);
            $start2 = (int)$range2[0];
            $end2 = (int)$range2[1];

            if($start2 >= $start && $start2 <= $end) {
                $new_range = min($start, $start2) . "-" . max($end, $end2);
                $delete_ranges = [$r, $r2];
                $found = true;
                break;
            } else if($end2 <= $end && $end2 >= $start) {
                $new_range = min($start, $start2) . "-" . max($end, $end2);
                $delete_ranges = [$r, $r2];
                $found = true;
                break;
            }
        }

        if($found)
            break;
    }

    if(!empty($new_range) || !empty($delete_ranges)) {
        if(!empty($delete_ranges))
            $ranges = array_filter($ranges, fn($r) => !in_array($r, $delete_ranges));
        if(!empty($new_range))
            $ranges[] = $new_range;
    } else {
        $stop = true;
    }
}

// add up available ids
foreach($ranges as $r) {
    $range = explode("-", $r);
    $start = (int)$range[0];
    $end = (int)$range[1];
    $available_sum += ($end - $start) + 1;
}

echo $available_sum;