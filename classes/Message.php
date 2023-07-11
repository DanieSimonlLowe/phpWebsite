<?php

use Cassandra\Date;

require_once 'Echoable.php';

class Message implements Echoable
{
    private string $message;
    private string $date;

    function __construct($message, $date) {
        $this->message = $message;
        $this->date = $date;
    }

    public function echo(): void {
        echo '<div class="message">';

        echo '<h3>';
        echo $this->date;
        echo '</h3>';

        echo '<p>';
        echo $this->message;
        echo '</p>';

        echo '</div>';
    }
}