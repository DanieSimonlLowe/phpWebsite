<?php
require_once 'classes/ToolBar.php';


    function makeToolBar():void
    {
        $buttons = array("main"=>"/prog/index.php", "register" => "/prog/register.php");
        $toolBar = new ToolBar($buttons);
        $toolBar->echo();
    }
