<?php 

require_once 'base.php';

class Code extends Proto {
  public $id_code = '0';
  public $id_language = '';
  public $creation_date = '';
  public $modification_date = '';
  public $title = '';
  public $content = '';
  public $id_content = '';
  public $params = '0';
  public $id_params = '';
  public $table_name = 'code';

  /*function getAll($id = 0, $data = ''){
    $sql = "SELECT *"
    . ($id ? ', (SELECT participe FROM participation WHERE id_event = e.id AND id_user = ' . $id . ') as participe' : '')
    . ", u.nom as auteur_nom, u.prenom as auteur_prenom, u.mail as auteur_mail, u.role as auteur_role FROM event e, user u WHERE u.id = e.id_auteur".($data ? '' : " AND etat = 'valide'")." ORDER BY date DESC";
    $resultat = result($sql, true);
    if ($data) {
      return $resultat;
    }
    $r  = '{"events": [';
    $i = 0;
    foreach ($resultat as $event) {
      $j = 0;
      if ($i !== 0 ) {
        $r .= ',';
      }
      $r .= '{';
      foreach ($event as $key => $val) {
        if ($j !== 0 ) {
          $r .= ',';
        }
        $r .= '"'.$key.'": "'.uns($val).'"';
        $j ++;
      }
      $i ++;
      $r .= '}';
    }
    $r .= ']}';
    return $r;
  }*/
}