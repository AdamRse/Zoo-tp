<?php
$zooManager = new Managers\ZooManager($connexion);
$zoo = $zooManager->getZooId(1);
$zoo->afficherMap();