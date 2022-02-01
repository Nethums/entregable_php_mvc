<?php
    //Aqui pondremos las funciones de validación de los campos

    function validarDatos($nombre, $nia, $email, $direccion, $cPostal, $localidad, $fNacimiento, $fPerfil) {
        $error = FALSE;

        
        
        
        
        
        
        
        
        
        
        return true;
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
    
    /* Función que comprueba una cadena de texto con los parámetros introducidos */
    function cTexto(string $text, string $campo, array &$errores, int $max = 150, int $min = 1, string $espacios = " ", string $case = "i",) {
        if ((preg_match("/[A-Za-zÑñ$espacios]{" . $min . "," . $max . "}$/u$case", sinTildes($text)))) {
            return TRUE;
        } else {
            $errores[$campo] = "El campo $campo no es válido.";
            return FALSE;
        }        
    }
    
?>