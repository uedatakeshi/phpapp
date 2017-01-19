<?php
class Form extends Model
{
    public function  __construct() {
        parent::__construct();
    }

    public function index() {
        echo "<h1>here is my form class</h1>";
    }

    /*
     * save user data method
     */
    public function save($data) {

        $stm = 'INSERT INTO users (name, yomi) VALUES (:name, :yomi)';
        $sth = $this->pdo->perform($stm, $data);

        return $sth;
    }

    /*
     * sample select sql with profiler
     */
    public function getOne() {
        $this->pdo->getProfiler()->setActive(true);

        $query = 'SELECT * FROM users WHERE id = :id';
        $bind = [
            'id' => 1 // ここを配列にするとProfilerに値が入った状態で表示される
        ];
        $result = $this->pdo->fetchAll($query, $bind);

        foreach ($this->pdo->getProfiler()->getProfiles() as $i => $profile) {
            var_dump($profile);
        }

        return $result;
    }

    /*
     * sample select sql with profiler
     */
    public function getTwo() {
        $this->pdo->getProfiler()->setActive(true);

        $query = 'SELECT * FROM users WHERE id IN (:id)';
        $bind = [
            'id' => [1,2]
        ];
        $result = $this->pdo->fetchAll($query, $bind);

        foreach ($this->pdo->getProfiler()->getProfiles() as $i => $profile) {
            var_dump($profile);
        }

        return $result;
    }

    /*
     * sample select sql with yield
     */
    public function yieldTwo() {

        $query = 'SELECT * FROM users WHERE id IN (:id)';
        $bind = [
            'id' => [1,2]
        ];

        $result = array();
        foreach ($this->pdo->yieldAssoc($query, $bind) as $key => $row) {
            $result[$key] = $row;
        }

        return $result;
    }
}
