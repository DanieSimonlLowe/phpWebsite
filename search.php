<?php
require_once 'functions/Session.php';

if (!isLoggedIn()) {
    die();
}

require_once 'functions/ToolBar.php';
require_once 'classes/PdoContainer.php';
require_once 'classes/User.php';

makeToolBar();

$search = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search = $_POST["search"];
}

?>
<link rel="stylesheet" href="style.css"/>
<br/>
<form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  >
    <input type="text" name="search"> </input>
    <input type="submit" value="Submit">
</form>


<?php
$pdo = PdoContainer::getPdo();

if (empty($search)) {
    $getData = $pdo->prepare("SELECT id, username FROM users");
    $getData->execute();
} else {
    $getData = $pdo->prepare("SELECT id, username FROM users WHERE username Like CONCAT('%',:search,'%')");
    $getData->execute([":search" => $search]);
}
$data = $getData->fetchAll();


if ($data) {
    $userId = getUserId();
    for ($i = 0; $i<sizeof($data); $i++) {
        $id = $data[$i]["id"];
        if ($id == $userId) {
            continue;
        }
        $name = $data[$i]["username"];
        $user = new User($name,$id);
        $user->echo();
    }
}

?>
