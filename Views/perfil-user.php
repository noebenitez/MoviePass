<br>
<h2>DATOS PERSONALES</h2>
<br>

 <div class="card flex-row flex-wrap">
        <div class="card-block px-2 col-7"><br>
            <h3 class="card-title"><?php echo $user->getNombre() . ' ' . $user->getApellido() ?></h3>
    <br>
	    <p class="card-text"><b>DNI:</b>&#160; <?php echo $user->getDni() ?></p>
        <p class="card-text"><b>Email:</b>&#160; <?php if($user->getEmail() != 'undefined'){ echo $user->getEmail(); } ?></p>
        <p class="card-text"><b>Contrase&ntilde;a:</b>&#160; <?php $cant = strlen($user->getPassword()); for($i=0;$i<$cant;$i++){ echo '*'; } ?></p>
        
      <br><a href="<?php echo FRONT_ROOT ?>Ticket/ShowTicketList/<?php echo $_SESSION['id'] ?>" class="btn btn-danger"><i class="fa fa-ticket"></i>&#160;&#160;Mis Entradas</a>&#160; 
      <a href="<?php echo FRONT_ROOT ?>User/ShowEditView/<?php echo $user->getId() ?>" class="btn btn-secondary"><i class="fa fa-user"></i>&#160;&#160;Editar Perfil</a><br><br>
 </div>
 <br>
 </div>

