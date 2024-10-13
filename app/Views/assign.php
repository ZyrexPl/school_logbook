<?php 
$title = "Logowanie - Elektroniczny Dziennik";
include __DIR__ . '/head.php';  
include __DIR__ . '/header_admin.php'; 
?> 

<main>
    <h2>Przedmiot: <?php echo $subject['name']; ?></h2>
    <form action="/subjects/assign/<?php echo $id; ?>" method="POST">
        <label for="teacher">Wybierz nauczyciela:</label>
            <select name="teacher_id" id="teacher_id" required>
                <?php foreach ($teachers as $teacher): ?>
                    <option value="<?php echo $teacher['id']; ?>"><?php echo $teacher['first_name'] . ' ' . $teacher['last_name']; ?></option>
                <?php endforeach; ?>
            </select>
        <input type="submit" value="Dopisz">
    </form>
</main>

<?php include __DIR__ . '/footer.php'; ?> 