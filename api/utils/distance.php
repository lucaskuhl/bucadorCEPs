<?php

/**
 * Classe criada para calcular a distância entre os dois ceps usando a fórmula de Haversine
 * @see https://pt.wikipedia.org/wiki/F%C3%B3rmula_de_Haversine#:~:text=O%20nome%20haversine%20foi%20criado,sen2(%CE%B82).
 */
class distanceCep
{
    public $cepOrigem;
    public $cepDestino;
    private $apiKey = "XitbdBUnLfad6XH7h8cv2gf4JQk7DQm6";

    /**
     * @param Array - Array de strings contendo os dois ceps a serem medidos
     * @return Array - Retorna a distância calculada
     */
    public function getDistance(array $ceps)
    {
        $this->cepOrigem = $this->getLatLong($ceps['cep_origem']);
        $this->cepDestino = $this->getLatLong($ceps['cep_destino']);

        return $this->calculateDistance();
    }

    /**
     * Método que conecta à API do TomTomDeveloper para pegar a latitude e longitude
     * 
     * @see https://developer.tomtom.com/content/search-api-explorer#/operations/Search
     * @param String - Cep sem caracteres especiais
     */
    private function getLatLong(string $cep)
    {
        $url = "https://api.tomtom.com/search/2/structuredGeocode.json?countryCode=BRA&limit=1&postalCode={$cep}&key={$this->apiKey}";

        $crl = curl_init();

        curl_setopt($crl, CURLOPT_URL, $url);
        curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($crl, CURLOPT_TIMEOUT, 3);
        $jsonContent = trim(curl_exec($crl));
        curl_close($crl);
        $content = json_decode($jsonContent, true);

        return $content['results'][0]['position'];
    }

    /**
     * Método que calcula a distância entre dois pontos em uma esfera usando a fórmula de Haversine
     * 
     * @return String - Distância com 2 casas decimais
     */
    private function calculateDistance()
    {

        $radio = 6371;
        $phi1 = $this->cepOrigem['lat'] *  M_PI / 180;
        $phi2 = $this->cepDestino['lat'] *  M_PI / 180;
        $deltaPhi = ($this->cepDestino['lat'] - $this->cepOrigem['lat']) * M_PI / 180;
        $deltaLambda = ($this->cepDestino['lon'] - $this->cepOrigem['lon']) * M_PI / 180;

        $a = (sin($deltaPhi / 2) * sin($deltaPhi / 2)) + cos($phi1) * cos($phi2) * (sin($deltaLambda / 2) * sin($deltaLambda / 2));
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $d = $radio * $c;

        return number_format($d, 2, '.', ',');
    }
}
