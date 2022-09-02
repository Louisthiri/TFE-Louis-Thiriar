<?php
	session_start();
	include('include/header.php');
	       
?>
	<div class="login">
		<h1 class="title">connection partie admin</h1>
		<p><?php   
			if(isset($_SESSION['error'])){ //affiche les erreurs si il y en a
				print_r($_SESSION['error']); 
	 		}
	   	?>
		</p>
	<form action="../controler/login.php" class="form_login"method="post">
  <div class="mb-3">
    <label for="login"class="form-label">Votre identifiant ou email</label><br>
        <input type="text" class="form-control" name="login" placeholder="log-in" required/>
  </div>
  <div class="mb-3">
	<label for="pass" class="form-label">Votre mot de passe:</label>
    <input type="password" class="form-control" name="pass" placeholder="password" required/>
  <div class="mb-3 form-check">
  </div>
  <button type="submit" class="btn btn-primary">Se connecter</button>
</form>
		</div>
	</body>
</html>