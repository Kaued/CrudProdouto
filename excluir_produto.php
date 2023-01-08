<?php 

			include "conexao.php";

	try{

		$id=$_POST["id"];

		$pastaArquivos="backupImagens/"; 

		$comandoSql1= "select imagem from tb_produto where id_produto=$id";

		$resultado1= mysqli_query($con, $comandoSql1);

			
		$dados=mysqli_fetch_assoc($resultado1);
		$i=$dados["imagem"];

		$comandoSql2="delete from tb_produto where id_produto=$id";
		$resultado2= mysqli_query($con, $comandoSql2);

		if($resultado2){
				//excluindo o arquivo do upload da pasta backup imagem

			unlink($pastaArquivos.$i);
			echo "ok";

		}
	}catch(Exception $erro){

		$dateError=date("Y-m-d H:i:s");
    $messageError="\n".$dateError.":[".$erro."]\n";
    error_log($messageError, 3 ,"logerror.txt");
		
	}

				
?>
