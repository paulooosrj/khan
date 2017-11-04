(function($){

			$(document).ready(function(){

				let unserialize = (serialize) => {
					console.log(serialize);
					let obj = {};
				    serialize.map((value, key) => {
				    	obj[value.name] = value.value;
				    });
				    return obj;
				},
				validation = (n1, n2) => n1 === n2,
				redir = (href, time) => setTimeout(() => location.href = href, time),
				reload = (time) => setTimeout(() => location.reload(), time),
				validationMessage = (message, def) => {
					if(message === "sucesso"){
						if(message == "Login"){
							redir('./painel', 3500);
						}else{
							redir('./', 3500);
						}
						return `<p class='text-white bg-success' style='padding:10px'>${def} feito com Sucesso!</p>`;
					}else{
						reload(3500);
						return `<p class='text-red bg-success' style='padding:10px'>Erro ao fazer ${def}!</p>`;
					}
				};

				$(".login-form").submit(function(e){
					e.preventDefault();
					$.ajax({
						"url": "./login-auth",
						"type": "POST",
						"data": unserialize($(this).serializeArray()),
						success(res){
							$(validationMessage(res, 'Login')).insertBefore(".loginmodal-container>h1");
						}
					});
				});

				$(".cadastro-form").submit(function(e){
					e.preventDefault();

					var data = unserialize($(this).serializeArray());

					if(
						validation(data["email"], data["email-repeat"]) && 
						validation(data["senha"], data["senha-repeat"])
					){
						$.ajax({
							url: "./register-auth",
							type: "POST",
							contentType: false,
    						processData: false,
							data: new FormData($(".cadastro-form")[0]),
							success(res){
								$(validationMessage(res, 'Cadastro')).insertBefore(".loginmodal-container>h1");
							}
						});
					}
					
				});

			});

})(jQuery);