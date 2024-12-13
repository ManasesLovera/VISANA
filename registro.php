<?php require_once './logic/registro.logic.php'; ?>
<?php

$errores = registrar($conn);

?>
<!DOCTYPE html>
<html lang="en">

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registro</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/templatemo.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
</head>

<body>
    <!-- Start Top Nav -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-light d-none d-lg-block" id="templatemo_nav_top">
        <div class="container text-light">
            <div class="w-100 d-flex justify-content-between">
                <div>
                    <i class="fa fa-envelope mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="mailto:info@company.com">administrativo@visana.com.co</a>
                    <i class="fa fa-phone mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="tel:010-020-0340">3202916463</a>
                </div>
                <div>
                    <!-- <a class="text-light" href="" target="_blank" rel="sponsored"><i class="fab fa-facebook-f fa-sm fa-fw me-2"></i></a>-->
                    <a class="text-light" href="https://www.instagram.com/_visana/" target="_blank"><i class="fab fa-instagram fa-sm fa-fw me-2"></i></a>
                    <!-- <a class="text-light" href="" target="_blank"><i class="fab fa-twitter fa-sm fa-fw me-2"></i></a>-->
                    <!-- <a class="text-light" href="" target="_blank"><i class="fab fa-linkedin fa-sm fa-fw"></i></a>-->
                </div>
            </div>
        </div>
    </nav>
    <!-- Close Top Nav -->
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand text-success logo h1 align-self-center" href="index.html">
                VISANA
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
                <div class="flex-fill">
                    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.html">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.html">Nosotros</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="shop.html">Comprar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.html">Contactenos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="registro.php">Registro</a>
                            <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                    </ul>
                </div>
                <div class="navbar align-self-center d-flex">
                    <div class="d-lg-none flex-sm-fill mt-3 mb-4 col-7 col-sm-auto pr-3">
                        <div class="input-group">
                            <input type="text" class="form-control" id="inputMobileSearch" placeholder="Search ...">
                            <div class="input-group-text">
                                <i class="fa fa-fw fa-search"></i>
                            </div>
                        </div>
                    </div>
                    <!--<a class="nav-icon d-none d-lg-inline" href="#" data-bs-toggle="modal" data-bs-target="#templatemo_search">
                        <i class="fa fa-fw fa-search text-dark mr-2"></i>
                    </a>-->
                    <a class="nav-icon position-relative text-decoration-none" href="login.php">
                        <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
                        <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"></span>
                    </a>
                    <a class="nav-icon position-relative text-decoration-none" href="login.php">
                        <i class="fa fa-fw fa-user text-dark mr-3"></i>
                        <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"></span>
                    </a>
                </div>
            </div>

        </div>
    </nav>
    <!-- Close Header -->
    <div class="container py-5">

        <div class="row py-5">

            <h2 class="text-center">Registro</h2>

            <?php if (!empty($errores)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php foreach ($errores as $campo => $error): ?>
                        <p class="mb-1 color-red"><?= htmlspecialchars($error) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        
            
            <form action="registro.php" method="POST">
                
                <div class="row">
                    
                    <div class="form-group col-md-6 mb-3">
                        <label for="nombre">Nombre:</label>
                        <input class="form-control mt-1" type="text" name="nombre" id="nombre" value="<?= htmlspecialchars($_POST['nombre'] ?? '') ?>">
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="apellido">Apellido:</label>
                        <input class="form-control mt-1" type="text" name="apellido" id="apellido" value="<?= htmlspecialchars($_POST['apellido'] ?? '') ?>">
                    </div>
                
                </div>

                <div class="row">
                    
                    <div class="form-group col-md-6 mb-3">
                        <label for="usuario">Usuario:</label>
                        <input class="form-control mt-1" type="password" name="usuario" id="usuario">
                        </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="direccion">Dirección:</label>
                        <input class="form-control mt-1" type="text" name="direccion" id="direccion" value="<?= htmlspecialchars($_POST['direccion'] ?? '') ?>">
                    </div>
                
                </div>

                <div class="row">
                    
                    <div class="form-group col-md-6 mb-3">
                        <label for="clave">Contraseña:</label>
                        <input class="form-control mt-1" type="password" name="clave" id="clave">
                        </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="confirmarClave">Confirmar Contraseña:</label>
                        <input class="form-control mt-1" type="text" name="confirmarClave" id="confirmarClave" value="<?= htmlspecialchars($_POST['confirmarClave'] ?? '') ?>">
                    </div>
                
                </div>

                <div class="row">
                    
                    <div class="form-group col-md-6 mb-3">
                        <label for="email">Correo:</label>
                        <input class="form-control mt-1" type="email" name="email" id="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                        </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="telefono">Teléfono:</label>
                        <input class="form-control mt-1" type="tel" name="telefono" id="telefono" value="<?= htmlspecialchars($_POST['telefono'] ?? '') ?>">
                    </div>
                
                </div>

                <div class="row">
                    
                    <div class="form-group col-md-6 mb-3">
                        <label for="upline">Upline:</label>
                        <input class="form-control mt-1" type="text" name="upline" id="upline" value="<?= htmlspecialchars($_POST['upline'] ?? '') ?>">
                        </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="nacionalidad">Nacionalidad:</label>
                        <input class="form-control mt-1" type="text" name="nacionalidad" id="nacionalidad" value="<?= htmlspecialchars($_POST['nacionalidad'] ?? '') ?>">
                    </div>
                
                </div>
                
                <div class="row">

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </div>

                </div>
                    
            </form>
        </div>
    </div>

    <!-- Start Footer -->
    <footer class="bg-dark" id="tempaltemo_footer">
        <div class="container">
            <div class="row">

            <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">Acerca De Nosotros</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li>
                            <i class="fas fa-map-marker-alt fa-fw"></i>
                            Bogotá - Colombia
                        </li>
                        <li>
                            <i class="fa fa-phone fa-fw"></i>
                            <a class="text-decoration-none" href="tel:010-020-0340">3202916463</a>
                        </li>
                        <li>
                            <i class="fa fa-envelope fa-fw"></i>
                            <a class="text-decoration-none" href="mailto:info@company.com">administrativo@visana.com.co</a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">Servicio Al Cliente</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li><a class="text-decoration-none" href="#">Contratos</a></li>
                        <li><a class="text-decoration-none" href="#">Politica Tratamiendo de datos</a></li>
                        <li><a class="text-decoration-none" href="#">Terminos y Condiciones</a></li>
                        <li><a class="text-decoration-none" href="#">SAGRILAFT</a></li>
                        <li><a class="text-decoration-none" href="#">¿Quieres vender VISANA?</a></li>
                        <li><a class="text-decoration-none" href="#">Peticiones, quejas, reclamos y sugerencias</a></li>                        
                    </ul>
                </div>

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">Más Información</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li><a class="text-decoration-none" href="index.html">Inicio</a></li>
                        <li><a class="text-decoration-none" href="about.html">Nosotros</a></li>
                        <li><a class="text-decoration-none" href="contact.html">Ubicaciones de Tiendas</a></li>
                        <li><a class="text-decoration-none" href="registro.php">Registro</a></li>
                        <li><a class="text-decoration-none" href="contact.html">Contacto</a></li>
                        <li><a class="text-decoration-none" href="login.php">Iniciar Sesión</a></li>
                    </ul>
                </div>

            </div>

            <div class="row text-light mb-4">
                <div class="col-12 mb-3">
                    <div class="w-100 my-3 border-top border-light"></div>
                </div>
                <div class="col-auto me-auto">
                    <ul class="list-inline text-left footer-icons">
                        <!--<li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="http://facebook.com/"><i class="fab fa-facebook-f fa-lg fa-fw"></i></a>
                        </li> -->
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="https://www.instagram.com/_visana/"><i class="fab fa-instagram fa-lg fa-fw"></i></a>
                        </li>
                        <!--<li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="https://twitter.com/"><i class="fab fa-twitter fa-lg fa-fw"></i></a>
                        </li> -->
                        <!--<li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="https://www.linkedin.com/"><i class="fab fa-linkedin fa-lg fa-fw"></i></a>
                        </li> -->
                    </ul>
                </div>
                
            </div>
        </div>

        <div class="w-100 bg-black py-3">
            <div class="container">
                <div class="row pt-2">
                    <div class="col-12">
                        <p class="text-left text-light">
                            Copyright &copy; 2024 
                            | Designed by <a rel="sponsored" href="https://templatemo.com" target="_blank">FAEMSA</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </footer>
    <!-- End Footer -->

    
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>