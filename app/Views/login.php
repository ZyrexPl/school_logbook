<?php 
$title = "Logowanie - Elektroniczny Dziennik";
include __DIR__ . '/head.php';  
include __DIR__ . '/header.php'; 
?> 

<main>
<?php
if (isset($_SESSION['success_message'])) {
    echo '<div class="alert alert-success">' . htmlspecialchars($_SESSION['success_message']) . '</div>';
    unset($_SESSION['success_message']);
}
?>
    <h2>Logowanie</h2>
    <form action="/users/login" method="POST">
        <label for="login">Login:</label>
        <input type="text" id="login" name="login" required>
        
        <label for="password">Hasło:</label>
        <input type="password" id="password" name="password" required>
        
        <input type="submit" value="Zaloguj się">
    </form>
    <p>Nie masz konta? <a href="/users/register">Zarejestruj się</a></p>
</main>

<?php include __DIR__ . '/footer.php'; ?> 
