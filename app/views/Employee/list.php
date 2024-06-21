<?php require_once BASE_PATH . '/app/views/logged.php'?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee List</title>
</head>
<body>
    <h1>Employee List</h1>
    <ul>
        <?php foreach ($employees as $employee): ?>
            <li>
                <?php echo htmlspecialchars($employee['first_name'] . ' ' . $employee['last_name']); ?>
                <ul>
                    <?php foreach ($employee as $key => $value): ?>
                        <li><?php echo htmlspecialchars($key . ': ' . $value); ?></li>
                    <?php endforeach; ?>
                </ul>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
