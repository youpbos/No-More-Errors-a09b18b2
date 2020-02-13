<?php
$userInput = $argv[1];

try {
    if (empty($userInput)) {
        throw new Exception('Je hebt geen bedrag meegegeven dat omgewisseld dient te worden');
    } elseif ($userInput < "0") {
        throw new Exception('Je hebt geen geldig bedrag meegegeven');
    }
    elseif (is_numeric($userInput)) {
        $wsgeld = (float) round($userInput, 2);
        $value = (round($wsgeld / 0.05, 0)) * 0.05;
        define(
            'geldEenheid',
            [
                "50" => "euro",
                "20" => "euro",
                "10" => "euro",
                "5" => "euro",
                "2" => "euro",
                "1" => "euro",
                "0.50" => "cent",
                "0.20" => "cent",
                "0.10" => "cent",
                "0.05" => "cent"
            ]
        );
        foreach (geldEenheid as $coin => $type) {
            $coin = (float) $coin;
            $value = round($value, 2);
            if (floor($value / $coin) > 0) {
                $times = floor($value / $coin);
                echo "$times X $coin $type" . PHP_EOL;
                $value = $value - ($times * $coin);
            }
        }
    } 
} catch (Exception $notcorrect) {
    echo  $notcorrect->getMessage();
    exit;
}
