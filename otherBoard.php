<?php
require_once 'functions/Session.php';

if (!isLoggedIn()) {
    die();
}

$id = (int)$_GET["id"];

require_once 'functions/ToolBar.php';
require_once 'classes/PdoContainer.php';
require_once 'classes/Message.php';

makeToolBar();

$pdo = PdoContainer::getPdo();

$getData =  $pdo->prepare('SELECT message, date FROM message WHERE userId = :id');
$getData->execute([":id" => $id]);

$data = $getData->fetchAll();


if ($data) {
    for ($i = 0; $i < sizeof($data); $i++) {
        $text = $data[$i]["message"];
        $date = $data[$i]["date"];

        $message = new Message($text, $date);
        $message->echo();
    }
} else {
    echo "<h1> no messages </h1>";
}
?>
<link rel="stylesheet" href="style.css">
