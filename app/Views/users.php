<!DOCTYPE html>
<html>
<head>
    <title>Lista użytkowników</title>
</head>
<body>
    <h1>Lista użytkowników</h1>
    <ul>
        <?php foreach ($users as $user): ?>
            <li><?= $user['login']; ?> - <?= $user['permissions']; ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
