<?php

$input_path = __DIR__ . '/real-input.txt';

$input = file_get_contents($input_path);

$parts = explode("\n\n", $input);

$ranges = explode("\n", $parts[0]);

$ingredients = explode("\n", $parts[1]);

$available_range_ids = [];

foreach($ingredients as $i) {
    foreach($ranges as $r) {
        $range = explode("-", $r);
        $start = (int)$range[0];
        $end = (int)$range[1];
        if((int)$i >= $start && (int)$i <= $end) {
            $available_range_ids = array_merge(
                $available_range_ids,
                range($start, $end)
            );
        }
    }
}

echo count(array_unique($available_range_ids));

// Fatal error: Uncaught ValueError: The supplied range exceeds the maximum array size: start=183599931013684 end=190431666505844 step=1 in /var/www/html/05.2/solution.php:24 Stack trace: #0 /var/www/html/05.2/solution.php(24): range() #1 {main} thrown in /var/www/html/05.2/solution.php on line 24