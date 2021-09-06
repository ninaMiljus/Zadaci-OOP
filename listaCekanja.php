<?php

class Osoba {
    public $ime;
    public $sledecaOsoba;

    public function __construct($ime)
    {
        $this->ime = $ime;
        $this->sledecaOsoba = null;
    }
}


class ListaCekanja {
    private $prvaOsoba;
    private $poslednjaOsoba;

    public function __construct()
    {
        $this->prvaOsoba = null;
        $this->poslednjaOsoba = null;
    }

    public function usluzi()
    {
        if ($this->prvaOsoba === null) {
            echo "Lista cekanja je prazna!<br />";
        } else {
            echo "Osoba " . $this->prvaOsoba->ime . " je usluzena.<br />";
            $this->prvaOsoba = $this->prvaOsoba->sledecaOsoba;
        }
    }

    public function dodajOsobu($novaOsoba)
    {
        if ($this->prvaOsoba === null) {
            $this->prvaOsoba = $novaOsoba;
            $this->poslednjaOsoba = $novaOsoba;
            return;
        }

        $this->poslednjaOsoba->sledecaOsoba = $novaOsoba;
        $this->poslednjaOsoba = $novaOsoba;
        echo "Dodata je osoba: " . $novaOsoba->ime . "<br />";
    }

    public function izbaci($imeOsobe)
    {
        if ($this->prvaOsoba === null) {
            echo "Lista cekanja je prazna!<br />";
            return;
        }

        if ($this->prvaOsoba !== null && $this->prvaOsoba->ime === $imeOsobe) {
            $izbacujeSe = $this->prvaOsoba;
            $this->prvaOsoba = $this->prvaOsoba->sledecaOsoba;

            if ($this->prvaOsoba === null) {
                $this->poslednjaOsoba = null;
            }

            echo "Izbacena je osoba: " . $izbacujeSe->ime . "<br />";
            return;
        }

        $trenutnaOsoba = $this->prvaOsoba;
        $sledecaOsoba = $trenutnaOsoba->sledecaOsoba;

        while ($sledecaOsoba !== null) {
            if ($sledecaOsoba->ime === $imeOsobe) {

                $trenutnaOsoba->sledecaOsoba = $sledecaOsoba->sledecaOsoba;

                if ($sledecaOsoba === $this->poslednjaOsoba) {
                    $this->poslednjaOsoba = $trenutnaOsoba;
                }

                echo "Izbacena je osoba: " . $sledecaOsoba->ime . "<br />";
                return;
            }

            $trenutnaOsoba = $sledecaOsoba;
            $sledecaOsoba = $sledecaOsoba->sledecaOsoba;
        }

        echo "Nije pronadjena osoba sa imenom: " . $imeOsobe . "!<br />";
    }

}



$lista = new ListaCekanja();

$lista->dodajOsobu(new Osoba("Milan Milanovic"));
$lista->dodajOsobu(new Osoba("Milena Milenovic"));
$lista->dodajOsobu(new Osoba("Marko Markovic"));
$lista->dodajOsobu(new Osoba("Nikola Nikolic"));
$lista->dodajOsobu(new Osoba("Petar Petrovic"));
$lista->dodajOsobu(new Osoba("Ivan Ivanovic"));
$lista->dodajOsobu(new Osoba("Marina Marinkovic"));

echo '<br />';

$lista->usluzi();
$lista->izbaci("Nikola Nikolic");
$lista->usluzi();
$lista->izbaci("Marina Marinkovic");
$lista->usluzi();
$lista->izbaci("Petar Petrovic");
$lista->izbaci("Anon Anonimus");
$lista->usluzi();
$lista->usluzi();