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
  
  
  ### Rotas Posts ( _Em Desenvolvimento_ )
  
  
  ------------------------------------------------
  
  
   ### Inicia Router
   
   
   ```php
  	$router->Run();
   ```
   
  
   ------------------------------------------------
