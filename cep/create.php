<?php

class createCep
{
    public $cepOrigem;
    public $cepDestino;
    public $distancia;
    private $_CEP_ABERTO_URL = "https://www.cepaberto.com/api/v3/";
    private $_CEP_ACCESS_TOKEN = "55e95b36b9a2a995488534ba0c63973b";

    public function __construct(array $cep = null)
    {
        $this->cepOrigem = $cep['cepOrigem'];
        $this->cepDestino = $cep['cepDestino'];
        $this->distancia = isset($cep['distancia']) ? $cep['distancia'] : "";
    }

    public function createCep()
    {
        $coord = $this->validateCep();

        var_dump($this->getDistance($coord));
    }

    private function validateCep()
    {
        $valid = ['origem' => false, 'destino' => false];
        $urlOrigem = $this->_CEP_ABERTO_URL . "cep?cep=" . $this->cepOrigem;
        $urlDestino = $this->_CEP_ABERTO_URL . "cep?cep=" . $this->cepDestino;

        $cepOrigem = $this->checkCepAPI($urlOrigem);
        sleep(1);
        $cepDestino = $this->checkCepAPI($urlDestino);
        if ($cepOrigem) {
            $valid['origem'] = $cepOrigem;
        }
        if ($cepDestino) {
            $valid['destino'] = $cepDestino;
        }

        return $valid;
    }

    private function checkCepAPI(String $url)
    {
        $header[] = 'Content-length: 0';
        $header[] = 'Content-type: application/json';
        $header[] = 'Authorization: Token token=' . $this->_CEP_ACCESS_TOKEN;

        $crl = curl_init();

        curl_setopt($crl, CURLOPT_URL, $url);
        curl_setopt($crl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($crl, CURLOPT_TIMEOUT, 3);
        $jsonContent = trim(curl_exec($crl));
        curl_close($crl);
        if ($jsonContent !== "{}" && $jsonContent !== "403 Forbidden (Rate Limit Exceeded)") {
            $content = json_decode($jsonContent, true);
            $data = ['cep' => '0', 'latitude' => '0', 'longitude' => '0'];
            $data['cep'] = isset($content['cep']) ? $content['cep'] : null;
            $data['latitude'] = isset($content['latitude']) ? $content['latitude'] : null;
            $data['longitude'] = isset($content['longitude']) ? $content['longitude'] : null;
            return $data;
        }

        return false;
    }

    private function getDistance(array $ceps)
    {
        $cordOrigem = $ceps['origem'];
        $cordDestino = $ceps['destino'];

        $latitudeOrigem = deg2rad($cordOrigem['latitude']);
        $latitudeDestino = deg2rad($cordDestino['latitude']);
        $longitudeOrigem = deg2rad($cordOrigem['longitude']);
        $longitudeDestino = deg2rad($cordDestino['longitude']);

        $latD = $latitudeDestino - $latitudeOrigem;
        $lonD = $longitudeDestino - $longitudeOrigem;

        $dist = 2 * asin(sqrt(pow(sin($latD / 2), 2) +
            cos($latitudeOrigem) * cos($latitudeDestino) * pow(sin($lonD / 2), 2)));
        $dist = $dist * 6371;
        return $dist;
    }
}
