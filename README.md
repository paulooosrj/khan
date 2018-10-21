<p align="center"><img src="https://i.imgur.com/rjBZUWM.png" alt="Khan Framework" width="420"/></p>

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
  #### Readme in [English](https://github.com/PaulaoDev/khan/blob/master/resources/contributing/README-en.md)

  ### Documentaçao
  Uma documentação completa do sistema está disponível online [neste link](https://paulaodev.github.io/khan/resources/docs/).

  - [Core do Projeto](https://github.com/PaulaoDev/khan-core)
  
  ### Requisitos de sistema
 - [PHP](http://php.net/downloads.php) >= 7.1.
 - MySQL >= 5.0.
 - [Composer](https://getcomposer.org/download/).

  ### Instalar
  - Download [Zip](https://github.com/PaulaoDev/khan/archive/master.zip)
  ```bash 
    # download zip
    $ git clone https://github.com/PaulaoDev/khan khan-project && cd khan-project && composer install
    
    # using cli khan
    $ php khan list
       
    # download usando cli khan
    $ php khan create khan-project && cd khan-project && composer install
    
    # instala dependencias e inicia o servidor
    $ composer install

    # so funciona em php 7
    $ php khan server
    
  ```
  
  

  ### Linha de comando
  ```bash
  $ php khan list
  ```

  ### Novidades
  <p align="center"><img src="https://i.imgur.com/H4GhPPE.png" alt="LiveServer" width="750"/></p>
  
  
  ```bash
  # Iniciar o auto servidor
  $ php khan live
  ```

 ### Contribuiçoes
 - Envie relatórios de erros, sugestões e solicitações de upload para o [rastreador de problemas do GitHub](https://github.com/PaulaoDev/khan/issues).
 - Leia o [arquivo](https://github.com/PaulaoDev/khan/blob/master/resources/contributing/CONTRIBUTING.md).
  
  ### Geradores
  ```bash 
    # execute o comando no qual a estrutura está configurada
    
    # gera o sistema de login
    $ khan make auth
    
    # gera o sistema de chat
    $ khan make chat
  ```

 ### Sobre Khan
Khan é um framework de aplicações web. Acreditamos que o desenvolvimento deve ser uma experiência boa e não cansativa para ser verdadeiramente produtivo. O Khan simplifica o desenvolvimento, facilitando tarefas comuns usadas na maioria dos projetos da web, incluindo:
 
 - 🖥 [Khan CLI](https://github.com/PaulaoDev/khan-cli)
 - 🏎 Rapida criação de API's
 - 🤓 Sistema inteligente na criaçao de Controllers
 - 🛣 [Mecanismo de rotas rápido de aprender e novas funcionalidades](https://github.com/PaulaoDev/khan-core/blob/master/src/Khan/Component/Router/src/Router/Router.php)
 - 🛠 Componentes para utilizar ( Router, Stream, Container, Hooks )
 - 📗 [Helpers para sua aplicação (Medoo PDO, Twig Engine View, Symfony, Carbon Date Manipulate)](https://github.com/PaulaoDev/khan-core/blob/master/composer.json)
 - 💉 [Injeção de dependência rápida](https://github.com/PaulaoDev/khan-core/blob/master/src/Khan/Component/Container/ServiceContainer.php)
 - ⚙ [Websockets](https://github.com/PaulaoDev/khan-core/blob/master/src/Khan/Component/Socket/Socket.php)
 
 ### Benchmarks
 
 | Framework        | Requisições por segundo           | Versão do Framework  |  Versão do PHP  |
| ------------- |:-------------:|:-------------:|-----:|
| Khan      | 220.41 | 2.0 | 5.6 |
| Laravel      | 66.57      |   5.6 | 5.6 |
| Symfony |   81.78    |   3.3.6 | 5.6 |


----------------------


| Framework        | Requisições por segundo           | Versão do Framework  |  Versão do PHP  |
| ------------- |:-------------:|:-------------:| -----:|
| Khan      | 374 | 2.0 | 7.0 |
| Laravel      |    114.55   |   5.6 | 7.0 |
| Symfony |   184.15    |   3.3.6 | 7.0 |
 
### Atenção
Para que o sistema funcione 100% é necessário ter um Virtual Host configurado em seu localhost ou diretamente na pasta ROOT de uma hospedagem.

  ### Routes
  Configure rotas no arquivo **config/routes.php**
   ```php
use App\Khan\Component\Router\Router;

Router\get('/home', function($req, $res){ 
        return "Home"; 
});
Router\post('/home', function($req, $res){ 
        return "Home"; 
});
Router\delete('/home', function($req, $res){ 
        return "Home"; 
});
Router\put('/home', function($req, $res){ 
        return "Home"; 
});
Router\patch('/home', function($req, $res){ 
        return "Home"; 
});
Router\temp('/home', function($req, $res){ 
        return "Home"; 
});
   ```
   
   ### Segurança
   Relacionar todas as vulnerabilidades encontradas de maneira responsável e construtiva [Email](jskhanframework@gmail.com).
   
   ### Creditos
   
   
 - [Twig](https://github.com/twigphp/Twig).
 - [Medoo](https://github.com/catfan/Medoo).
 - [Symfony](https://github.com/symfony/symfony).
 - [PHP ML](https://github.com/php-ai/php-ml).
 - [Carbon](https://github.com/briannesbitt/Carbon).
  
  ### Licença
  O Khan é licenciado sob a licença do MIT. Veja o [arquivo de licença](https://github.com/PaulaoDev/khan/blob/master/LICENSE) para mais informaçoes.
  
  ### Contato
   - [Facebook](https://fb.com/PauloRodriguesYT).
   - [Whatsapp](https://bit.ly/whatsappdopaulo).
