$(


	
	function(){

		$('#arquivo').change(function(){

			  var files=$(this).prop('files');
			console.log(files);
			  var src = URL.createObjectURL(files[0]);
			  $('#teste').attr("src", src);
		

		});

		

			resultado=$('#resultado').attr('alt');

			if(resultado=="ok"){

				$('#testeModal').modal('show');
			}
		
				
		$('#excluir_button').click(function(){

			$('#testeModal').modal('show');
		});	

		$('#excluir_confirmado').click(function(){

			var dados={id: $('#id_produto').attr('alt')};

			$.post("excluir_produto.php", dados, function(retornaCadastro){

				console.log(retornaCadastro)
				if(retornaCadastro=='ok'){

					$('#exclui_sucesso').modal('show');
				}
			});


		});
		$('.esconderModal').click(function(){

			$('#testeModal').modal('hide');
		});
	
	}
);