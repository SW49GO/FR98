<?php
$title = "Guerres";
ob_start();
?>
<div class="pageGuerre">
    <h1>Infos Guerres</h1>
    <?php if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1): ?>
    <fieldset>
        <legend>ADMINISTRATION</legend>
        <form method="POST" action="" enctype="multipart/form-data" id="form_excel">
            <label>Importer un nouveau fichier</label>
            <input type="file" name="file_excel" id="file_excel" accept=".jpg, .jpeg, .png">
        </form>
        <?= $message ?>
    </fieldset>
    <?php endif ?>
    <h1>Cliquez sur le fichier pour le viualiser</h1>
    <div class="container_excel">
        <?= $listExcel ?>
    </div>
    <div class="show_excel"></div>
    <div class="footer"></div>

</div>
<?php
$content = ob_get_clean();
require 'template.php';