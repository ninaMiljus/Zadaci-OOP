<?php

class User {
   private $id;
   private $email;
   private $password;

   public function __construct($id, $email, $password)
   {
       $this->id = $id;
       $this->email = $email;
       $this->password = $password;
   }
}

class Profile {
   private $id;
   private $user;
   public $first_name;
   public $last_name;
   private $city;
   private $date_of_birth;
   private $phone;

   public function __construct($id, $user, $first_name, $last_name, $city, $date_of_birth, $phone)
   {
       $this->id = $id;
       $this->user = $user;
       $this->first_name = $first_name;
       $this->last_name = $last_name;
       $this->city = $city;
       $this->date_of_birth = $date_of_birth;
       $this->phone = $phone;
   }
}

class Ad {
   private $id;
   private $category;
   private $user;
   public $title;
   private $content;
   private $created_at;
   private $expires_on;

   public function __construct($id, $category, $user, $title, $content, $created_at, $expires_on)
   {
       $this->id = $id;
       $this->category = $category;
       $this->user = $user;
       $this->title = $title;
       $this->content = $content;
       $this->created_at = $created_at;
       $this->expires_on = $expires_on;
   }
}

$marko = new User(1, "marko@me.com", "lozinka");
$markovProfil = new Profile(1, $marko, "Marko", "Markovic", "Novi Sad", "1.1.1970.", "0123456");

$ad1 = new Ad(1, "cat 1", $marko, "title 1", "content 1", "1.1.1970.", "1.1.2070.");
$ad2 = new Ad(1, "cat 2", $marko, "title 2", "content 2", "1.1.1970.", "1.1.2070.");
$ad3 = new Ad(1, "cat 3", $marko, "title 3", "content 3", "1.1.1970.", "1.1.2070.");

var_dump($ad1, $ad2, $ad3, $marko, $markovProfil);