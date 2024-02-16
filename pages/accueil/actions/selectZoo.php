<?php
$zooManager = new Managers\ZooManager($connexion);
$ZooList = $zooManager->getAllZoo();
?>
<h1>Choisissez un Zoo</h1>
<form method="post">
    <select name="idZoo" class="m-3 p-3 <?= COLOR_THEME_BT ?>">
        <?php
        foreach($ZooList as $zoo){
            ?>
            <option value="<?= $zoo->getId() ?>" ><?= $zoo->getOwner() ?></option>
            <?php
        }
        ?>
    </select>
    <input type="submit" value="Select" class="m-3 p-3 <?= COLOR_THEME_BT ?>"/>
</form>