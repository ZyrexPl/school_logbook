<?php 
$title = "Wstaw ocenę - Elektroniczny Dziennik";
include __DIR__ . '/head.php';  
include __DIR__ . '/header_admin.php'; 
?> 

<main>
    <h2>Wstaw ocenę</h2>
    <h3>Przedmiot: <?php echo $subject['name']; ?></h3>
    <h3>Uczeń: <?php echo $student['first_name'] . ' ' . $student['last_name']; ?></h3>
    <form action="/grades/add/<?php echo $student['id']; ?>/<?php echo $subject['id']; ?>" method="POST">

        <label for="grade">Ocena:</label>
        <select name="grade" id="grade" required>
            <option value="6">6 - Celujący</option>
            <option value="5">5 - Bardzo dobry</option>
            <option value="4" selected>4 - Dobry</option>
            <option value="3">3 - Dostateczny</option>
            <option value="2">2 - Dopuszczający</option>
            <option value="1">1 - Niedostateczny</option>
        </select>

        <input type="submit" value="Dodaj">
    </form>
</main>

<?php include __DIR__ . '/footer.php'; ?> 