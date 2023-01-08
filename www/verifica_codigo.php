<?php

include "conecta_teste.php";
$msg="";
$cod=$_POST['codigo'];
$sql2="select * from email where codigo = '$cod';";
$res= mysqli_query($conecta, $sql2);
$lin= mysqli_fetch_array($res);
$email=$lin['email'];
$total=mysqli_affected_rows($conecta);
if($total!=0)
{
    $sql="update email set verificado=1 where codigo = '$cod' and verificado=0; ";
    $result=mysqli_query($conecta, $sql);
    $tot=mysqli_affected_rows($conecta);
    if($tot>0)
        $msg="E-mail verificado com sucesso!";
    else
    {
        $sql3="select * from email where codigo='$cod' and verificado=1;";
        $res2=mysqli_query($conecta, $sql3);
        $lin2=mysqli_affected_rows($conecta);
        if($lin2>0)
            $msg="E-mail já verificado!";
        else
            $msg="Falha ao verificar e-mail";
        
    }
    
}
else
    $msg="Código inválido!";

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
     <title>Confirma&ccedil;&atilde;o de C&oacute;digo - NJoy</title>
     <link rel="stylesheet" href="style2.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>
    <script>
        $(document).ready(function()
        {
            $("#email").hide();
            $("#codigo").hide();
            $("#dados").click(function()
          {
                 $("#codigo").show();
                $("#email").show();
                $("#dados").hide();
          }
        );
        });
    </script>
</head>
<body>
			<div id="main">
					<div id="total">
							<div id="topo">
								<center>
								<div id="logo">
									<img src="aqui.png" width="160px"><br>	
								</div>
								</center>
								<center>
								<div id="txt">
								Confirma&ccedil;&atilde;o de E-mail
								</div>
								</center>
							</div>
					
						
						<div id="insere_codigo">
                            
                             <center>  
									
                                    <button id="dados" class="verdados">Ver dados</button>
									
							        <div id="codigo">
                                    C&oacute;digo: <?php echo $cod; ?>
                                    </div>
                           </center>
                            <center>
                                    <div id="email">
                                    E-mail: <?php echo $email; ?>
                                    </div>
                            </center>
                            <center>
                                    <div id="msg">
                                        <?php echo $msg; ?>
                                    </div>
				            </center>
						</div>
						      <br><br><br><br><br><br><br><br><br>
					
						<div id="button">	
							<button type="submit" class="button" onclick="myFunction()"><span>Visite nosso site</span></button>	
                            <script>
                                function myFunction()
                                {
                                    window.location="./index.html";
                                }
                            </script>
                            
						</div>	
					</div>	
	
			</div>  
</body>
</html>