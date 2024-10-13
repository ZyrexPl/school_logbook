<?php 
$title = "Admin - Elektroniczny Dziennik";
include __DIR__ . '/head.php';  
include __DIR__ . '/header_admin.php'; 
?> 
<main>
    <h1>Panel administratora: <?php echo htmlspecialchars($_SESSION['name']); //Używamy funkcji htmlspecialchars(), aby wyświetlane dane użytkownika były bezpieczne i chronione przed atakami XSS. ?></h1>

    <!-- Tabela z przedmiotami -->
    <h2>Przedmioty</h2>
    <table>
        <thead>
            <tr>
                <th>Przedmiot</th>
                <th>Nauczyciel</th>
                <th>Akcje</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($subjects as $subject): ?>
                <tr>
                    <td><?php echo htmlspecialchars($subject['name']); ?></td>
                    <td>
                    <?php
                        $isTeacher = false;
                        if (empty($subject['teacher_id'])) {
                            echo '<p class="danger">Przypisz nauczyciela</p>';
                        } else {
                            foreach ($teachers as $teacher) {
                                if ($teacher['id'] == $subject['teacher_id']) {
                                    echo htmlspecialchars($teacher['first_name']) . ' ' . htmlspecialchars($teacher['last_name']);
                                    $isTeacher = true;
                                }
                            }
                        }
                    ?>
                    </td>
                    <td>
                        <a href="/subjects/edit/<?php echo $subject['id']; ?>" class="button">Edytuj</a>
                        <?php
                            if ($isTeacher === false) {
                         ?>
                        <a href="/subjects/assign/<?php echo $subject['id']; ?>" class="button">Przypisz nauczyciela</a>
                         <?php
                            }
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="/subjects/add" class="button">Dodaj przedmiot</a>

    <hr>
    <!-- Tabela z nauczycielami -->
    <h2>Nauczyciele</h2>
    <table>
        <thead>
            <tr>
                <th>Login</th>
                <th>Imię</th>
                <th>Nazwisko</th>
                <th>Akcje</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($teachers as $teacher): ?>
                <tr>
                    <td><?php echo htmlspecialchars($teacher['login']); ?></td>
                    <td><?php echo htmlspecialchars($teacher['first_name']); ?></td>
                    <td><?php echo htmlspecialchars($teacher['last_name']); ?></td>
                    <td>
                        <a href="/teachers/edit/<?php echo $teacher['id']; ?>" class="button">Edytuj</a>
                        <a href="/teachers/delete/<?php echo $teacher['id']; ?>" class="button">Usuń</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="/teachers/add" class="button">Dodaj nauczyciela</a>
</main>


<?php include __DIR__ . '/footer.php'; ?> 