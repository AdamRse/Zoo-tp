<?php
define("P_ROOT", $_SERVER['DOCUMENT_ROOT']);
define("COLOR_THEME_TW", "orange");
define("COLOR_THEME_BT", "hover:cursor-pointer hover:bg-".COLOR_THEME_TW."-300 hover:border-t-".COLOR_THEME_TW."-500 text-".COLOR_THEME_TW."-700 bg-".COLOR_THEME_TW."-200 rounded-lg border border-".COLOR_THEME_TW."-700");
define("ZOO", empty($_SESSION['zoo']['id']) ? false : $_SESSION['zoo']['id']);
define("P_ICON", "./images/icon/");