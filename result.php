<?php
require 'functions.php'; 
$questions = loadQuestions(); 

$name = isset($_POST['username']) ? trim($_POST['username']) : 'Аноним';
$answers = $_POST['answers'] ?? [];
$score = 0;

session_start();
if (!preg_match("/^[а-яА-Яa-zA-Z\s]+$/u", $name)) {
    $_SESSION['error'] = "Ошибка: имя может содержать только буквы и пробелы.";
    header("Location: test.php");
    exit;
}

foreach ($questions as $index => $question) {
    $correct = $question['correct']; 
    $userAnswers = isset($answers[$index]) ? (array)$answers[$index] : [];

    sort($correct);
    sort($userAnswers);

    if ($correct === $userAnswers) {
        $score++;
    }
}

saveResults($name, $score, count($questions));
?>
<!DOCTYPE html>
<html>
<head>
    <title>Результаты</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Результаты теста</h1>
        <p>Имя: <?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?></p>
        <p>Правильных ответов: <?= $score ?> из <?= count($questions) ?></p>
        <p>Процент набранных баллов: <?= round(($score / count($questions)) * 100, 2) ?>%</p>
        <a href="dashboard.php" class="btn">Посмотреть таблицу результатов</a>
    </div>
</body>
</html>
