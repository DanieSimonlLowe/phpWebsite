<?php
require_once 'functions/Session.php';

$error = '';

if (!isLoggedIn()) {
    die();
}


if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
    if (isLoggedInValid()) {

        $message = $_POST["message"];
        var_dump($message);

        if (empty($message)) {
            $error = 'enter in a message to save.';
        } else {
            $pdo = PdoContainer::getPdo();
            $insert = $pdo->prepare("INSERT INTO message ( message, userId) VALUES (:message, :user)");
            $insert->execute([":message" => $message, ":user" => getUserId()]);

            $error = "inserted";
        }
    } else {
        $error = 'you are not logged in properly. log out and log back in.';
    }
}

require_once 'functions/ToolBar.php';
require_once 'classes/PdoContainer.php';
require_once 'classes/Message.php';

makeToolBar();

$hash = getUserSession();
$id = getUserId();


?>

<link rel="stylesheet" href="style.css">
<br/><br/>
<form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  >
    <textarea rows="5" cols="50" name="message"></textarea>
    <input type="submit" value="Submit">
</form>
<p> <?= $error ?> </p>

<?php

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
