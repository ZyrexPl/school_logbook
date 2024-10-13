<?php 
$title = "Dodaj nauczyciela - Elektroniczny Dziennik";
include __DIR__ . '/head.php';  
include __DIR__ . '/header_admin.php'; 
?> 

<main>
    <h2>Dodaj nauczyciela</h2>
    <form action="/teachers/add" method="POST">
        <label for="login">Login:</label>
        <input type="text" id="login" name="login" required>
        
        <label for="password">Hasło:</label>
        <input type="password" id="password" name="password" required>

        <label for="first_name">Imię:</label>
        <input type="text" id="first_name" name="first_name" required>

        <label for="last_name">Nazwisko:</label>
        <input type="text" id="last_name" name="last_name" required>

        <input type="submit" value="Dodaj">
    </form>
</main>

<?php include __DIR__ . '/footer.php'; ?> 
