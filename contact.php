<?php
	include('include/header.php');	       
?>

	
		<!-- ===== MAIN ===== -->
		<main id="main" class="main">
			
			<!-- ===== PAGE HEADER ===== -->
			<header id="page-header" class="page-header" style="background-image: url('https://placeimg.com/1920/1024/nature');">
				<div class="page-header-inner">
					<div class="container">



						<!-- ===== PAGE HEADER CONTENT ===== -->
						<div class="page-header-content text-center">
							<h2>Contact</h2>
						</div>

					</div>
				</div>
			</header>
			
			<!-- ===== SECTION ===== -->
			<section>
				<div class="container">
					<div>
						
						<!-- ===== PAGE CONTENT ===== -->
						<div>
							
							<!-- ===== CONTENT ===== -->
							<div class="page-content" >

								<!-- ===== PAGE TITLE & DESCRIPTION ===== -->
								<div >
									<h2 class="title-default mb-30">Des questions ?</h2>
									<p class="mb-50">Si vous avez besoin de me contacter n'hésitez pas faites le ici. </p>
								</div>

								<!-- ===== FORM CONTACT ===== -->
								<div  >
									<form action="php/contact.php" method="POST" id="form-contact" class="form-contact form-validate">
										<fieldset>
											<div class="mb-20">
												<label for="name" class="label-control">Nom :</label>
												<input type="text" name="name" class="form-control" id="name" required />
											</div>
											<div class="mb-20">
												<label for="email" class="label-control">Email :</label>
												<input type="email" name="email" class="form-control" id="email-contact" required />
											</div>
											<div class="mb-20">
												<label for="subject" class="label-control">Sujet :</label>
												<input type="text" name="subject" class="form-control" id="subject" required />
											</div>
											<div class="mb-20">
												<label for="message" class="label-control">Message :</label>
												<textarea name="message" id="message" rows="6" class="form-control" required></textarea>
											</div>
											<div class="mb-20 text-right">
												<input type="submit" class="btn btn-info btn-lg" value="Envoyer !" />
											</div>
											<div class="form-callback success">
												<p>Merci de nous avoir contactés.</p>
											</div>
											<div class="form-callback error">
												<p>Error! Something went wrong.</p>
											</div> 
										</fieldset>
									</form>
								</div>

							</div>
							
						</div>
						
						
					
						
					</div>
				</div>
			</section>
			
		</main>
	
			
			<?php
	include('include/footer.php');	       
?>
