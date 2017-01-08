<?php
class Form
{
    public function  __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function index() {
        echo "<h1>here is my form class</h1>";
    }

    public function save($data) {

        $stm = 'INSERT INTO users (name, yomi) VALUES (:name, :yomi)';
        $sth = $this->pdo->perform($stm, $data);
        echo $sth->queryString;
        return $sth;
        /*
        $sth = $this->pdo->prepare($stm);
        $sth->execute($data);
         */
    }
}
