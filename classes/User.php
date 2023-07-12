<?php
require_once 'Echoable.php';

class User implements Echoable
{
    private string $name;
    private int $id;

    function __construct(string $name, int $id) {
        $this->name = $name;
        $this->id = $id;
    }

    public function echo(): void
    {
        echo "<a href='/prog/otherBoard.php?id=";
        echo $this->id;
        echo "' >";
        echo $this->name;
        echo "</a> <br/>";
    }
}