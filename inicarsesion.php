<?php
require_once 'database.php';

// Comprobamos si el usuario ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibimos los datos del formulario
    $username = $_POST['correo'];
    $password = $_POST['password'];

    // Realizamos la conexión a la base de datos
    $db = Database::getInstance()->getConnection();

    // Consulta para buscar al usuario en la base de datos
    $query = "SELECT * FROM usuario WHERE correo = ?";
    $statement = $db->prepare($query);
    $statement->bind_param("s", $username);
    $statement->execute();
    $result = $statement->get_result();
    $user = $result->fetch_assoc();

    // Verificamos si el usuario existe y si la contraseña es correcta
    if ($user && password_verify($password, $user['password'])) {
        // Usuario autenticado correctamente
        session_start();
        $_SESSION['correo'] = $user;
        header("Location: garden-index.php"); // Redirigir al usuario al dashboard
        exit();
    } else {
        // Credenciales incorrectas
        $error = "Nombre de usuario o contraseña incorrectos.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>ZerDesperdicioMX </title>
	<!-- Bootstrap core CSS -->
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- Fontawesome CSS -->
	<link href="css/all.css" rel="stylesheet">
	<!-- Custom styles for this template -->
	<link href="css/style.css" rel="stylesheet">
    <link href="css/iniciar.css" rel="stylesheet">
    
</head>

<body>
     <!-- Navigation -->
	 <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-light top-nav fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.html">
            <img src="images/logo.png" alt="logo" />
            </a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				<span class="fas fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
               <ul class="navbar-nav ml-auto">
                  <li class="nav-item">
                     <a class="nav-link active" href="index.html">Inicio</a>
                  </li>
                  <!--
                  <li class="nav-item">
                     <a class="nav-link" href="about.html">Nosotros</a>
                  </li>
                   -->
                  <li class="nav-item">
                     <a class="nav-link" href="services.html">Aplicación</a>
                  </li>

                  
                  <li class="nav-item">
                     <a class="nav-link" href="contact.html">Contacto</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="inicarsesion.php">Inicar sesión</a>
                  </li>
               </ul>
            </div>
        </div>
    </nav>

	<!-- full Title -->
	<div class="full-title">
		<div class="container">
			<!-- Page Heading/Breadcrumbs -->
			<h1 class="mt-4 mb-3"> Iniciar sesión
				<small>Subheading</small>
			</h1>
		</div>
	</div>
	
    <!-- Page Content -->
    <div class="container">
		<div class="breadcrumb-main">
			<ol class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="index.html">Home</a>
				</li>
				<li class="breadcrumb-item active">Iniciar sesión</li>
			</ol>
		</div>
</div>

	
		<!-- logingSection -->
		
        <div class="img-fluid rounded mb-4">
            <div class="login-page">
                <div class="form">
				
                  <form class="register-form">
                    <input type="text" placeholder="Nombre"/>
					<input type="text" placeholder="Correo electronico"/>
					<small>Fotografia</small>
					<input type="file" name="" id="">
                    <input type="password" placeholder="Contraseña"/>
                    <input type="password" placeholder="Confirmar contraseña"/>
                    <button>Crear cuenta</button>
                    <p class="message">Ya estas registrado? <a href="#">Inicia sesión</a></p>
                  </form>

				  <?php if(isset($error)) { echo "<p>$error</p>"; } ?>
				  <form class="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <input type="text" id="correo" name="correo" placeholder="Correo"/>
                    <input type="password" id="password" name="password" placeholder="Contraseña"/>
					<button>Iniciar sesión</button>
                    <p class="message">No estas registrado? <a href="#">Crear una cuenta</a></p>
                  </form>
                </div>
              </div>
        </div>
        <div>
            <a href="garden-index.php">Inicio app</a>
        </div>
    <!-- /.container -->
 <!--footer starts from here-->
 <footer class="footer">
	<div class="container bottom_border">
		<div class="row">
		   <div class="col-lg-3 col-md-6 col-sm-6 col">
				<h5 class="headin5_amrc col_white_amrc pt2">Find us</h5>
				<!--headin5_amrc-->
				<p class="mb10">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
				<p><i class="fa fa-location-arrow"></i> 9878/25 sec 9 rohini 35 </p>
				<p><i class="fa fa-phone"></i> +91-9999878398 </p>
				<p><i class="fa fa fa-envelope"></i> info@example.com </p>
		   </div>
		   <div class="col-lg-3 col-md-6 col-sm-6 col">
				<h5 class="headin5_amrc col_white_amrc pt2">Follow us</h5>
				<!--headin5_amrc ends here-->
				<ul class="footer_ul2_amrc">
					<li>
						<a href="#"><i class="fab fa-twitter fleft padding-right"></i> </a>
						<p>Lorem Ipsum is simply dummy printing...<a href="#">https://www.lipsum.com/</a></p>
					</li>
					<li>
						<a href="#"><i class="fab fa-twitter fleft padding-right"></i> </a>
						<p>Lorem Ipsum is simply dummy printing...<a href="#">https://www.lipsum.com/</a></p>
					</li>
					<li>
						<a href="#"><i class="fab fa-twitter fleft padding-right"></i> </a>
						<p>Lorem Ipsum is simply dummy printing...<a href="#">https://www.lipsum.com/</a></p>
					</li>
				</ul>
				<!--footer_ul2_amrc ends here-->
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6">
				<h5 class="headin5_amrc col_white_amrc pt2">Quick links</h5>
				<!--headin5_amrc-->
				<ul class="footer_ul_amrc">
					<li><a href="#">Default Version</a></li>
					<li><a href="#">Boxed Version</a></li>
					<li><a href="#">Our Team </a></li>
					<li><a href="#">About Us</a></li>
					<li><a href="#">Our Services</a></li>
					<li><a href="#">Get In Touch</a></li>
				</ul>
				<!--footer_ul_amrc ends here-->
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6 ">
				<h5 class="headin5_amrc col_white_amrc pt2">Recentas </h5>
				<!--headin5_amrc-->
				<ul class="footer_ul_amrc">
					<li class="media">
						<div class="media-left">
							<img class="img-fluid" src="images/post-img-01.jpg" alt="" />
						</div>
						<div class="media-body">
							<p>Utiliza los alimentos que tienes</p>
							<span></span>
						</div>
					</li>
					<li class="media">
						<div class="media-left">
							<img class="img-fluid" src="images/post-img-02.jpg" alt="" />
						</div>
						<div class="media-body">
							<p>Recetas para cuidar tu cuerpo</p>
							<span></span>
						</div>
					</li>
					<li class="media">
						<div class="media-left">
							<img class="img-fluid" src="images/post-img-03.jpg" alt="" />
						</div>
						<div class="media-body">
							<p>¿Quieres conocer más?</p>
							<span>contactanos</span>
						</div>
					</li>
				</ul>
				<!--footer_ul_amrc ends here-->
			</div>
		</div>
	</div>
	<div class="container">
		<div class="footer-logo">
			<a href="#"><img src="images/logo.png" alt="" /></a>
		</div>
		<!--foote_bottom_ul_amrc ends here-->
		<p class="copyright text-center">Innovación en linea &copy; 2024 <a href="#"></a> 
			
		</p>
		<ul class="social_footer_ul">
			<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
			<li><a href="#"><i class="fab fa-twitter"></i></a></li>
			<li><a href="#"><i class="fab fa-linkedin"></i></a></li>
			<li><a href="#"><i class="fab fa-instagram"></i></a></li>
		</ul>
		<!--social_footer_ul ends here-->
	</div>
</footer>
  
<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
    $('.message a').click(function(){
   $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
});
</script>
</body>
</html>