<?php 
$title = "Dodaj przedmiot - Elektroniczny Dziennik";
include __DIR__ . '/head.php';  
include __DIR__ . '/header_admin.php'; 
?> 

<main>
    <h2>Dodaj przedmiot</h2>
    <form action="/subjects/add" method="POST">

        <label for="name">Nazwa:</label>
        <input type="text" id="name" name="name" required>

        <input type="submit" value="Dodaj">
    </form>
</main>

<?php include __DIR__ . '/footer.php'; ?> 
