<?php

    class Controller {

        public function inicio() {
            $params = array(
                'mensaje' => 'Bienvenido al Instituto Abastos',
                'fecha' => date('d-m-yy')
            );
        
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
            require __DIR__ . '/../templates/listarAlumnos.php';
        }

        public function insertar()
        {
            try {
                $params = array(
                    'nombre' => '',
                    'energia' => '',
                    'proteina' => '',
                    'hc' => '',
                    'fibra' => '',
                    'grasa' => ''
                );

                if (isset($_POST['insertar'])) {
                    $nombre = recoge('nombre');
                    $energia = recoge('energia');
                    $proteina = recoge('proteina');
                    $hc = recoge('hc');
                    $fibra = recoge('fibra');
                    $grasa = recoge('grasa');
                    // comprobar campos formulario. Aqui va la validación con las funciones de bGeneral o la clase Validacion
                    if (validarDatos($nombre, $energia, $proteina, $hc, $fibra, $grasa)) {

                        // Si no ha habido problema creo modelo y hago inserción
                        $m = new Alimentos();
                        if ($m->insertarAlimento($nombre, $energia, $proteina, $hc, $fibra, $grasa)) {
                            header('Location: index.php?ctl=listar');
                        } else {
                            $params = array(
                                'nombre' => $nombre,
                                'energia' => $energia,
                                'proteina' => $proteina,
                                'hc' => $hc,
                                'fibra' => $fibra,
                                'grasa' => $grasa
                            );
                            $params['mensaje'] = 'No se ha podido insertar el alimento. Revisa el formulario';
                        }
                    } else {
                        $params = array(
                            'nombre' => $nombre,
                            'energia' => $energia,
                            'proteina' => $proteina,
                            'hc' => $hc,
                            'fibra' => $fibra,
                            'grasa' => $grasa
                        );
                        $params['mensaje'] = 'Hay datos que no son correctos. Revisa el formulario';
                    }
                }
            } catch (Exception $e) {
                error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
                header('Location: index.php?ctl=error');
            } catch (Error $e) {
                error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
                header('Location: index.php?ctl=error');
            }

            require __DIR__ . '/../templates/formInsertar.php';
        }

        public function buscarPorNombre()
        {
            try {
                $params = array(
                    'nombre' => '',
                    'resultado' => array()
                );
                $m = new Alimentos();
                if (isset($_POST['buscar'])) {
                    $nombre = recoge("nombre");
                    $params['nombre'] = $nombre;
                    $params['resultado'] = $m->buscarAlimentosPorNombre($nombre);
                }
            } catch (Exception $e) {
                error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
                header('Location: index.php?ctl=error');
            } catch (Error $e) {
                error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
                header('Location: index.php?ctl=error');
            }
            require __DIR__ . '/../templates/buscarPorNombre.php';
        }

        public function ver()
        {
            try {
                if (! isset($_GET['id'])) {
                    throw new Exception('Página no encontrada');
                }
                $id = recoge('id');
                $m = new Alumnos();
                $params['alumnos'] = $m->infoAlumno($id);
                if (! $params['alumnos'])
                    $params['mensaje'] = "No hay detalles que mostar";
            } catch (Exception $e) {
                error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
                header('Location: index.php?ctl=error');
            } catch (Error $e) {
                error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
                header('Location: index.php?ctl=error');
            }

            require __DIR__ . '/../templates/verAlumno.php';
        }
    }

?>
