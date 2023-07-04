<?php

require 'PageButton.php';

class ToolBar
{
    private array $pageButtons;

    function __construct(array $input) {
        $this->pageButtons = array();
        foreach ($input as $title => $link) {
            array_push($this->pageButtons, new PageButton($link,$title));
        }
    }

    function get_html() {
        echo "<div class='topnav'>";
        foreach ($this->pageButtons as $pageButton) {
            $pageButton->get_html();
        }
        echo "</div>";
    }
}