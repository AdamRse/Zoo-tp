<footer class="flex justify-center items-center p-10 bg-<?= COLOR_THEME_TW ?>-700 text-<?= COLOR_THEME_TW ?>-100">
<div class="text-right">
    <p class="font-bold text-3xl">Anthropocene Park</p>
    <p>(c) Romain & Adam corp 2024</p>
    <p>All rights reserved</p>
</div>
<img src="/images/icon.png" class="" />
</footer>
<?php
//Ajout dynamique de tous les scripts js de la page
foreach ($js as $fileJs) {// L'existence des fichier du tableau $js a déjà été vérifiée dans index.php
    ?>
    <script src="<?= $fileJs ?>"></script>
    <?php
}