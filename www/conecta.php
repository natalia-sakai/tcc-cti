<?php
    $conecta = pg_connect("host=mysql.njoy.kinghost.net dbname=njoy user=njoy password=njoy2318");  
    //winscp nome: njoy senha: cti
    if (!$conecta)             
    {                 
        echo "Não foi possível estabelecer conexão com o banco de dados!<br><br>";                 
        exit;
    }     
?>