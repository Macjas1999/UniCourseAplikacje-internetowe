<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestr Pracowników</title>
    <link rel="stylesheet" href="app/views/CSS/styles.css">
</head>
<body>
<?php require_once BASE_PATH . '/app/views/logged.php'?>
<div class="container">
    <h1>Rejestr Pracowników</h1>

    <h2>Lista Pracowników</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Imię</th>
                <th>Nazwisko</th>
                <th>Data Urodzenia</th>
                <th>Adres Zamieszkania</th>
                <th>Numer telefonu</th>
                <th>Stanowisko</th>
                <th>Data Rozpoczęcia Pracy</th>
                <th>Wypłata</th>
                <th>Adres E-mail</th>
                <th>Uprawnienia</th>
                <th>Edycja</th>
            </tr>
        </thead>
        <tbody id="employee-list">
            <?php foreach ($employees as $employee): ?>
                <tr>
                    <td><?php echo htmlspecialchars($employee['id']); ?></td>
                    <td><?php echo htmlspecialchars($employee['first_name']) ?></td>
                    <td><?php echo htmlspecialchars($employee['last_name']); ?></td>
                    <td><?php echo htmlspecialchars($employee['birth_date']); ?></td>
                    <td><?php echo htmlspecialchars($employee['address']); ?></td>
                    <td><?php echo htmlspecialchars($employee['telephone']); ?></td>
                    <td><?php echo htmlspecialchars($employee['job_position']); ?></td>
                    <td><?php echo htmlspecialchars($employee['date_started']); ?></td>
                    <td><?php echo htmlspecialchars($employee['salary']) . 'zł'; ?></td>
                    <td><?php echo htmlspecialchars($employee['email']); ?></td>
                    <td><?php echo htmlspecialchars($employee['permissions']);?></td>
                    <td><button><a href="?page=employee_edit&id=<?php echo $employee['id']; ?>">Edytuj</button></td>
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
