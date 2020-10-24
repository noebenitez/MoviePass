

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

<!-- Load the JS SDK asynchronously -->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v8.0&appId=4680261238714380&autoLogAppEvents=1" nonce="QfYPJw4V"></script>

<script>

  function statusChangeCallback(response) {  // Called with the results from FB.getLoginStatus().
    console.log('statusChangeCallback');
    console.log(response);                   // The current login status of the person.
    if (response.status === 'connected') {   // Logged into your webpage and Facebook.
      testAPI();  
    } else {                                 // Not logged into your webpage or we are unable to tell.
      //document.getElementById('status').innerHTML = 'Please log ' + 'into this webpage.';
    }
  }


  function checkLoginState() {               // Called when a person is finished with the Login Button.
    FB.getLoginStatus(function(response) {   // See the onlogin handler
      statusChangeCallback(response);
    });
  }


  window.fbAsyncInit = function() {
    FB.init({
      appId      : '4680261238714380',
      cookie     : true,                     // Enable cookies to allow the server to access the session.
      xfbml      : true,                     // Parse social plugins on this webpage.
      version    : 'v8.0'           // Use this Graph API version for this call.
    });


    FB.getLoginStatus(function(response) {   // Called after the JS SDK has been initialized.
      statusChangeCallback(response);        // Returns the login status.
    });
  };
 
  function testAPI() {                      // Testing Graph API after login.  See statusChangeCallback() for when this call is made.
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      var arrayNombre =  response.name.split(' ');
       window.location.href = '<?php echo FRONT_ROOT?>/Login/fbLogin/' + response.id + '/' +  arrayNombre[0] + '/' + arrayNombre[arrayNombre.length - 1] + '/' + response.email;

    });
  }

</script>

<div id="status">
</div>


<header>
<div id="cardHeader" class="card">
  <div class="card-body">
<div id="logoP">
	<img src="<?php echo IMAGES.'logo.png' ?>" class="card-img-top" alt="MoviePass" width="100%">
    
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
       
        <div class="form-group">
        	<div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <span class="fa fa-at"></span>
                    </span>                    
                </div>
                <input type="email" class="form-control" name="email" placeholder="Correo Electr&oacute;nico" required="required">				
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
        </form>
	<hr>	
        <p class="text-center">Inicia sesi&oacute;n con tus redes sociales</p>
        <div class="text-center social-btn">

<div class="fb-login-button" data-size="large" data-button-type="login_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="false" data-width="" scope="public_profile,email" onlogin="checkLoginState();"></div>

        </div>
    <br>
    <p class="text-center text-muted small">¿No tienes una cuenta? <a href="<?php echo FRONT_ROOT ?>Login/signinView">Reg&iacute;strate!</a></p>
</div>
      </div>
    </div>
  </div>
</div>


<br>
