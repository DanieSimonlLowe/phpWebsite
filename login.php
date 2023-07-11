<?php
require_once 'functions/Session.php';
require_once 'functions/ToolBar.php';
require_once 'classes/PdoContainer.php';

$name = '';
$password = '';
$error = '';

function login(string $name, string $password): void {
    global $error;
    $pdo = PdoContainer::getPdo();


    $getData = $pdo->prepare('SELECT password, session, id FROM users where username = :name');
    if (!$getData->execute([':name' => $name]) ) {
        $error = 'server problem. code:1';
        return;
    }
    $date = $getData->fetchAll();

    if (!$date) {
        $error = 'incorrect password or username';
        return;
    }
    if (password_verify($date[0]["password"], $password)) {
        $error = 'incorrect password or username';
        return;
    }
    if ($date[0]["session"]) {
        $error = 'that user is all ready logged in on another session.';
        return;
    }

    $id = $date[0]["id"];

    try {
        $session = bin2hex(random_bytes(30));
    } catch (Exception $e) {
        $error = 'server problem. code:2';
        return;
    }


    $update = $pdo->prepare('UPDATE users SET session = :session WHERE username = :name',[]);
    if (!$update->execute([':session' => $session, ':name' => $name])) {
        $error = 'server problem. code:3';
        return;
    }

    $error = 'logged in';
    setUser($session, $id);
    $url = '/prog/index.php';
    header('Location: '.$url);
    die();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"]) || empty($_POST["password"])) {
        $error = 'enter your password and username to login.';
    } else {
        $name = $_POST["name"];
        $password = $_POST["password"];

        login($name, $password);
    }
}

makeToolBar();

?>
<link rel="stylesheet" href="style.css">
<h1>
login
</h1>

<form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  >
    Username:
    <input type="text" name="name" value="<?= $name;?>" /> <br/>
    Password:
    <input type="text" name="password" value="<?= $password;?>"/> <br/>
    <input type="submit" name="submit" value="Submit">
</form>
<p> <?= $error ?> </p>