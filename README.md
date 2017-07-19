-------------------------------


![alt text](https://i.imgur.com/9bNPdrP.gif "Logo RouterKhan")


-------------------------------


# RouterKhan
[![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg)](https://raw.githubusercontent.com/PaulaoDev/router-khan/master/LICENSE)
[![GitHub stars](https://img.shields.io/github/stars/PaulaoDev/router-khan.svg)](https://github.com/PaulaoDev/ChatBot-PHP-Facebook/stargazers)
[![GitHub forks](https://img.shields.io/github/forks/PaulaoDev/router-khan.svg)](https://github.com/PaulaoDev/ChatBot-PHP-Facebook/fork)
[![GitHub issues](https://img.shields.io/github/issues/PaulaoDev/router-khan.svg)](https://github.com/PaulaoDev/ChatBot-PHP-Facebook/issues)
[![GitHub watchers](https://img.shields.io/github/watchers/badges/shields.svg?style=social&label=Watch)](https://github.com/PaulaoDev/router-khan/subscription)
[![Whatsapp](https://img.shields.io/badge/Whatsapp-On-green.svg)](https://bit.ly/whatsappdopaulo)
[![Donate Paypal](https://img.shields.io/badge/Donate-PayPal-green.svg)](https://goo.gl/ujU2QU)
[![Donate Bitcoin](https://img.shields.io/badge/Donate-Bitcoin-yellow.svg)](https://blockchain.info/address/37RWdwgsXK94pANXm9fHv722k4zQmtmCpH)



-----------------------

- Sistema de Router para PHP
     `$res->sendStatus($code);`  é uma funcão **OPCIONAL** nativa do sistema de Rotas. 

-----------------------


  ### Rotas Gets
  
  
  ```php
  
    $router->get("/", function($req, $res){
		$res->sendStatus(200);
		$res->send("Home, Inicio!!");
        // Pega Session
        // $res->session("minha session");
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
		$res->send($req->params('meu')." ".$req->params('nome'));
	});
   ```
  
  
  ------------------------------------------------

  
  ### Rotas PUT
  
  ```php
 $router->put("/update", function($req, $res){
    $res->sendStatus(200);
    $res->send($req->put('meuput'));
  });
   ```
  
  
  ------------------------------------------------

  
  ### Rotas DELETE
  
  ```php
 $router->params("/delete", function($req, $res){
    $res->sendStatus(200);
    $res->send($req->delete('meudelete'));
  });
   ```
  
  
  ------------------------------------------------
  
  
   ### Inicia Router
   
   
   ```php
  	$router->Run();
   ```
   
  
   ------------------------------------------------
