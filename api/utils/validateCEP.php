<?php

class validateCEP
{
    public $cepOrigem;
    public $cepDestino;
    private $_CEP_ABERTO_URL = "https://www.cepaberto.com/api/v3/";
    private $_CEP_ACCESS_TOKEN = "55e95b36b9a2a995488534ba0c63973b";

    public function __construct(array $cep)
    {
        if ($cep['cepOrigem'] == "") {
            return http_response_code(406);
        }
        $this->cepOrigem = $cep['cepOrigem'];
        $this->cepDestino = $cep['cepDestino'];
        $this->distancia = isset($cep['distancia']) ? $cep['distancia'] : "";
    }

    public function validateCep()
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
        if ($jsonContent !== "{}") {
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

        var_dump($cordOrigem);
        var_dump($cordDestino);
        $radio = 6371;
        $phi1 = $cordOrigem['latitude'] *  M_PI/180;
        $phi2 = $cordDestino['latitude'] *  M_PI/180;
        $deltaPhi = ($cordDestino['latitude'] -$cordOrigem['latitude']) * M_PI/180;
        $deltaLambda = ($cordDestino['longitude'] -$cordOrigem['longitude']) * M_PI/180;

        $a = (sin($deltaPhi/2) * sin($deltaPhi/2)) + cos($phi1) * cos($phi2) * (sin($deltaLambda/2) * sin($deltaLambda/2));
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        $d = $radio * $c;

        return $d;
    }

}
