<!DOCTYPE html>
<html >
  

<head>
    
    <title>EventUM</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    

    </head>

    <nav>
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <img class="img-responsive" src="img/logo.png" >
                </div>
                
            </div>
            
        </div>
    </nav>
    <header>
        
        
    
   <div class="container">
            <div class="text-center row">
                <h1>
Link de confirmacion enviado al correo: <?php echo $_POST['email']; ?>              
                </h1>
           <h1> 
          
     <form action="enviarEmail.php" method="POST">
                <input type="hidden" name="email" value="<?php echo $_POST['email']; ?>" placeholder="<?php echo $_POST['email']; ?>"><br>
                
		<div style="height: 10px;"></div>		
		<button type="submit" class="btn btn-primary"> Reenviar</button>
                </form>
       <br><br>
         </h1>                
           
            </div>
    </div>
          
    
</header>
   <footer>
        <div class="container">
            <div class="text-center row">
                
                Gracias por visitar la pagina
                <br>    

            </div>
        </div>
    </footer>
 
</body>


</html>	