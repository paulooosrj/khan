<p align="center"><img src="https://i.imgur.com/X9o9Za0.png" alt="ChatBotPHP" width="180"/></p>

<p align="center">
    <a href="https://scrutinizer-ci.com/g/PaulaoDev/khan/?branch=master"><img src="https://scrutinizer-ci.com/g/PaulaoDev/router-khan/badges/quality-score.png?b=master" alt="Passing"></a>
    <a href="https://scrutinizer-ci.com/g/PaulaoDev/khan/build-status/master"><img src="https://scrutinizer-ci.com/g/PaulaoDev/router-khan/badges/build.png?b=master" alt="Passing"></a>
    <a href="https://raw.githubusercontent.com/PaulaoDev/khan/master/LICENSE"><img src="https://img.shields.io/badge/license-MIT-blue.svg" alt="Passing"></a>
</p>

<p align="center">
    <a href="https://github.com/PaulaoDev/khan/stargazers"><img src="https://img.shields.io/github/stars/badges/shields.svg?style=social&label=Stars" alt="Stars"></a>
    <a href="https://packagist.org/PaulaoDev/khan"><img src="https://img.shields.io/packagist/php-v/symfony/symfony.svg" alt="Package"></a>
    <a href="https://github.com/PaulaoDev/khan/issues"><img src="https://img.shields.io/github/issues/badges/shields.svg" alt="Issues"></a>
</p>

-----------------------
#### Readme em [Portugues](https://github.com/PaulaoDev/khan/blob/master/README-en.md)

  ### Documentation
  A complete system documentation is available online [at this link](https://paulaodev.github.io/khan/docs/).
  
  ### System Requirements
 - [PHP](http://php.net/downloads.php) >= 7.1.
 - MySQL >= 5.0.
 - [Composer](https://getcomposer.org/download/).

  ### Install
  - Download [Zip](https://github.com/PaulaoDev/khan/archive/master.zip)
  ```bash 
    # download zip
    git clone https://github.com/PaulaoDev/khan khan-project && cd khan-project && composer install
    
    # install cli khan
    composer global require paulaodev/khan-cli 
       
    # download using cli khan
    khan create khan-project && cd khan-project && composer install
    
    # dependencies & run server
    composer install && khan server 80
    
  ```
  
  

  ### Command line
  ```console
  khan help
  ```

 ### Contribution
 - Send error reports, suggestions, and upload requests to the [GitHub issue tracker](https://github.com/PaulaoDev/khan/issues).
 - Read the [File](https://github.com/PaulaoDev/khan/blob/master/CONTRIBUTING.md).
  
  ### Generates
  ```bash 
    # run the command where the framework is configured
    
    # generates a login system
    khan make auth
    
    # generates a chat system
    khan make chat
  ```

 ### About Khan
 Khan is a web application framework. We believe that development must be a good and not tiresome experience to be truly productive. RouterKhan streamlines development by easing common tasks used in most web projects, including:
 
 - [Khan CLI](https://github.com/PaulaoDev/khan-cli)
 - [Simple routing engine, easy to learn, fast, and with two-step verification for parameters.](https://github.com/PaulaoDev/khan-core/blob/master/src/Khan/Component/Router/src/Router/Router.php)
 - [Helpers for your application (Medoo PDO, Twig Engine View, Symfony, Carbon Date Manipulate)](https://github.com/PaulaoDev/khan-core/blob/master/composer.json)
 - [Fast Dependency injection container](https://github.com/PaulaoDev/khan-core/blob/master/src/Khan/Component/Container/ServiceContainer.php)
 - [Stream Service](https://github.com/PaulaoDev/khan-core/blob/master/src/Khan/Component/Stream/StreamServer.php)
 - [Websockets](https://github.com/PaulaoDev/khan-core/blob/master/src/Khan/Component/Socket/Socket.php)
 
### Attention
For the system to work 100% it is necessary to have a Virtual Host configured in your localhost or directly in the ROOT folder of a hosting.

  ### Routes
  Create files with routes in directory **routes/**
  
  <p align="center"><img src="https://i.imgur.com/uo0p4ic.png" alt="Routes Khan"/></p>
   
   ### Security
   Relate all vulnerabilities found in a responsible and constructive way [Email](jskhanframework@gmail.com).
   
   ### Credits
   
   
 - [Twig](https://github.com/twigphp/Twig).
 - [Medoo](https://github.com/catfan/Medoo).
 - [Symfony](https://github.com/symfony/symfony).
 - [PHP ML](https://github.com/php-ai/php-ml).
 - [Carbon](https://github.com/briannesbitt/Carbon).
  
  ### License
  The RouterKhan is licensed under the MIT license. See [License File](https://github.com/PaulaoDev/khan/blob/master/LICENSE) for more information.
  
  ### Contact
   - [Facebook](https://fb.com/PauloRodriguesYT).
   - [Whatsapp](https://bit.ly/whatsappdopaulo).
