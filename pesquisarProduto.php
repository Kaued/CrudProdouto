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
        <h5 class="modal-title" id="exampleModalLabel">Deseja excluir?</h5>
        <button type="button" class="close esconderModal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        
      <div class="modal-footer">
        <button type="button" class="btn btn-danger esconderModal" data-dismiss="modal">Não</button>
        <button type="button" class="btn btn-success esconderModal" data-dismiss="modal" id="excluir_confirmado">Sim</button>
              </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exclui_sucesso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Excluido com sucesso</h5>
        <button type="button" class="close esconderModal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        O produto foi excluido com sucesso
      </div>
      <div class="modal-footer">
       <a href="pesquisarProduto.php">
        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
      </a>
              </div>
    </div>
  </div>
</div>
    <div class="container">

      <h2> Listagem de Produto</h2>

      <table class="table table-striped">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Descrição</th>
            <th scope="col">Imagem</th>
            <th scope="col">Editar</th>
            <th scope="col">Excluir</th>
          </tr>
        </thead>

      <?php
        
        include "conexao.php";

        $pastaArquivos = 'backupImagens/';

        $comandoSql= "select * from tb_produto";

        try{

          if(isset($con)){

            $resultado= mysqli_query($con, $comandoSql);

            while ($dados=mysqli_fetch_assoc($resultado)) {
              
              $id= $dados ["id_produto"];
              $d= $dados ["descricao"];
              $i= $dados ["imagem"];

              echo "<tr>

                      <th scope='row' id='id_produto' alt='$id'>$id</th>
                      <td>$d</td>
                      <td><img src='$pastaArquivos$i' width='50' height='50'></td>
                      <td><a href='editar_produto.php?id=$id'<button type='button' class='btn btn-primary' >Alterar</button></a></td>
                      <td><button type='button' class='btn btn-danger' id='excluir_button'>Excluir</button></td>

                    </tr>";
            }

          }
        }catch(Exception $erro){

            $dateError=date("Y-m-d H:i:s");
            $messageError="\n".$dateError.":[".$erro."]\n";
            error_log($messageError, 3 ,"logerror.txt");

        }
        

      ?>

      </table>

    </div>

  </body>
</html>