<?php
if(!ZOO || empty($_GET['enclos']))
    require "actions/default.php";
else
    require "actions/showEnclos.php";