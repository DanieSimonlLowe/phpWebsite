<?php

require_once 'Echoable.php';


class PageButton implements Echoable
{
    public string $title;
    public string $link;

    function __construct(string $link, string $title) {
        $this->link = $link;
        $this->title = $title;
    }

    public function echo(): void {
        $url = $_SERVER['REQUEST_URI'];
        if ($url == $this->link) {
            echo "<a class='page_button_active'> ";
            echo $this->title;
            echo '</a>';
        } else {
            echo "<a class='page_button_not_active' href='";
            echo $this->link;
            echo "'> ";
            echo $this->title;
            echo '</a>';
        }
    }
}