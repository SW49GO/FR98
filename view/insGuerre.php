<?php
$title = "InsGuerre";
ob_start();
?>
<div class="pageInsGuerre">
    <h1>Référencement des dons pour les Insignes de Guerre (depuis la collecte des dons)</h1>
    <div class="insignesG">
        <a href="../public/guerre/Farf.jpg" target="_blank">
            <div class="farf insG">
                <h3>FARF</h3>
                <img src="../public/pictures/guerre.png" alt="crane">
            </div>
        </a>
        <a href="../public/guerre/Dracula.jpg" target="_blank">
            <div class="dracula insG">
                <h3>Le Dracula</h3>
                <img src="../public/pictures/guerre.png" alt="crane">
            </div>
        </a>
        <a href="../public/guerre/Swillisss.jpg" target="_blank">
            <div class="swillisss insG">
                <h3>SWILLISSS</h3>
                <img src="../public/pictures/guerre.png" alt="crane">
            </div>
        </a>
    </div>
</div>
<div class="footer"></div>
<?php
$content = ob_get_clean();
require 'template.php';