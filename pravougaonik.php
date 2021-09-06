<?php

class Pravougaonik {
    private $a;
    private $b;
    private $c;

    public function __construct($a, $b){
        $this->a = $a;
        $this->b = $b;
        $this->izracunajD();
    }

    private function izracunajD(){
        $this->d = sqrt($this->a * $this->a + $this->b * $this->b);
    }

    public function getA(){
        return $this->a;
    }

    public function getB(){
        return $this->b;
    }

    public function getD(){
        return $this->d;
    }

    public function setA($noviA){
        $this->a = $noviA;
        $this->izracunajD();
    }

    public function setB($noviB){
        $this->b = $noviB;
        $this->izracunajD();
    }
}

$pravougaonik = new Pravougaonik(4,3);

echo "Stranica A je duzine " . $pravougaonik->getA() . ".<br/>";

echo "Stranica B je duzine " . $pravougaonik->getB() . ".<br/>";

echo "Dijagonala je duzine " . $pravougaonik->getD() . ".<br/>";

$pravougaonik->setA(10);
$pravougaonik->setB(8);

echo "Stranica A je duzine " . $pravougaonik->getA() . ".<br/>";

echo "Stranica B je duzine " . $pravougaonik->getB() . ".<br/>";

echo "Dijagonala je duzine " . $pravougaonik->getD() . ".<br/>";
