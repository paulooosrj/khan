<?php

    namespace MyApp;

    class HomeController extends \App\Khan\Bootstrap\KhanController {

        public function index($req, $res, $db){
            echo 'Ola mundo!!'.
        }

        public function getDB(){
            return $this->db;
        }

    }
