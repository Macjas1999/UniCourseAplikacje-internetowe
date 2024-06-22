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
    <h2>Lista Pracowników</h2>
    <table>
        <thead>
            <tr>      
                <th>Przepracowane godziny</th>
            </tr>
        </thead>
        <div id="calendar"></div>
        <script>$(document).ready(function() {
    // Dane startowe
    var date = new Date();
    var month = date.getMonth() + 1; // Pobranie aktualnego roku w formacie czterocyfrowym
    var year = date.getFullYear(); // Pobranie aktualnego miesiąca i korekta indeksu (getMonth zwraca miesiące od 0 do 11)
    var day = date.getDate(); // Pobranie aktualnego dnia miesiąca

    // Obliczenie pierwszego dnia miesiąca
    var startDay = new Date(year, month - 1, 1).getDay(); // .getDay() zwraca indeksy dni tygodnia 0-6, gdzie 0 to niedziela
    if (startDay == 0) { startDay = 7; } // Zamiana numeru dla niedzieli na format 1-7

    // Pobranie maksymalnego dnia w miesiącu
    var maxDay = new Date(year, month, 0).getDate();

    // Tablica z nazwami miesięcy
    var monthName = ["Styczeń", "Luty", "Marzec", "Kwiecień", "Maj", "Czerwiec", "Lipiec", "Sierpień", "Wrzesień", "Październik", "Listopad", "Grudzień"];

    // Wyświetlanie nazwy miesiąca i roku oraz elementów nawigacyjnych
    var divDay = $('<div>').text("<");
    $("#calendar").append(divDay);
    divDay = $('<div>').text(monthName[month-1] + " " + year).addClass('month-year');
    $("#calendar").append(divDay);
    divDay = $('<div>').text(">");
    $("#calendar").append(divDay);

    // Tablica z nazwami dni tygodnia
    var dayName = ["Pon", "Wto", "Śro", "Czw", "Pią", "Sob", "Nie"];

    // Wyświetlenie nazw dni tygodnia z odpowiednią klasą dla weekendu
    for (let i = 0; i <= 6; i++) {
        var divDay = $('<div>').text(dayName[i]).addClass('day-name');
        if (i == 0) { divDay.addClass('clear'); }
        if (i == 5) { divDay.addClass('saturday'); }
        if (i == 6) { divDay.addClass('sunday'); }
        $("#calendar").append(divDay);
    }

    // Wyświetlenie pustych dni na początku miesiąca
    for (let i = 1; i < startDay; i++) {
        var divDay = $('<div>').addClass('none');
        if (i == 1) { divDay.addClass('clear'); }
        $("#calendar").append(divDay);
    }

    // Wyświetlenie dni miesiąca
    for (let i = 1; i <= maxDay; i++) {
        var ii = i + startDay - 1;
        var divDay = $('<div>').text(i);
        if (ii % 7 == 1) { divDay.addClass('clear'); }
        if (i == day) { divDay.addClass('today');
        } else {
            if (ii % 7 == 0) { divDay.addClass('sunday'); }
            if (ii % 7 == 6) { divDay.addClass('saturday'); }
        }
        $("#calendar").append(divDay);
    }
});</script>

</body>
</html>
