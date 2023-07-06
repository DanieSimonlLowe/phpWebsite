<?php
require_once 'functions/Session.php';
require_once 'functions/ToolBar.php';
require_once 'classes/PdoContainer.php';

$pdo = PdoContainer::getPdo();

$session = getUserSession();
$sql = $pdo->prepare('UPDATE users SET session = NULL WHERE session = :session');
if ($sql->execute([':session' => $session])) {
    $url = '/prog/index.php';
    logOut();
    header('Location: '.$url);
    die();
}

makeToolBar();

?>

<h1> logout failed. </h1>