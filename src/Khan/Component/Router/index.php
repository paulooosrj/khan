<?php 


    require __DIR__ . '/vendor/autoload.php';
    
    use KhanComponent\Router\Router as Router;

    $router = Router::create([
      "clean_request" => true,
      "url_filter" => true
    ]);

    // $router->set('views', 'views/');
    
    $router::get('/', function($req, $res){ 
      $nome = $req->get('nome');
      $nome = (strlen($nome) > 2) ? $req->get('nome') : "Root Name";
      $res->render('index.html', [ 'nome' => $nome ]);
    });

    $router::params('/{id}/home', function($req, $res){ 
        echo "Default!! ID : {$req->params('id')}";
    });

    $router->dispatch();