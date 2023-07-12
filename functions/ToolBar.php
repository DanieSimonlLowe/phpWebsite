<?php
require_once 'Session.php';
require_once 'classes/ToolBar.php';


    function makeToolBar():void
    {
        if (isLoggedIn()) {
            $buttons_loggedIn = array("main"=>"/prog/index.php", 'log out' => '/prog/logout.php', "board" => "/prog/board.php", "search" => "/prog/search.php");
            $toolBar = new ToolBar($buttons_loggedIn);
        } else {
            $buttons_loggedOut = array("main"=>"/prog/index.php", "register" => "/prog/register.php", "login" => "/prog/login.php");
            $toolBar = new ToolBar($buttons_loggedOut);
        }
        $toolBar->echo();
    }
