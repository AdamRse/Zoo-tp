<?php
function autoloading($class){
    require P_ROOT."classes/$class.class.php";
}
spl_autoload_register("autoloading");