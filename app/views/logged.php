<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestr Pracowników</title>
    <link rel="stylesheet" href="app/views/CSS/styles.css">
</head>
<body>
    <nav class="navbar">
        <div class="logo">Rejestr Pracowników</div>
        <ul class="nav-links">
            <?php if (isset($_SESSION['permissions']) && $_SESSION['permissions'] === 'admin'): ?>
                <li><a href="<?= APP_NAME . '/?page=employee_list'?>">Lista Pracowników</a></li>
                <li><a href="<?= APP_NAME . '/?page=employee_add'?>">Dodaj pracownika</a></li>
            <?php endif; ?>
                <li><a href="<?= APP_NAME . '/?page=view_profile'?>">Twój profil</a></li>
            <li><a href="<?= APP_NAME . '/?page=logout'?>">Wyloguj</a></li>
        </ul>
    </nav>
</body>
</html>
