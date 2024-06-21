ocument.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('employeeForm');
    const tableBody = document.querySelector('#employeeTable tbody');


    // Funkcja do dodawania pracownika do tabeli
    const addEmployeeToTable = (name, position, salary) => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${name}</td>
            <td>${position}</td>
            <td>${salary}</td>
            <td><button class="deleteBtn">Usuń</button></td>
        `;
        tableBody.appendChild(row);
    };
    // Obsługa formularza dodawania pracownika
    form.addEventListener('submit', (e) => {
        e.preventDefault();

        const name = form.name.value.trim();
        const position = form.position.value.trim();
        const salary = form.salary.value.trim();

        if (name === '' || position === '' || salary === '') {
            alert('Please fill in all fields');
            return;
        }

        addEmployeeToTable(name, position, salary);
        saveEmployee(name, position, salary);
        form.reset();
    });
    // Załadowanie pracowników po załadowaniu strony
    loadEmployees();
});