<?php

    class Controller {

        public function inicio() {            
            mostrarMenu($_SESSION['nivel']);
            require __DIR__.'/../templates/inicio.php';
        }

        public function error() {
            require __DIR__ . '/../templates/error.php';
        }

        public function listar() {
            try {
                $m = new Alumnos();
                $params = array(
                    'alumnos' => $m->mostrarAlumnos()
                );

                // Recogemos los dos tipos de excepciones que se pueden producir
            } catch (Exception $e) {
                error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
                header('Location: index.php?ctl=error');
            } catch (Error $e) {
                error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
                header('Location: index.php?ctl=error');
            }
            
            mostrarMenu($_SESSION['nivel']);

            require __DIR__ . '/../templates/listarAlumnos.php';
        }

        public function ver() {
            try {
                if (! isset($_GET['id'])) {
                    throw new Exception('Página no encontrada');
                }
                $id = recoge('id');
                $m = new Alumnos();
                $params['alumnos'] = $m->infoAlumno($id);
                $a = new Alumnos();
                $asignaturas['alumnos'] = $a->asignaturasAlumno($id);
                
                if (! $params['alumnos'])
                    $params['mensaje'] = "No hay detalles que mostar";
                
                if (! $asignaturas['alumnos'])
                    $asignaturas['mensaje'] = "No está matriculado de ninguna asignatura";


            } catch (Exception $e) {
                error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
                header('Location: index.php?ctl=error');
            } catch (Error $e) {
                error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
                header('Location: index.php?ctl=error');
            }

            mostrarMenu($_SESSION['nivel']);

            require __DIR__ . '/../templates/verAlumno.php';
        }

        public function insertarAlumno() {
            try {
                $params = array(
                    'nombre' => '',
                    'nia' => '',
                    'email' => '',
                    'direccion' => '',
                    'cPostal' => '',
                    'localidad' => '',
                    'fNacimiento' => ''
                );

                if (isset($_POST['insertar'])) {
                    $nombre = recoge('nombre');
                    $nia = recoge('nia');
                    $email = recoge('email');
                    $direccion = recoge('direccion');
                    $cPostal = recoge('cPostal');
                    $localidad = recoge('localidad');
                    $fNacimiento = recoge('fNacimiento');
                    $fPerfil = $_FILES['fPerfil']['name'];
                    if(recogeCheck('asignaturas')) {
                        $asiUser = $_REQUEST["asignaturas"];
                    }
                    


                    // comprobar campos formulario. Aqui va la validación con las funciones de bGeneral o la clase Validacion
                    if (validarDatos($nombre, $nia, $email, $direccion, $cPostal, $localidad, $fNacimiento, $fPerfil)) {

                        $fotoPerfilSaneada = strtolower(str_replace(" ", "_", $fPerfil));

                        // Si no ha habido problema creo modelo y hago inserción
                        $m = new Alumnos();
                        if ($m->insertarAlumno($nombre, $nia, $email, $direccion, $cPostal, $localidad, $_SESSION['fechaBD'], $fotoPerfilSaneada)) {
                            //Guardamos el id del usuario
                            
                            //header('Location: pruebas.php?funciona=si');
                        } else {
                            $params['mensaje'] = 'No se ha podido insertar el alumno en la base de datos. Revisa el formulario';
                        }

                        $lastId = new Alumnos();
                        $ultimaIdAlumno = $lastId->alumnoUltimaId();

                        $asig = new Alumnos();
                        if ($asig->insertarAsignaturas($ultimaIdAlumno, $asiUser)) {
                            
                            header('Location: pruebas.php?funciona=si');
                        } else {                            
                            $params['mensaje'] = 'No se han podido insertar las asignaturas en la base de datos.';
                        }

                    } else {                        
                        $params['mensaje'] = 'Hay datos que no son correctos. Revisa el formulario';
                    }   
                }
            } catch (Exception $e) {
                error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
                //header('Location: index.php?ctl=error');
            } catch (Error $e) {
                error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
                //header('Location: index.php?ctl=error');
            }

            mostrarMenu($_SESSION['nivel']);

            require __DIR__ . '/../templates/insertarAlumno.php';
        }

        public function buscarAlumno() {
            try {
                $params = array(
                    'nombre' => '',
                    'resultado' => array()
                );
                $m = new Alumnos();
                if (isset($_POST['buscar'])) {
                    $nombre = recoge("nombre");
                    $params['nombre'] = $nombre;
                    $params['resultado'] = $m->buscarFichaAlumno($nombre);
                }
            } catch (Exception $e) {
                error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
                header('Location: index.php?ctl=error');
            } catch (Error $e) {
                error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
                header('Location: index.php?ctl=error');
            }

            mostrarMenu($_SESSION['nivel']);

            require __DIR__ . '/../templates/buscarAlumno.php';
        }     
        
        public function iniciarSesion() {
            try {   
                $params = array(
                    'resultado' => array()
                );            

                $u = new Usuarios();
                if (isset($_POST['iniciarSesion'])) {
                    
                    $nombre = recoge('usuario');
                    $password = recoge('password');
                    $params['resultado'] = $u->loginUsuario($nombre, $password);

                    if($params['resultado']){
                        $_SESSION['nombreUsuario'] = $params['resultado']['user'];
                        $_SESSION['nivel'] = $params['resultado']['nivel'];
                        $_SESSION['fPerfil'] = $params['resultado']['fPerfil'];                       
                    } else {
                        $_SESSION['errores']['login'] = "No se ha podido conectar.";
                    }
                } 
            } catch (Exception $e) {
                error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
                header('Location: index.php?ctl=error');
            } catch (Error $e) {
                error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
                header('Location: index.php?ctl=error');
            }            
            
            mostrarMenu($_SESSION['nivel']);

            require __DIR__.'/../templates/iniciarSesion.php';
        }  


        public function registrarse() {



            

            mostrarMenu($_SESSION['nivel']);

            require __DIR__.'/../templates/registrarse.php';
        }  

        public function cerrarSesion() {
            session_unset();

            mostrarMenu($_SESSION['nivel']);

            require __DIR__.'/../templates/cerrarSesion.php';
        }  


    }

?>
