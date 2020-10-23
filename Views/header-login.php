

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoviePass</title>
<link rel="shortcut icon" href="<?php echo IMAGES.'ico.png' ?>"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" href="<?php echo CSS_ARCH ?>" type="text/css">
<script src="https://use.fontawesome.com/b29ce011be.js"></script>

</head>
<body>

<!-- BOTON DE FB 
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v8.0" nonce="AQgMbjZe"></script>-->

<header>
<div id="cardHeader" class="card">
  <div class="card-body">
<div id="logoP">
	<img src="<?php echo IMAGES.'logo.png' ?>" class="card-img-top" alt="MoviePass" width="100%">
    <!--<h1 class="card-title">MoviePASS</h1>-->
</div>
<br>
    <h5 id="hHeader" class="card-text">¡Adquiere entradas para ver tu pr&oacute;xima pel&iacute;cula favorita aqu&iacute;!</h5><br>
  

<button type="button" class="btn btn-danger col-5" data-toggle="modal" data-target="#loginModal">
  Acceder
</button>

  </div>
</div>
<br>
<br>
</header>
<div id="video">
<video src="<?php echo VIDEOS.'inicio-2.mp4' ?>" width="100%" autoplay muted loop>
</video>
</div>

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Acceder</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="login-form">
    <form action="<?php echo FRONT_ROOT.'Login/init' ?>" method="post">
        <!--<h2 class="text-center">Sign in</h2> -->  
        <div class="form-group">
        	<div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <span class="fa fa-user"></span>
                    </span>                    
                </div>
                <input type="text" class="form-control" name="username" placeholder="Usuario" required="required">				
            </div>
        </div>
		<div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fa fa-lock"></i>
                    </span>                    
                </div>
                <input type="password" class="form-control" name="password" placeholder="Contrase&ntilde;a" required="required">				
            </div>
        </div>        
        <div class="form-group">
            <button type="submit" class="btn btn-danger login-btn btn-block">Ingresar</button>
        </div>
        
	<hr>	
        <p class="text-center">Inicia sesi&oacute;n con tus redes sociales</p>
        <div class="text-center social-btn">

            <!-- BOTON DE FB <div class="fb-login-button" data-size="large" data-button-type="login_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="false" data-width=""></div>-->

<button class="btn btn-primary"><span><img src="<?php echo IMAGES.'f-logo.png' ?>" width="25px"</span>&#160;&#160;Iniciar sesi&oacute;n con Facebook</button>

        </div>
    </form><br>
    <p class="text-center text-muted small">¿No tienes una cuenta? <a href="<?php echo FRONT_ROOT ?>Login/signinView">Reg&iacute;strate!</a></p>
</div>
      </div>
    </div>
  </div>
</div>


<br>
