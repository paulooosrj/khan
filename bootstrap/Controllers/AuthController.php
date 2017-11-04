<?php 

	
	namespace MyApp\Controllers;
	use MyApp\Models\Files as Files;

	class AuthController{

		public static function validationUser($req, $email){
			$query = $req->db()->select('users', "*", [
			    'email' => $email,
			    'LIMIT' => 1
			]);
			return (count($query) > 0) ? $query[0] : false;
		}

		public static function login($req, $res){
			$verify = AuthController::validationUser($req, $req->post('email'));
			if($verify){
				if(password_verify($req->post('senha'), $verify['senha'])){
					$req->Session()::set('nome', $verify['nome']);
					$req->Session()::set('email', $verify['email']);
					$req->Session()::set('id', $verify['id']);
					$req->Session()::set('icone', $verify['icone']);
					$req->Session()::set('nivel', $verify['nivel']);
					echo "sucesso";
				}else{
					echo "erro";
				}
			}
		}

		public static function register($req, $res){

			$verify = AuthController::validationUser($req, $req->post('email'));

			if(!$verify){

				$upload = Files::create();
				$file = $req->files('icone');
				$icone = 'http://localhost/RouterKhan/';
				$iconeBuffer = $icone;
				$path_up = "resources/images_upload";
				
				if($file && count($file) > 0){
				  if(
				  	$upload->isType($file, "png") || 
				  	$upload->isType($file, "jpg")){
				   	if(
				   		$upload->sizeMax(/*5MB*/ 5, $file) && 
				   		!$upload->exists($path_up, $file, true)
				   	){
				   	   $icone .= $upload->move($file, $path_up, true);
				   	}
				  }
				}

				if($icone == $iconeBuffer){ 
					$icone .= "resources/images_upload/default.png"; 
				}

				$nivel = 0;
				if(isset($_POST['nivel'])){ $nivel = $req->post('nivel'); }

				$req->db()->insert('users',[
				    'email' => $req->post('email'),
				    'nome' => $req->post('nome'),
				    'senha' => password_hash($req->post('senha'), PASSWORD_BCRYPT, ['cost' => 12]),
				    'icone' => $icone,
				    'nivel' => $nivel
				]);

				echo "sucesso";

			}else{
				echo "erro";
			}
		}

	}