<?php

class distanceCep
{
    public $cepOrigem;
    public $cepDestino;
    private $apiKey = "XitbdBUnLfad6XH7h8cv2gf4JQk7DQm6";


    public function getDistance(array $ceps)
    {
        $this->cepOrigem = $this->getLatLong($ceps['cep_origem']);
        $this->cepDestino = $this->getLatLong($ceps['cep_destino']);

        return $this->calculateDistance();
    }

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

        return $d;
    }
}
