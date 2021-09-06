<?php

class Racun {
    public $brojRacuna;
    private $banka;
    private $vlasnik;
    private $stanje;

    public function __construct ($brojRacuna, $banka, $vlasnik, $stanje){
        $this->brojRacuna = $brojRacuna;
        $this->banka = $banka;
        $this->vlasnik = $vlasnik;
        $this->stanje = $stanje;
    }
}

class Banka {
    public $ime;
    private $racuni = [];

    public function __construct($ime){
        $this->ime = $ime;
    }

    public function dodajRacun($imeVlasnika,$imeBanke, $pocetnoStanje, $brojRacuna){
        $noviRacun = new Racun($brojRacuna, $imeBanke, $imeVlasnika, $pocetnoStanje);
        $this->imeBanke = $imeBanke;
        $this->racuni[] = $noviRacun;
        return $noviRacun;
    }
}

$mobiBanka = new Banka ("Mobi Banka");
$mobiBanka->dodajRacun("Nina Miljus", "Mobi", 0, 115000);
$mobiBanka->dodajRacun("Predrag Miljus", "Mobi", 0, 115000);
$mobiBanka->dodajRacun("Milutin Acimovic", "Mobi", 0, 115000);

var_dump($mobiBanka);