<p align="center"><img src="https://i.imgur.com/C9Bc0FU.png" alt="ChatBotPHP"/></p>

<p align="center">

[![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg)](https://raw.githubusercontent.com/PaulaoDev/router-khan/master/LICENSE)
[![GitHub stars](https://img.shields.io/github/stars/PaulaoDev/router-khan.svg)](https://github.com/PaulaoDev/ChatBot-PHP-Facebook/stargazers)
[![GitHub forks](https://img.shields.io/github/forks/PaulaoDev/router-khan.svg)](https://github.com/PaulaoDev/ChatBot-PHP-Facebook/fork)
[![GitHub issues](https://img.shields.io/github/issues/PaulaoDev/router-khan.svg)](https://github.com/PaulaoDev/ChatBot-PHP-Facebook/issues)
[![GitHub watchers](https://img.shields.io/github/watchers/badges/shields.svg?style=social&label=Watch)](https://github.com/PaulaoDev/router-khan/subscription)
[![Whatsapp](https://img.shields.io/badge/Whatsapp-On-green.svg)](https://bit.ly/whatsappdopaulo)
[![Donate Paypal](https://img.shields.io/badge/Donate-PayPal-green.svg)](https://goo.gl/ujU2QU)
[![Donate Bitcoin](https://img.shields.io/badge/Donate-Bitcoin-yellow.svg)](https://blockchain.info/address/37RWdwgsXK94pANXm9fHv722k4zQmtmCpH)
</p>

-----------------------

  ### Install With Composer:
  `composer require "paulao-dev/router-khan":"*"`


 ### About RouterKhan
 RouterKhan is a web application framework. We believe that development must be a good and not tiresome experience to be truly productive. RouterKhan streamlines development by easing common tasks used in most web projects, including:
 
 - [Simple routing engine, easy to learn, fast, and with two-step verification for parameters.](https://github.com/PaulaoDev/router-khan/blob/master/src/RouterKhan/RouterKhan.php)
 - [Helpers for your application (Medoo PDO, Twig Engine View, Symfony, Carbon Date Manipulate)](https://github.com/PaulaoDev/router-khan/blob/master/composer.json)
 - [Fast Dependency injection container](https://github.com/PaulaoDev/router-khan/blob/master/src/Container/ServiceContainer.php)
 - [Stream Service]()https://github.com/PaulaoDev/router-khan/blob/master/src/Stream/StreamServer.php



## Learning RouterKhan

A Login / Registration with Panel and image upload system was done to demonstrate the operation of the system while the documentation is being made.
[Instalation](https://github.com/PaulaoDev/router-khan/tree/master/resources/instalation.txt)


  ### GETS Routes
  
  
  ```php
  
    $router->get(/* String or Array routes */, /* Class, Array or Closure */);
    /* Route new class */
    $router->get('/', 'MyApp\Controllers\myClass');
    /* Route class method */
    $router->get('/', 'MyApp\Controllers\myClass@method');
    /* Route class static method */
    $router->get('/', 'MyApp\Controllers\myClass::method');
    /* Route mutiples in same Callback */
    $router->get(['/', '/foo'], 'MyApp\Controllers\myClass::method');
    /* Route mutiples in same Callback */
    $router->get(['/', '/foo'], ['MyApp\Controllers\myClass::method','MyApp\Controllers\myClass@method']);
    /* Mutiples Routes */
    $router->get(['/' => 'MyApp\Controllers\myClass::method','/foo' => 'MyApp\Controllers\myClass@method']);
    /* Using Closure */
    $router->get('/', function($req, $res){ });
    /* Using Closure in Mutiples Methods */
    $router->get(['/' => function($req, $res){ },'/foo' => function($req, $res){ }]);
  
  ```
  
  
  ------------------------------------------------
  
  
  ### POSTS Routes
  
  ```php
    $router->post(/* String or Array routes */, /* Class, Array or Closure */);
    /* Route new class */
    $router->post('/', 'MyApp\Controllers\myClass');
    /* Route class method */
    $router->post('/', 'MyApp\Controllers\myClass@method');
    /* Route class static method */
    $router->post('/', 'MyApp\Controllers\myClass::method');
    /* Route mutiples in same Callback */
    $router->post(['/', '/foo'], 'MyApp\Controllers\myClass::method');
    /* Route mutiples in same Callback */
    $router->post(['/', '/foo'], ['MyApp\Controllers\myClass::method','MyApp\Controllers\myClass@method']);
    /* Mutiples Routes */
    $router->post(['/' => 'MyApp\Controllers\myClass::method','/foo' => 'MyApp\Controllers\myClass@method']);
    /* Using Closure */
    $router->post('/', function($req, $res){ });
    /* Using Closure in Mutiples Methods */
    $router->post(['/' => function($req, $res){ },'/foo' => function($req, $res){ }]);
  });
   ```
  
  
  ------------------------------------------------
    
  
  ### Parameters in Router
  
  ```php
        $router->params(/* String or Array routes */, /* Class, Array or Closure */);
    /* Route new class */
    $router->params('/profile/{id}', 'MyApp\Controllers\myClass');
    /* Route class method */
    $router->params('/{id}/home', 'MyApp\Controllers\myClass@method');
    /* Route class static method */
    $router->params('/home/{id}/{video_id}', 'MyApp\Controllers\myClass::method');
    /* Route mutiples in same Callback */
    $router->params(['/{id}/home', '/home/{id}/{video_id}'], 'MyApp\Controllers\myClass::method');
    /* Route mutiples in same Callback */
    $router->params(['/{id}/home', '/home/{id}/{video_id}'], ['MyApp\Controllers\myClass::method','MyApp\Controllers\myClass@method']);
    /* Mutiples Routes */
    $router->params(['/{id}/home' => 'MyApp\Controllers\myClass::method','/home/{id}/{video_id}' => 'MyApp\Controllers\myClass@method']);
    /* Using Closure */
    $router->params('/home/{id}/{video_id}', function($req, $res){ });
    /* Using Closure in Mutiples Methods */
    $router->params(['/home/{id}/{video_id}' => function($req, $res){ },'/{id}/home' => function($req, $res){ }]);
   ```
  
  
  ------------------------------------------------

  
  ### PUT Router
  
  ```php
     $router->put(/* String or Array routes */, /* Class, Array or Closure */);
    /* Route new class */
    $router->put('/', 'MyApp\Controllers\myClass');
    /* Route class method */
    $router->put('/', 'MyApp\Controllers\myClass@method');
    /* Route class static method */
    $router->put('/', 'MyApp\Controllers\myClass::method');
    /* Route mutiples in same Callback */
    $router->put(['/', '/foo'], 'MyApp\Controllers\myClass::method');
    /* Route mutiples in same Callback */
    $router->put(['/', '/foo'], ['MyApp\Controllers\myClass::method','MyApp\Controllers\myClass@method']);
    /* Mutiples Routes */
    $router->put(['/' => 'MyApp\Controllers\myClass::method','/foo' => 'MyApp\Controllers\myClass@method']);
    /* Using Closure */
    $router->put('/', function($req, $res){ });
    /* Using Closure in Mutiples Methods */
    $router->put(['/' => function($req, $res){ },'/foo' => function($req, $res){ }]);
   ```
  
  
  ------------------------------------------------

  
  ### DELETE Router
  
  ```php
     $router->delete(/* String or Array routes */, /* Class, Array or Closure */);
    /* Route new class */
    $router->delete('/', 'MyApp\Controllers\myClass');
    /* Route class method */
    $router->delete('/', 'MyApp\Controllers\myClass@method');
    /* Route class static method */
    $router->delete('/', 'MyApp\Controllers\myClass::method');
    /* Route mutiples in same Callback */
    $router->delete(['/', '/foo'], 'MyApp\Controllers\myClass::method');
    /* Route mutiples in same Callback */
    $router->delete(['/', '/foo'], ['MyApp\Controllers\myClass::method','MyApp\Controllers\myClass@method']);
    /* Mutiples Routes */
    $router->delete(['/' => 'MyApp\Controllers\myClass::method','/foo' => 'MyApp\Controllers\myClass@method']);
    /* Using Closure */
    $router->delete('/', function($req, $res){ });
    /* Using Closure in Mutiples Methods */
    $router->delete(['/' => function($req, $res){ },'/foo' => function($req, $res){ }]);
   ```
  
  
  ------------------------------------------------
  
  
   ### Init Router
   
   
   ```php
    $router->dispatch();
   ```
   
  
   ------------------------------------------------
