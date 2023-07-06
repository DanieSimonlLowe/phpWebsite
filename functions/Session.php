<?php
session_start();

function isLoggedIn():bool {
    return !empty($_SESSION['USER_ID']);
}

function setUser(string $value): void
{
    $_SESSION['USER_ID'] = $value;
}

function logOut():void
{
    $_SESSION['USER_ID'] = null;
}

function getUserSession(): string
{
    return $_SESSION['USER_ID'];
}