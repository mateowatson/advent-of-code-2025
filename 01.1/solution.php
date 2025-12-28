<?php

$input_path = __DIR__ . '/real-input.txt';

$input = file_get_contents($input_path);

$pointer = 50;

$max = 99;

$instructions = preg_split("/\r\n|\n|\r/", $input);

$times_left_at_0 = 0;

$points = [];

foreach($instructions as $instruction) {
    $dir = substr($instruction, 0, 1) === 'L' ? -1 : 1;
    $num_spaces = (int)substr($instruction, 1);

    $distance = $num_spaces*$dir;

    $pointer = $pointer + $distance;

    if($pointer < 0) {
        $pointer = ($pointer % 100) + 100;
    } else if($pointer > 99) {
        $pointer = $pointer % 100;
    }

    if($pointer === 100)
        $pointer = 0;

    if($pointer === 0) {
        $times_left_at_0++;
    }
    
}
?>
<button type="button">Copy to Clipboard</button><br>
<textarea name="" id="" style="width: 500px; height: 500px;"><?= $times_left_at_0 ?></textarea>
<script>
    const textarea = document.querySelector('textarea');
    const button = document.querySelector('button');
    button.onclick = () => {
        textarea.select();
        document.execCommand('copy');
        alert('Copied to clipboard!');
    };
</script>