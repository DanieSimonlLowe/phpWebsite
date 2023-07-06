<?php

class PdoContainer
{
    private static ?PDO $pdo = null;

    static function getPdo(): PDO {
        if (is_null(PdoContainer::$pdo)) {
            $host = 'localhost';
            $dbname = 'test';
            $username = 'tester';
            $password = 'PhtV-ktWw8Twg_dH';

            PdoContainer::$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            PdoContainer::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return PdoContainer::$pdo;
    }
}