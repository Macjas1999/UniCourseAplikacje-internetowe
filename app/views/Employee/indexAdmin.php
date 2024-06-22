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
        <li><a href="index.html">Lista Pracowników</a></li>
        <li><a href="Dodaj.html">Dodaj pracownika</a></li>
        <li><a href="Usuń.html">Usuń Pracownika</a></li>
        <li><a href="Edytuj.html">Edytuj Pracownika</a></li>
    </ul>
</nav>
<div class="container">
    <h1>Rejestr Pracowników</h1>

    <h2>Lista Pracowników</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Imię</th>
                <th>Nazwisko</th>
            </tr>
        </thead>
        <tbody id="employee-list">
            <?php foreach ($employees as $employee): ?>
                <tr>
                    <td><?php echo htmlspecialchars($employee['id']); ?></td>
                    <td><?php echo htmlspecialchars($employee['first_name']) ?></td>
                    <td><?php echo $employee['last_name']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Godziny Pracy</h2>
    <table>
        <thead>
            <tr>
                <th>ID Pracownika</th>
                <th>Data</th>
                <th>Ilość Godzin</th>
                <th>Komentarz</th>
            </tr>
        </thead>
        <tbody id="worklog-list">
            <!-- Lista godzin pracy -->
        </tbody>
        <tbody id="comment-list">
            <!-- Lista komentarzy -->
        </tbody>
    </table>       
</div>
</body>
</html>
