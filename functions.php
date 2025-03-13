<?php

function loadQuestions() {
    $json = file_get_contents(__DIR__ . '/questions.json');
    return json_decode($json, true);
}

function saveResults($name, $score, $total) {
    $file = __DIR__ . '/results.json';
    $results = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
    
    $results[] = [
        "name" => $name,
        "score" => $score,
        "total" => $total,
        "percent" => round(($score / $total) * 100, 2)
    ];

    file_put_contents($file, json_encode($results, JSON_PRETTY_PRINT));
}

?>
