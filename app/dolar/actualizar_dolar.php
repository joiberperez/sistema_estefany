<?php



if (!defined("ROOT")) {
    include "../config/config.php";
}
include ROOT . "/models/modeloDolar.php";

class Dolar
{
    function peticion_dolar()
    {
        $url = 'https://www3.animeflv.net/';

        // Inicializa cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        // Ejecuta la solicitud
        $response = curl_exec($ch);
        curl_close($ch);

        if ($response !== false) {
            $dom = new DOMDocument();
            @$dom->loadHTML($response);
            $xpath = new DOMXPath($dom);

            // Encuentra el div con id 'dolar' y clase 'centrado'
            $dolar_div = $xpath->query("//div[@id='dolar']//div[contains(@class, 'centrado')]");

            if ($dolar_div->length > 0) {
                // Obtiene el contenido y limpia caracteres no numéricos excepto el punto decimal
                $dolar_text = $dolar_div->item(0)->textContent;
                return $dolar_text;
            } else {
                echo "No se encontro el valor del dolar";
            }
        } else {
            echo "Error al hacer la solicitud a la URL.";
        }
    }
    function actualizar_dolar()
    {
        if (empty($_GET["dolar"])) {

            $dolar_text = $this->peticion_dolar();
            if (!empty($dolar_text)) {
                $dolar_text = str_replace(',', '.', $dolar_text);
                $dolar_value = floatval($dolar_text);
                $dolar_value = number_format($dolar_value, 2);
                $modelo = new ModeloDolar();
                $modelo->actualizar_dolar($dolar_value);
                echo  $dolar_value;
            }
            
            
            // Convierte el valor a flotante
        }else{
            $dolar = $_GET["dolar"];
            $dolar = str_replace(',', '.', $dolar);
            $dolar_value = (float)($dolar);
            $modelo = new ModeloDolar();
            $modelo->actualizar_dolar($dolar_value);
            echo  $dolar_value;
        }
    }

}

$dolar = new Dolar();

$dolar->actualizar_dolar();
