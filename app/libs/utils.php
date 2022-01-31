<?php
    //Aqui pondremos las funciones de validación de los campos

    function validarDatos($nombre, $nia, $email, $direccion, $cPostal, $localidad, $fNacimiento, $fPerfil) {
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
    
?>