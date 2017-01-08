<?php
class Form
{
    public function  __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function index() {
        echo "<h1>here is my form class</h1>";
    }

    public function save() {

        $name = array("wa'ka'da");
        $stm = 'INSERT INTO users  (name) VALUES (:name)';
        $bind_values = array('name' => $name);
        $sth = $this->pdo->perform($stm, $bind_values);
        echo $sth->queryString;
    }
}
