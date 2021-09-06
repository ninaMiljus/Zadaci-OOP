<?php

class Macka {
  public $ime;
  public $majka;
  public $otac;

  public function __construct($ime, $majka = 'nepoznata', $otac = 'nepoznat')
  {
    $this->ime = $ime;
    $this->majka = $majka;
    $this->otac = $otac;
  }

  public function mjau()
  {
    echo $this->ime . " kaze mjau";
  }
}

$cvrle = new Macka('Cvrle');
$cvrle->mjau();