<?php 
$title = "Nauczyciel - Elektroniczny Dziennik";
include __DIR__ . '/head.php';  
include __DIR__ . '/header_admin.php'; 
?> 

<main>
    <h1>Panel nauczyciela: <?php echo htmlspecialchars($_SESSION['first_name']); ?></h1>
    <?php foreach ($logbook as $subject_name => $students): ?>
        <h2><?php echo htmlspecialchars($subject_name); ?></h2>
        <table>
        <thead>
            <tr>
                <th>Imię</th>
                <th>Nazwisko</th>
                <th>Oceny</th>
                <th>Akcje</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?php echo htmlspecialchars($student['first_name']); ?></td>
                    <td><?php echo htmlspecialchars($student['last_name']); ?></td>
                    <td></td>
                    <td>
                        <a href="/grades/add/<?php echo $student['id']; ?>" class="button">Dodaj ocenę</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endforeach; ?>
</main>

<?php include __DIR__ . '/footer.php'; ?> 