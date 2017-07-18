-------------------------------


![alt text](https://i.imgur.com/9bNPdrP.gif "Logo RouterKhan")


-------------------------------


# RouterKhan
- Sistema de Router para PHP


-------------------------------


  ### Rotas Gets
  
  
  ```php
  
    $router->get("/", function($req, $res){
		$res->sendStatus(200);
		$res->send("Home, Inicio!!");
	});
	
	
  ```
  
  
  ```php
  
  
    $router->get("/home", function($req, $res){
		$res->sendStatus(200);
		$res->sendFile("home.html");
	});
	
	
  ```
  
  
  ------------------------------------------------
  
  
  ### Rotas Posts 
  
  ```php
  	$router->post('/cadastro', function($req, $res){
		$res->send("Metodo Post");
		print_r($req->post('nome'));
	});
   ```
  
  
  ------------------------------------------------
    
  
  ### Rotas Com Parametros
  
  ```php
  	$router->params("/home/:meu/:nome", function($req, $res){
		$res->sendStatus(200);
		$res->send($req->params('meu')." ".$req->params('nome'));
	});
   ```
  
  
  ------------------------------------------------
  
  
   ### Inicia Router
   
   
   ```php
  	$router->Run();
   ```
   
  
   ------------------------------------------------
