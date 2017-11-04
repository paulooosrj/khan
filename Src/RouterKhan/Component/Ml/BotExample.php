<?php
	
	use App\RouterKhan\Component\Ml\Ml as Ml;

	$router->params('/bot/{type}', function($req, $res){

		// Define o icone do RouterKhan
		$res->setContent('<link rel="icon" href="http://localhost/RouterKhan/resources/images/favicon.png" type="image/png"><title>RouterKhan - Bot</title>');
		$res->send();

		// Chama a classe no Padrão Singleton
		$bot = Ml::create();
		// Mensagem padrao para verificaçao
		$receive = "Eu sou Brasileiro";
		// Mensagens para Verificar a Semelhança com a Mensagem Padrao
		$entrys = [
			"Ola mundo",
			"Eai beleza?",
			"Eai men beleza??"
		];

		// Pega o Tipo de Teste
		$type = $req->params('type');

		// Mensagem DEFAULT Caso nenhuma das passadas no $entrys seja parecida.
		$default = "Nenhuma resposta parecida!!";

		if($type === "default" && $type !== ""){
			$entrys[] = "Test message";
			$run = $bot->simility(
				/* Array [ Mensagens para a verificaçao ] */ $entrys, 
				/* String [ Mensagem para verificar ] */ $receive, 
				/* String [ Mensagem padrão ] */ $default
			);
			print_r($run);
		} 

		elseif($type === "run" && $type !== ""){
			$entrys[] = "Eu sou brasileiro";
			// Verifica a semelhança.
			$run = $bot->simility(
				/* Array [ Mensagens para a verificaçao ] */ $entrys, 
				/* String [ Mensagem para verificar ] */ $receive, 
				/* String [ Mensagem padrão ] */ $default
			);
			print_r($run);
		}

		else{
			$message = "Escolha um tipo!! ";
			$message .= "<a href='./default'>Default</a> | ";
			$message .= "<a href='./run'>Run</a>";
			echo $message;
		}

	});