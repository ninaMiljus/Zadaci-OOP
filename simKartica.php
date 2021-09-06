<?php

class SimKartica {
    private $brojTelefona;
    private $mreza;

    public function __construct($brojTelefona){
        $this->brojTelefona = $brojTelefona;
    }

    public function postaviMrezu($novaMreza){
        $this->mreza = $novaMreza;
    }
}

class MobilnaMreza {
    public $ime;
    private $sveSimKartice = [];

    public function __construct($ime){
        $this->ime = $ime;
    }

    public function novaSimKartica ($brojTelefona, $imeMreze){
        $novaKartica = new SimKartica($brojTelefona);
        $this->imeMreze = $imeMreze;
        $novaKartica->postaviMrezu($imeMreze);

        $this->sveSimKartice[] = $novaKartica;
        return $novaKartica;
    }
}

$mts = new MobilnaMreza("Mts");
$mts->novaSimKartica("123456", "Mts");
$mts->novaSimKartica("456789", "Mts");

var_dump($mts);
