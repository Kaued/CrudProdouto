<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Cadastro de Produto</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
 
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <!--JQuery, Popper e Bootstrap.min.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"> </script>
  
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

   <script type="text/javascript" src="teste.js"> </script>

  </head>

  <body>

    <?php

    include "menu.php";
  ?>

  <div class="modal fade" id="testeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastrado com sucesso</h5>
        <button type="button" class="close esconderModal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        O produto foi cadastrado com sucesso
      </div>
      <div class="modal-footer">
        <a href="pesquisarProduto.php">
        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
      </a>
              </div>
    </div>
  </div>
</div>
  
  <p>
    <?php


      include "conexao.php";

      $id=$_GET["id"];

      try{
        $pastaArquivos="backupImagens/";

        $comandoSQL1="select * from tb_produto where id_produto= $id";

        $resultado1= mysqli_query($con, $comandoSQL1);

        $dados=mysqli_fetch_assoc($resultado1);

        $id= $dados ["id_produto"];
        $d= $dados ["descricao"];
        $i= $dados ["imagem"];


        
        if(isset($_POST['alterar'])){

          header("pesquisarProduto.php");

        

          if($_POST['descricao']!=""){

              
            if(($_FILES['arquivo']['name']!="")){

              unlink($pastaArquivos.$i);
              $nomeArquivo=$_FILES["arquivo"]["name"];
              $nomeTemporario=$_FILES["arquivo"]["tmp_name"];

              //echo "nome do arquivo $nomeArquivo";
              //echo "<br/> nome do arquivo temporario $nomeTemporario";

              if(move_uploaded_file($nomeTemporario, $pastaArquivos.$nomeArquivo)){

                $descricao=$_POST['descricao'];
                
                $comandoSQL="update tb_produto set descricao='".$descricao."', imagem='".$nomeArquivo."' where id_produto='".$id."'";
              
                $resultado=mysqli_query($con, $comandoSQL);


                echo "<div id='resultado' style='display: none;' alt='ok'></div>";
                

            }
            }else{

                $descricao=$_POST['descricao'];
                
                $comandoSQL="update tb_produto set descricao='".$descricao."' where id_produto='".$id."'";
                

                $resultado=mysqli_query($con, $comandoSQL);
              
                echo "<div id='resultado' style='display: none;' alt='ok'></div>";
            }
          }else

          echo "Não tem descricao";
        }
      }catch(Exception $erro){

        $dateError=date("Y-m-d H:i:s");
        $messageError="\n".$dateError.":[".$erro."]\n";
        error_log($messageError, 3 ,"logerror.txt");
      }
   

  if(isset($id) && isset($d) && isset($i)){
?>


 <div class="container">
        <div class="col-md-6 offset-md-3">
          <h3> Cadastro de Produto </h3> 
        </div>
        <form action="" method="POST" enctype="multipart/form-data">
    <!-- quando o objeto do tipo file (input type=file) é utilizado, se faz necessário usar a codificação
         multipart/form-data no atributo enctype da criação do formulario -->
        
       
        <div class="form-group">
         <div class="col-md-6 offset-md-3">
           <label> Descrição</label>
           <input type="text" id="descricao" name="descricao" class="form-control" value="<?php echo $d ?>" >
         </div>
      </div>
    <br>
    
     <div class="form-group">
         <div class="col-md-6 offset-md-3">
           <label for="formFile" class="form-label"> Imagem</label>
         <input class="form-control" type="file" name="arquivo" id="arquivo">
       </div>
    </div>
    <br>
    <div class="col-md-6 offset-md-3">
      <img src="<?php echo $pastaArquivos.$i;?>" wight="20px" id="teste">
    </div>
    <br>
    <div class="form-group">
         <div class="col-md-6 offset-md-3">
           <input type="submit" class="btn btn-primary btn-lg active"  value="Alterar" name="alterar" id="alterar" >
            
         </div>
    </div>


    <br>



</form>
</div>
<?php

  }
  
?>
 