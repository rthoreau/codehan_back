<?php

require_once 'base.php';

class User extends Proto{
  public $id_user = '0';
  public $nom = '';
  public $prenom = '';
  public $mail = '';
  public $mdp = '';
  public $table_name = 'user';
}