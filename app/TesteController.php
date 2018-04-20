<?php

    namespace MyApp;

    use App\Khan\Component\Container\ServiceContainer as Container;
    use App\Khan\Component\Stream\StreamServer as Stream;
    use App\Khan\Component\DB\DB as Database;

    class TesteController {

        public function index($req, $res){
            
            return new Models\MyModel();

        }

    }
