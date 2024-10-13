<?php 
$title = "Rejestracja - Elektroniczny Dziennik";
include __DIR__ . '/head.php';  
include __DIR__ . '/header.php'; 
?> 

<main>
    <h2>Rejestracja</h2>
    <form action="/users/register" method="POST">
        <label for="login">Login:</label>
        <input type="text" id="login" name="login" required>
        
        <label for="password">Hasło:</label>
        <input type="password" id="password" name="password" required>

        <label for="first_name">Imię:</label>
        <input type="text" id="first_name" name="first_name" required>

        <label for="last_name">Nazwisko:</label>
        <input type="text" id="last_name" name="last_name" required>
        
        <input type="hidden" id="permissions" name="permissions" value="student">

        <input type="submit" value="Zarejestruj się">
    </form>
    <p>Masz już konto? <a href="/users/login">Zaloguj się</a></p>
</main>

<?php include __DIR__ . '/footer.php'; ?> 
