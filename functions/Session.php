<?php
require_once 'classes/PdoContainer.php';
session_start();

function isLoggedIn():bool {
    return !empty($_SESSION['USER_ID']);
}

function setUser(string $hash, int $id): void
{
    $_SESSION['USER_HASH'] = $hash;
    $_SESSION['USER_ID'] = $id;
}

function logOut():void
{
    $_SESSION['USER_HASH'] = null;
    $_SESSION['USER_ID'] = null;
}

function getUserSession(): string
{
    return $_SESSION['USER_HASH'];
}

function getUserId(): int
{
    return $_SESSION['USER_ID'];
}

function isLoggedInValid(): bool
{
    $pdo = PdoContainer::getPdo();
    $getData = $pdo->prepare("SELECT session From users WHERE id = :id");
    $getData->execute([":id" => getUserId()]);

    return $getData->fetchColumn() == getUserSession();
}