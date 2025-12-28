<style>
    :root {
        font-size: 32px;
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
        $num_string = (string)$i;
        $num_length = strlen($num_string);
        
        if($num_length % 2 === 0) {
            $half1 = substr($num_string, 0, $num_length/2);

            $half2 = substr($num_string, $num_length/2);

            if($half1 === $half2) {
                $invalid_id_num += $i;
            }
        }
    }
}

echo $invalid_id_num;