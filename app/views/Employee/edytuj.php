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
    <form action="<?php echo APP_NAME . '/?page=employee_edit'?>" method="post">
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
            <th>Usuń pracownika</th>
        </tr>
        </thead>
        <tbody id="employee-list">
            <tr>
                <td><?php echo htmlspecialchars($employee['id']); ?></td>
                <input type="hidden" id="id" name="id" value="<?php echo htmlspecialchars($employee['id']); ?>">
                <td><input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($employee['first_name']); ?>"></td>
                <td><input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($employee['last_name']); ?>"></td>
                <td><input type="text" id="birth_date" name="birth_date" value="<?php echo htmlspecialchars($employee['birth_date']); ?>"></td>
                <td><input type="text" id="address" name="address" value="<?php echo htmlspecialchars($employee['address']); ?>"></td>
                <td><input type="text" id="telephone" name="telephone" value="<?php echo htmlspecialchars($employee['telephone']); ?>"></td>
                <td><input type="text" id="job_position" name="job_position" value="<?php echo htmlspecialchars($employee['job_position']); ?>"></td>
                <td><input type="text" id="date_started" name="date_started" value="<?php echo htmlspecialchars($employee['date_started']); ?>"></td>
                <td><input type="text" id="salary" name="salary" value="<?php echo htmlspecialchars($employee['salary']) . 'zł'; ?>"></td>
                <td><input type="text" id="email" name="email" value="<?php echo htmlspecialchars($employee['email']); ?>"></td>
                <td><input type="text" id="permissions" name="permissions" value="<?php echo htmlspecialchars($employee['permissions']); ?>"></td>
                <td><button><a href="?page=employee_remove&id=<?php echo $employee['id']; ?>">Usuń</button></td>
            </tr>
        </tbody>
    </table>
    <input type="submit" value="Update">
    </form>
   
</div>
</body>
</html>
