<?php

require_once 'PageButton.php';
require_once 'Echoable.php';


class ToolBar implements Echoable
{
    private array $pageButtons;

    function __construct(array $input) {
        $this->pageButtons = array();
        foreach ($input as $title => $link) {
            array_push($this->pageButtons, new PageButton($link,$title));
        }
    }

    public function echo(): void
    {
        echo "<div class='topnav'>";
        foreach ($this->pageButtons as $pageButton) {
            $pageButton->echo();
        }
        echo "</div>";
    }
}