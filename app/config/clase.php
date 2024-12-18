<?php

class BaseClase {
    function parsearCadena($cadena) {
        // Eliminar cualquier espacio en blanco y caracteres no alfanuméricos
        $cadenaLimpia = preg_replace("/[^a-zA-Z0-9]/", "", $cadena);
        
        // Retornar la cadena limpia
        return $cadenaLimpia;
    }
}


?>