<?php
require 'functions.php'; 

$file = 'results.json';

if (file_exists($file)) {
    $data = file_get_contents($file);
    $results = json_decode($data, true);
    
    if (!is_array($results)) {
        $results = [];
    }
} else {
    $results = [];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Результаты</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Таблица результатов</h1>
        <table border="1" width="100%" cellspacing="0" cellpadding="5">
            <thead>
                <tr>
                    <th>Имя</th>
                    <th>Правильные ответы</th>
                    <th>Всего вопросов</th>
                    <th>Процент</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($results)): ?>
                    <tr>
                        <td colspan="4" style="text-align: center;">Пока нет данных</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($results as $result): ?>
                        <tr>
                            <td><?= htmlspecialchars($result['name'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= $result['score'] ?></td>
                            <td><?= $result['total'] ?></td>
                            <td><?= $result['percent'] ?>%</td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="test.php" class="btn" style="margin-top: 20px;">Пройти тест заново</a>
    </div>
</body>
</html>
