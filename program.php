<link rel="stylesheet" href="style.css">

<?php

require 'classes/ToolBar.php';


$buttons = array("main"=>"/prog/program.php", "other" => "/dashboard");

$toolBar = new ToolBar($buttons);


$toolBar->get_html();

