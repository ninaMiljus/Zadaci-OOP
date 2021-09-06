<?php

class Grad {
    public $ime;

    public function __construct($ime){
        $this->ime = $ime;
    }
}

class Igrac {
    public $ime;
    public $prezime;
    public $pozicija;

    public function __construct($ime, $prezime, $pozicija){
        $this->ime = $ime;
        $this->prezime = $prezime;
        $this->pozicija = $pozicija;
    }
}

class Klub {
    public $ime;
    public $grad;
    public $datumOsnivanja;
    public $igraci = [];

    public function __construct($ime, $grad, $datumOsnivanja){
        $this->ime = $ime;
        $this->grad = $grad;
        $this->datumOsnivanja = $datumOsnivanja;
    }

    public function dodajIgraca($noviIgrac){
        $this->igraci[] = $noviIgrac;
    }
}

$noviSad = new Grad("Novi Sad");
$vojvodina = new Klub("Vojvodina", "Novi Sad", "1956");
$petarPetrovic = new Igrac("Petar", "Petrovic", "Bek");
$nikolaNikolic = new Igrac("Nikola", "Nikolic", "Krilo");
$ivanIvanovic = new Igrac("Ivan", "Ivanovic", "Centar");

$vojvodina->dodajIgraca($petarPetrovic);
$vojvodina->dodajIgraca($nikolaNikolic);
$vojvodina->dodajIgraca($ivanIvanovic);

var_dump($vojvodina);