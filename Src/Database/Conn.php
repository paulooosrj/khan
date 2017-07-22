<?php
	
	namespace Database;
    use PDO;

	class Conn {

   	 	# Variável que guarda a conexão PDO.
    	protected static $db = null;
    	# Private construct - garante que a classe só possa ser instanciada internamente.
    	private function __construct(){}
    	# Método estático - acessível para setar configuraçoes.
    	public static function setConfig($config = null){

    		# Informações sobre o banco de dados:
            $configs = array("DB_HOST", "DB_NAME", "DB_USER", "DB_PASS");
            $defaults = array_keys($config);
            if(array_diff($configs, $defaults) != null):
                die("Erro ao passar as Configuraçoes para conexão!!");
            endif;

            $db_host = $config["DB_HOST"];
            $db_nome = $config["DB_NAME"];
            $db_usuario = $config["DB_USER"];
            $db_senha = $config["DB_PASS"];
            $db_driver = (!isset($config["DB_DRIVER"])) ? "mysql" : $config["DB_DRIVER"];

            try{
                # Atribui o objeto PDO à variável $db.
                self::$db = new PDO("$db_driver:host=$db_host; dbname=$db_nome", $db_usuario, $db_senha);
                # Garante que o PDO lance exceções durante erros.
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                # Garante que os dados sejam armazenados com codificação UFT-8.
                self::$db->exec('SET NAMES utf8');
            } catch (PDOException $e){
                # Então não carrega nada mais da página.
                die("Connection Error: " . $e->getMessage());
            }

    	}
    	# Método estático - acessível sem instanciação.
   		public static function Conexao(){
        	# Garante uma única instância. Se não existe uma conexão, criamos uma nova.
        	if (!self::$db){
            	new Database();
        	}
        	# Retorna a conexão.
       	 	return self::$db;
    	}

	}