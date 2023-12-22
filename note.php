<?php
include_once 'header.php';

$currentNote =[
    'notesId' => '',
    'notesTitle' => '',
    'notesDescription' => '',
    'userId' => ''
];

if (isset($_GET['id'])) {
    $currentNote = $connection->getNoteById($_GET['id']);
}
?>
     <main>
         <section class="note-form">
             <?php
             if (isset($_GET['id'])){
                 echo '<h2 class="center">update Note</h2>';
             } else {
                 echo '<h2 class="center">Add a Note</h2>';
             }
             ?>
             <form id="noteForm"  action="includes/save.inc.php" method="post">
                 <input hidden name="id" value="<?=$currentNote['notesId']?>">
                 <input type="text" id="title" name="notesTitle"
                        placeholder="Note Title" value="<?= $currentNote['notesTitle']?>" required>
                 <textarea id="description" name="notesDescription" placeholder="Note Description"
                           rows="4" required><?=$currentNote['notesDescription']?></textarea>

                 <button type="submit">
                     <?php if ($currentNote['notesId']) :?>
                         Update Note
                     <?php else : ?>
                         Add Note
                     <?php endif; ?>
                 </button>
             </form>
         </section>
     </main>
<?php
include_once 'footer.php'; ?>