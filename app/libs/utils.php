<?php
    //Aqui pondremos las funciones de validación de los campos

    function validarDatos($nombre, $nia, $email, $direccion, $cPostal, $localidad, $fNacimiento, $fPerfil) {
        $error = FALSE;
        
        if (cTexto($nombre, "nombre", 150, 1, " ", "i")) {
            $error = TRUE;
        }
        
        if (cNumero($nia, "nia", 8, 1, "")) {
            $error = TRUE;
        }
        
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = TRUE;
        } else {
            $_SESSION['errores']['email'] = "El email introducido no es válido.";
            return FALSE;
        }
        
        if (cDireccion($direccion, "direccion", 150, 1, " ", "i")) {
            $error = TRUE;
        }
        
        if (cNumero($cPostal, "cPostal", 5, 1, "")) {
            $error = TRUE;
        }

        if (cTexto($localidad, "localidad", 150, 1, " ", "i")) {
            $error = TRUE;
        }

        if (cFecha($fNacimiento, "fNacimiento", 150, 1, " ", "i")) {
            $error = TRUE;
        }





        
        if($error) {
            return TRUE;
        } else {
            return FALSE;
        }        
    }


    function recoge($var) {
        if (isset($_REQUEST[$var]))
            $tmp=strip_tags(sinEspacios($_REQUEST[$var]));
            else
                $tmp= "";
                
        return $tmp;
    }

    /* Función que comprueba que hay al menos 1 opción elegida */
    function recogeCheck(string $text) {
        if (isset($_REQUEST[$text])){
            return TRUE;
        } else{
            return FALSE;
        }
    }

    function sinEspacios($frase) {
        $texto = trim(preg_replace('/ +/', ' ', $frase));
        return $texto;
    }

    function sinTildes($text) {
        $no_permitidas = array(
            "á", "é", "í", "ó", "ú",
            "Á", "É", "Í", "Ó", "Ú",
            "à", "è", "ì", "ò", "ù",
            "À", "È", "Ì", "Ò", "Ù"
        );
        
        $permitidas = array(
            "a", "e", "i", "o", "u",
            "A", "E", "I", "O", "U",
            "a", "e", "i", "o", "u",
            "A", "E", "I", "O", "U"
        );
        
        $texto = str_replace($no_permitidas, $permitidas, $text);
        return $texto;
    }
        
    function cTexto(string $text, string $campo, int $max = 150, int $min = 1, string $espacios = " ", string $case = "i") {
        if ((preg_match("/[A-Za-zÑñ$espacios]{" . $min . "," . $max . "}$/u$case", sinTildes($text)))) {
            return TRUE;
        } else {
            $_SESSION['errores'][$campo] = "El campo $campo no es válido. Sólo se admiten letras.";
            return FALSE;
        }        
    }
    
    function cNumero(string $text, string $campo, int $max = 8, int $min = 1, string $espacios = "") {
        if ((preg_match("/[A-Za-zÑñ$espacios]{" . $min . "," . $max . "}$/u", $text))) {
            return TRUE;
        } else {
            $_SESSION['errores'][$campo] = "El campo $campo sólo puede contener números.";
            return FALSE;
        }        
    }

    function cDireccion(string $text, string $campo, int $max = 150, int $min = 1, string $espacios = " ", string $case = "i") {
        if ((preg_match("/[A-Za-zÑñ0-9-,$espacios]{" . $min . "," . $max . "}$/u$case", sinTildes($text)))) {
            return TRUE;
        } else {
            $_SESSION['errores'][$campo] = "La dirección tiene carácteres no permitidos.";
            return FALSE;
        }        
    }

    function cFecha(string $text, string $campo, array &$errores, string $formato = "0") {
           
       $arrayFecha = preg_split("/[\/-]/", $text);
       
       $regex = '/(\d{4})/';    
       if(! preg_match($regex, $arrayFecha[2]) || $arrayFecha[2] < 1700 || $arrayFecha[2] > 2021 ) {
           $errores[$campo] = "El año es incorrecto";
           return FALSE;
       }
       
       if (count($arrayFecha) == 3) {
           switch ($formato) {
               case ("0"):
                   return checkdate($arrayFecha[1], $arrayFecha[0], $arrayFecha[2]);
                   break;
                   
               case ("1"):
                   return checkdate($arrayFecha[0], $arrayFecha[1], $arrayFecha[2]);
                   break;
                   
               case ("2"):
                   return checkdate($arrayFecha[1], $arrayFecha[2], $arrayFecha[0]);
                   break;
               default:
                   $errores[$campo] = "El $campo tiene errores";
                   return FALSE;
           }
       } else {
           $errores[$campo] = "El $campo tiene errores";
           return FALSE;
       }
    }
  
    function cSubirImagen(string $campo, string $usuario, string $directorioUsuarios, array $extensionesValidas, array &$errores, string $publicaPrivada) {

        $directorioTemp = $_FILES[$campo]['tmp_name'];
        $extension = $_FILES[$campo]['type'];
        //$nombreArchivo = $_FILES[$campo]['name'];
        //No se pueden guardar nombres de fotos con espacios, por tanto cambiamos los espacios por _  
        $nombreFotoSinEspacios = reemplazarEnFiles ("fotoUsuario", "name", " ", "_");
    
        if($_FILES[$campo]['error'] == 0 && $_FILES[$campo]['size'] > 0) {
            /* El usuario ha subido una foto y hay que analizarla */        
            $nombrePartes = explode(".", $nombreFotoSinEspacios); 
            //Necesitamos la extensión de la foto que ha subido el usuario, por eso nos quedamos con el segundo item del array que es la extensión
            $extensionImagen = $nombrePartes[1];
    
            // Falta analizar qué pasa si la foto ya está subida, habría que añadirle time()
            
            // Comprobamos la extensión del archivo dentro de la lista que hemos definido al principio
            if (! in_array($extension, $extensionesValidas)) {
                $errores[] = "La extensión del archivo no es válida o no se ha subido ningún archivo";
                return FALSE;
            }
    
            if ($publicaPrivada == "privada") {
                if (is_file("../" . $directorioUsuarios . $usuario .'/' . $nombreFotoSinEspacios)) {
                    // Si existe una imagen con el mismo nombre le añadimos al final lo que devuelve time() precedido de un _
                    $nombrePartes = explode(".", $nombreFotoSinEspacios);
                    $nombreFinal = $nombrePartes[0] . "_" . time() . "." . $nombrePartes[1];
                    $nombreFotoSinEspacios = $nombreFinal;
                }
                 
                $rutaUsuario = "../" .$directorioUsuarios . $usuario . '/' . $nombreFotoSinEspacios;
                if (move_uploaded_file($directorioTemp, $rutaUsuario)) {
                    // En este caso devolvemos sólo el nombre del fichero sin la ruta
                    return TRUE;
                } else {
                    $errores[] = "Error: No se puede mover el fichero a su destino";
                    return FALSE;
                }
            }
    
            if ($publicaPrivada == "publica") {
                if (is_file("../" . $directorioUsuarios . $nombreFotoSinEspacios)) {
                    // Si existe una imagen con el mismo nombre le añadimos al final lo que devuelve time() precedido de un _
                    $nombrePartes = explode(".", $nombreFotoSinEspacios);
                    $nombreFinal = $nombrePartes[0] . "_" . time() . "." . $nombrePartes[1];
                    $nombreFotoSinEspacios = $nombreFinal;
                }
                 
                $rutaUsuario = "../" .$directorioUsuarios . $nombreFotoSinEspacios;
                if (move_uploaded_file($directorioTemp, $rutaUsuario)) {
                    // En este caso devolvemos sólo el nombre del fichero sin la ruta
                    return TRUE;
                } else {
                    $errores[] = "Error: No se puede mover el fichero a su destino";
                    return FALSE;
                }
            }
            
        }
    }


?>