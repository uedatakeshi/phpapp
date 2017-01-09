<?php
use Aura\Sql\ExtendedPdo;
use Aura\Sql\Profiler;

class Model
{
    public function  __construct() {

        $pdo = new ExtendedPdo(
            'mysql:host=localhost;dbname=sample_db',
            'root',
            'pass123',
            array(), // driver options as key-value pairs
            array()  // attributes as key-value pairs
        );
        $prof = new Profiler();
        $pdo->setProfiler($prof);

        $this->pdo = $pdo;
    }
}
