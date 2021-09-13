<?php

class Doktor {
    public $ime;
    public $prezime;
    public $specijalnost;

    public function __construct(string $ime, string  $prezime, string $specijalnost){
        $this->ime = $ime;
        $this->prezime = $prezime;
        $this->specijalnost = $specijalnost;
        Loger::logujKreiranjeDoktora($this);
    }

    public function zakaziPregled(Pregled $pregled){
        echo "Zakazan je pregled $pregled->tip za pacijenta {$pregled->pacijent->ime} {$pregled->pacijent->prezime} kod doktora $this->prezime <br/>";
    }
}

class Pacijent {
    public $ime;
    public $prezime;
    public $jmbg;
    public $brojKartona;
    public $doctor;

    public function __construct(string $ime, string $prezime, string $jmbg, string $brojKartona){
        $this->ime = $ime;
        $this->prezime = $prezime;
        $this->jmbg = $jmbg;
        $this->brojKartona = $brojKartona;
        Loger::logujKreiranjePacijenta($this);
    }

    public function izaberiLekara(Doktor $doktor){
        $this->doktor = $doktor;
        echo "Pacijent $this->ime bira doktora $doktor->ime $doktor->prezime <br/>";
        Loger::logujBiranjeLekara($this, $this->doktor);
    }
}

abstract class Pregled {
    public $datum;
    public $vreme;
    public $pacijent;
    public $tip;

    public function __construct(string $datum, string $vreme, Pacijent $pacijent, string $tip){
        $this->datum = $datum;
        $this->vreme = $vreme;
        $this->pacijent = $pacijent;
        $this->tip = $tip;
    }

}

class KrvniPritisak extends Pregled {
    public $gornjaVrednost;
    public $donjaVrednost;
    public $puls;

    public function __construct(string $datum, string $vreme, Pacijent $pacijent){
        parent::__construct($datum, $vreme, $pacijent, "krvni pritisak");
    }

    public function obaviPregled(string $gornjaVrednost, string $donjaVrednost, string $puls){
        echo "Obavi pregled krvnog pritiska za pacijenta {$this->pacijent->ime} {$this->pacijent->prezime} <br/>";
    
        $this->gornjaVrednost = $gornjaVrednost;
        $this->donjaVrednost = $donjaVrednost;
        $this->puls = $puls;

        echo "Rezultati pregleda: pritisak je {$this->gornjaVrednost} / {$this->donjaVrednost}, puls je {$this->puls}. <br/>";
        
        Loger::logujObavljanjePregleda($this);
    }
}

class NivoSecera extends Pregled {
    public $vrednost;
    public $poslednjiObrok;

    public function __construct(string $datum, string $vreme, Pacijent $pacijent){
        parent::__construct($datum, $vreme, $pacijent, "nivo secera u krvi");
    }

    public function obaviPregled(string $vrednost, string $poslednjiObrok){
        echo "Obavi pregled nivoa secera u krvi za pacijenta {$this->pacijent->ime} {$this->pacijent->prezime} <br/>";

        $this->vrednost = $vrednost;
        $this->poslednjiObrok = $poslednjiObrok;

        echo "Rezultati pregleda: vrednost nivoa secera u krvi je $this->vrednost, vreme poslednjeg obroka je $this->poslednjiObrok. <br/>";
    
        Loger::logujObavljanjePregleda($this);
    }
}

class NivoHolesterola extends Pregled {
    public $vrednost;
    public $poslednjiObrok;

    public function __construct(string $datum, string $vreme, Pacijent $pacijent){
        parent::__construct($datum, $vreme, $pacijent, "nivo holesterola u krvi");
    }

    public function obaviPregled(string $vrednost, string $poslednjiObrok){
        echo "Obavi pregled nivoa holesterola u krvi za pacijenta {$this->pacijent->ime} {$this->pacijent->prezime} <br/>";

        $this->vrednost = $vrednost;
        $this->poslednjiObrok = $poslednjiObrok;

        echo "Rezultati pregleda: nivo holesterola u krvi je $this->vrednost, vreme poslednjeg obroka je $this->poslednjiObrok. <br/>";

        Loger::logujObavljanjePregleda($this);
    }
}

class Loger {
    public static function logujKreiranjeDoktora(Doktor $doktor){
        echo "[" . (new DateTime())->format("d.m.Y H:i") . "] Kreiran je doktor $doktor->ime <br/>";
    }

    public static function logujKreiranjePacijenta(Pacijent $pacijent){
        echo "[" . (new DateTime())->format("d.m.Y H:i") . "] Kreiran je pacijent $pacijent->ime <br/>";
    }

    public static function logujBiranjeLekara(Pacijent $pacijent, Doktor $doktor){
        echo "[" . (new DateTime())->format("d.m.Y H:i") . "] Pacijent $pacijent->ime je izabrao lekara $doktor->ime <br/>";
    }

    public static function logujObavljanjePregleda(Pregled $pregled){
        echo "[" . (new DateTime())->format("d.m.Y H:i") . "] Pacijent {$pregled->pacijent->ime} je izvrsio pregled $pregled->tip <br/>";
    }
}

$doktorMilan = new Doktor("Milan", "Milanovic", "kardiolog");
$doktorJovan = new Doktor("Jovan", "Jovanovic", "lekar opste prakse");

$pacijentMarko = new Pacijent("Marko", "Markovic", "05121991", "12345");
$pacijentNikola = new Pacijent("Nikola", "Nikolic", "12051987", "45678");
$pacijentDusan = new Pacijent("Dusan", "Dusanovic", "05091988", "789566");

$pacijentMarko->izaberiLekara($doktorMilan);
$pacijentNikola->izaberiLekara($doktorJovan);
$pacijentDusan->izaberiLekara($doktorMilan);

$pregled1 = new KrvniPritisak("08-09-2021", "08:00", $pacijentMarko);
$doktorMilan->zakaziPregled($pregled1);
$pregled1->obaviPregled("120", "60", "80");

$pregled2 = new NivoHolesterola("09-09-2021", "09:00", $pacijentNikola);
$doktorJovan->zakaziPregled($pregled2);
$pregled2->obaviPregled("80", "19:00");

$pregled3 = new NivoSecera("09-09-2021", "07:00", $pacijentDusan);
$doktorJovan->zakaziPregled($pregled3);
$pregled3->obaviPregled("7", "19:00");