<?php
require 'functions.php';
$questions = loadQuestions();

session_start();
$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']); 
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Прохождение теста</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Тест по Dota 2</h1>
        <form action="result.php" method="POST">
        <label><strong>Введите ваше имя:</strong></label>
        <input type="text" name="username" required>
        <?php if ($error): ?>
            <p style="color: red;"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
            
            <?php foreach ($questions as $index => $question): ?>
                <div class="question-card">
                    <fieldset>
                        <legend><strong><?= ($index + 1) . ". " . htmlspecialchars($question['question']) ?></strong></legend>
                        <?php foreach ($question['options'] as $option): ?>
                            <label class="form-check-label">
                                <input type="<?= $question['type'] === 'single' ? 'radio' : 'checkbox' ?>" 
                                       name="answers[<?= $index ?>][]" value="<?= htmlspecialchars($option) ?>">
                                <?= htmlspecialchars($option) ?>
                            </label><br>
                        <?php endforeach; ?>
                    </fieldset>
                </div>
            <?php endforeach; ?>
            
            <button type="submit" class="btn">Завершить тест</button>
        </form>
    </div>
</body>
</html>
