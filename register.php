<link rel="stylesheet" href="style.css">

<?php
require_once 'functions/ToolBar.php';
require_once 'classes/PdoContainer.php';

makeToolBar();

$name = '';
$password1 = '';
$password2 = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isValid = true;
    if (empty($_POST["name"])) {
        $error .= 'name is required.<br/>';
        $isValid = false;
    } else {
        $name = $_POST["name"];
    }
    if (empty($_POST["password1"])) {
        $error .= 'password1 is required.<br/>';
        $isValid = false;
    } else {
        $password1 = $_POST["password1"];
    }
    if (empty($_POST["password2"])) {
        $error .= 'password2 is required.<br/>';
        $isValid = false;
    } else {
        $password2 = $_POST["password2"];
    }
    if ($_POST["password1"] !== $_POST["password2"]) {
        $error .= 'password are not equal.<br/>';
        $isValid = false;
    } else if ($isValid) {
        #TODO setup sql.
        $pdo = PdoContainer::getPdo();

        try {

            $insert = $pdo->prepare('INSERT INTO users ( username, password) VALUES ( :name, :password)');
            $hash = password_hash($password1,null);

            if ($insert->execute([':name' => $name, ':password' => $hash])) {
                $error = 'registered';
            } else {
                $error = 'username already used';
            }
        } catch (Exception $e) {
            $error = 'failed to generate salt.';
        }

    }
 }

    ?>

<h1>
register
</h1>

<form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  >
    Username:
    <input type="text" name="name" value="<?= $name;?>" /> <br/>
    Password:
    <input type="text" name="password1" value="<?= $password1;?>"/> <br/>
    Retype Password:
    <input type="text" name="password2" value="<?= $password2;?>"/> <br/>
    <input type="submit" name="submit" value="Submit">
</form>
<p> <?= $error ?> </p>