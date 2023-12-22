<?php
include_once 'header.php';
if (!isset($_SESSION['useruid'])) {
    header('Location:login.php');
}
$user = $_SESSION['userid'];
$notes = $connection->getNotes($user);
$currentNote =[
    'notesId' => '',
    'notesTitle' => '',
    'notesDescription' => '',
    'userId' => ''
];
?>
<main>
    <section class="note-list" >
        <h2 class="center">
            <?= $_SESSION['username'] . "'s Notes" ?>
        </h2>
        <div id="noteList">
            <?php foreach ($notes as $note) :?>
                <div class="note">
                    <div class="title">
                        <a href="note.php?id=<?= $note['notesId'] ?>"><?= $note['notesTitle'] ?></a>
                    </div>
                    <div class="description" >
                        <?= $note['notesDescription'] ?>
                    </div>
                    <small><?= $note['date'] ?></small>
                    <form method="post" action="includes/delete.inc.php">
                        <input hidden name="id" value="<?=$note['notesId']?>">
                        <button class="close">X</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>

    </section>
</main>
<?php
include_once 'footer.php'; ?>