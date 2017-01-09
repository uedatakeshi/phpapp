<?php
class Form extends Model
{
    public function  __construct() {
        parent::__construct();
    }

    public function index() {
        echo "<h1>here is my form class</h1>";
    }

    public function save($data) {

        //$this->pdo->getProfiler()->setActive(true);
        $stm = 'INSERT INTO users (name, yomi) VALUES (:name, :yomi)';
        $sth = $this->pdo->perform($stm, $data);
        /*
        echo $sth->queryString;
        foreach ($this->pdo->getProfiler()->getProfiles() as $i => $profile) {
            var_dump($profile);
        }
         */

        return $sth;

        /*
        $sth = $this->pdo->prepare($stm);
        $sth->execute($data);
         */
    }
}
