<?php
   //1- realizando a conexao com o banco de dados(local,usuario,senha,nomeBanco)

   try{

      $con=mysqli_connect("localhost","root", "","bd_exemplo");

      //2- verificando se a conexao foi estabelecida
      if(mysqli_connect_errno()){
         echo "Erro ao conectar: " . mysqli_connect_error();
      }else{
         //echo "Conexão ok";
      }
   }catch(Exception $erro){
      
      $dateError=date("Y-m-d H:i:s");
      $messageError="\n".$dateError.":[".$erro."]\n";
      error_log($messageError, 3 ,"logerror.txt");

   }
   

  



?>