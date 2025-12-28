<style>
    :root {
        font-size: 32px;
        font-family: monospace;
    }
</style>
<?php

$input_path = __DIR__ . '/real-input.txt';

$input = file_get_contents($input_path);

$ranges = explode(',', $input);

$invalid_id_num = 0;

foreach($ranges as $range) {
    $start_end = explode('-', $range);
    $start = (int)$start_end[0];
    $end = (int)$start_end[1];

    for($i = $start; $i <= $end; $i++) {
        $n = (string)$i;
        $d = strlen($n);

        for($l = 1; $l <= (int)($d/2); $l++) {
            if($d % $l === 0) {
                $s = substr($n, 0, $l);
                $s_times_l = str_repeat($s, $d/$l);
                if($n === str_repeat($s, $d/$l)) {
                    $invalid_id_num += $i;
                    break;
                }
            }
        }
        
    }
}

echo $invalid_id_num;