<?php

class Kompanija {
    public $ime;
    public $sektori = [];

    public function __construct(string $ime){
        $this->ime = $ime;
    }

    public function dodajSektor(Sektor $sektor){
        $this->sektori[] = $sektor;
    }
}

abstract class Sektor {
    public $ime;
    public $zaposleni = [];

    public function __construc(string $ime){
        $this->ime = $ime;
    }

    public function dodajZaposlenog (Zaposleni $zaposleni){
        $this->zaposleni[] = $zaposleni;
    }
}

class Fabrika extends Sektor implements StriktnoRadnoVreme {
    public $radnoVreme;
    public $proizvodi = [];

    public function setRadnoVreme (int $od, int $do){
        $this->radnoVreme = [
            'od' => $od,
            'do' => $do
        ];
    }

    public function dodajProizvod (string $proizvod, int $broj = 1){
        if (!isset($this->proizvodi[$proizvod])){
            $this->proizvodi[$proizvod] = 0;
        }

        $this->proizvodi[$proizvod] += $broj;
    }
}

class ProdajnoMesto extends Sektor implements PraviloOblacenja, StriktnoRadnoVreme {
    public $praviloOblacenja;
    public $radnoVreme;
    public $proizvodi = [];

    public function setPraviloOblacenja (string $pravilo) {
        $this->praviloOblacenja = $pravilo;
    }

    public function getPraviloOblacenja(): string {
        return $this->praviloOblacenja;
    }

    public function setRadnoVreme (int $od, int $do){
        $this->radnoVreme = $od . " - " . $do;
    }

    public function prodaj (Kupac $kupac, array $proizvodi){
        foreach($proizvodi as $proizvod){
            if (!empty($this->proizvodi[$proizvod])){
                $this->proizvodi[$proizvod]--;
                echo "$proizvod prodat kupcu $kupac->ime <br/>";
            } else {
                echo "$proizvod nema na lageru <br/>";
            }
        }
    }

    public function dodajProizvod (string $proizvod, int $broj = 1){
        if (!isset($this->proizvodi[$proizvod])){
            $this->proizvodi[$proizvod] = 0;
        }

        $this->proizvodi[$proizvod] += $broj;
    }
}

class OdsekZaNabavke extends Sektor implements ZakazivanjeSastanka {
    public $sastanci = [];

    public function zakazatiSastanak (string $datum, string $vreme, string $kontakt){
        $this->sastanci[] = [
            "datum" => $datum,
            "vreme" => $vreme,
            "kontakt" => $kontakt
        ];
    }
}

class OdsekZaMarketing extends Sektor implements PraviloOblacenja, ZakazivanjeSastanka {
    public $praviloOblacenja;
    public $sastanci= [];

    public function setPraviloOblacenja (string $pravilo){
        $this->praviloOblacenja = $pravilo;
    }

    public function getPraviloOblacenja(): string {
        return $this->praviloOblacenja;
    }

    public function zakazatiSastanak (string $datum, string $vreme, string $kontakt){
        $this->sastanci[] = "$datum $vreme $kontakt";
    }
}

interface PraviloOblacenja {
    public function setPraviloOblacenja(string $pravilo);

    public function getPraviloOblacenja(): string;
}

interface ZakazivanjeSastanka {
    public function zakazatiSastanak (string $datum, string $vreme, string $kontakt);
}

interface StriktnoRadnoVreme {
    public function setRadnoVreme(int $od, int $do);
}

class Osoba {
    public $ime;
    public $prezime;

    public function __construct (string $ime, string $prezime){
        $this->ime = $ime;
        $this->prezime = $prezime;
    }
}

class Zaposleni extends Osoba {

}

class Kupac extends Osoba {

}

$benComputers = new Kompanija("Ben Computers");

$fabrike = [];
for ($i = 0; $i < 4; $i++){
    $fabrike[$i] = new Fabrika("Fabrika " . $i);
    $benComputers->dodajSektor($fabrike[$i]);
}

$prodajnaMesta = [];
for ($i = 0; $i < 60; $i++){
    $prodajnaMesta[$i] = new ProdajnoMesto("Prodajno mesto " . $i);
    $benComputers->dodajSektor($prodajnaMesta[$i]);
}

$odsekZaNabavke = new OdsekZaNabavke("Odsek za Nabavke");
$benComputers->dodajSektor($odsekZaNabavke);

$marketing = [];
for ($i = 0; $i < 2; $i++){
    $marketing[$i] = new OdsekZaMarketing("Odsek za marketing " . $i);
    $benComputers->dodajSektor($marketing[$i]);
}

foreach ($marketing as $sektor) {
    $sektor->setPraviloOblacenja("Poslovno odelo, kravata nije obavezna");
}

$odsekZaNabavke->zakazatiSastanak("20-10-2021", "08:00", "Nikola Nikolic");

foreach ($fabrike as $sektor) {
    $sektor->setRadnoVreme(8, 16);
}

foreach ($fabrike as $sektor){
    $sektor->dodajProizvod("Tastatura", 50);
    $sektor->dodajProizvod("Laptop", 100);
    $sektor->dodajProizvod("Monitor", 200);
}

foreach ($prodajnaMesta as $i => $sektor){
    $sektor->dodajProizvod("Tastatura", 5);
    $sektor->dodajProizvod("Laptop", 10);
    $sektor->dodajProizvod("Monitor", 20);

    $sektor->dodajZaposlenog(new Zaposleni("Ivan", "Ivanovic"));
    $sektor->dodajZaposlenog(new Zaposleni("Marko", "Markovic"));
}

$kupac1 = new Kupac("Petar", "Petrovic");

$prodajnaMesta[0]->prodaj($kupac1, ["Laptop", "Monitor"]);