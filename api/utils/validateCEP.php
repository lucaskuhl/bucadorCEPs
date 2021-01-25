<?php

class validateCEP
{
    public $cepOrigem;
    public $cepDestino;
    private $_CEP_ABERTO_URL = "https://www.cepaberto.com/api/v3/";
    private $_CEP_ACCESS_TOKEN = "55e95b36b9a2a995488534ba0c63973b";

    public function validateCep(array $cep)
    {
        $retError = null;
        if ($cep['cep_origem'] == "") {
            $retError['cep_origem'] = false;
        } else {
            $this->cepOrigem = $cep['cep_origem'];
        }
        if ($cep['cep_destino'] == "") {
            $retError['cep_destino'] = false;
        } else {
            $this->cepDestino = $cep['cep_destino'];
        }
        if (!empty($retError)) {
            return $retError;
        }

        $valid = ['cep_origem' => false, 'cep_destino' => false];
        $urlOrigem = $this->_CEP_ABERTO_URL . "cep?cep=" . $this->cepOrigem;
        $urlDestino = $this->_CEP_ABERTO_URL . "cep?cep=" . $this->cepDestino;

        $cepOrigem = $this->checkCepAPI($urlOrigem);
        sleep(1);
        $cepDestino = $this->checkCepAPI($urlDestino);
        if ($cepOrigem) {
            $valid['cep_origem'] = $cepOrigem;
        } else {
            $retError['cep_origem'] = false;
        }
        if ($cepDestino) {
            $valid['cep_destino'] = $cepDestino;
        } else {
            $retError['cep_destino'] = false;
        }

        if (!empty($retError)) {
            return $retError;
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
            return isset($content['cep']) ? $content['cep'] : "";
        }

        return false;
    }
}
