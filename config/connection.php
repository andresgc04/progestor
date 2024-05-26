<?php
session_start();

class Connection
{
    protected $dbh;

    protected function Connection()
    {
        try {
            $connection = $this->dbh = new PDO("mysql:local=localhost;dbname=progestorDB", "root", "");

            return $connection;
        } catch (Exception $error) {
            print '¡Error BD!: ' . $error->getMessage() . '<br/>';
            die();
        }
    }

    public function set_names()
    {
        return $this->dbh->query("SET NAMES 'utf8'");
    }

    public function path() {
        return "http://localhost/progestor/";
    }
}
