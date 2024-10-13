<?php 
$title = "Uczeń - Elektroniczny Dziennik";
include __DIR__ . '/head.php';  
include __DIR__ . '/header_admin.php'; 
?> 

<main>
    <h1>Witaj w panelu ucznia <?php echo $_SESSION['name']; ?>!</h1>

    <table>
        <thead>
            <tr>
                <th>Przedmiot</th>
                <th>Oceny</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($grades)): ?>
                <?php foreach ($grades as $grade): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($grade['subject']); ?></td>
                        <td><?php echo htmlspecialchars($grade['grade']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="2">Brak ocen do wyświetlenia.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</main>

<?php include __DIR__ . '/footer.php'; ?> 