<?php

// Funkcia, ktorá nastaví hodnotu na vybraný pin

function writePinValue($pin, $value) {
    return shell_exec("gpio -g write $pin $value");
}

$json_data = file_get_contents("php://input");
$data = json_decode($json_data);

$pin = $data->pin;
$state = $data->state;


if($state == "Zapnuté") {
    writePinValue($pin, 1);

} else if($state == "Vypnuté") {
    writePinValue($pin, 0);
}


?>