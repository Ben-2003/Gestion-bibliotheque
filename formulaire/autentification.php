<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>autentification</title>
       <!-- Bootstrap CSS -->
    <link href="bootstrap/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="bootstrap/style3.css">
</head>
<body>

   <div class="container my-5 p-4  border d-flex justify-content-center align-items-center">
         <div class=" row justify-content-center ">
            <div class=" col mb-5">
                <div class=" p-3">
                    <form action="" method="post">
                         <h1 class="text-center mb-4">Connexion</h1>
                        <div class=" row pb-5">
                            <div class=" col-12 ">
                                  <label for="nom" >nom complet</label>
                                  <div><input type="text" name="nom" id="nom" class="form-control" placeholder="Entrez votre nom" required></div>
                            </div>
                        </div>   
                        

                        <div class=" row">
                            <div class=" col-12">
                                <label for="mot de passe" >votre mot de passe</label>
                            <div><input type="paswort" name="mot de passe" id="mot de passe" class="form-control" placeholder="xxxxxx" required></div>
                        </div>

                            
                        <div class="text-center mt-5 bg-dark w-85">
                            <a href="" class="text-decoration-none">
                                  Mot de passe oublié ?
                            </a>
                       </div>  
                       
                        
                         <div class="text-center mt-5">
                             <button type="submit" class="btn btn-primary">
                               Envoyer
                             </button>
                         </div>
                        
                    </form>
                </div>
            </div>
         </div>
   </div>
  
    
</body>
</html>