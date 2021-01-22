<?php

class distance
{
    public $cordOrigem;
    public $cordDestino;

    public function __construct(Array $ceps) {
        $this->cordOrigem = $ceps['origem'];
        $this->cordDestino = $ceps['destino'];
    }

    public function getDistance(array $ceps)
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
