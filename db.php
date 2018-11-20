<?php

try{
  $db = new PDO('mysql:host='.HOST.';charset=utf8;dbname='.DATABASE, USERNAME, PASSWORD);
}catch (Exception $e){
  die('La base de données est inaccessible !' . $e);
}

function rexec($query, $retour = 'ID'){
    global $db;
    $query = $db->prepare($query);
    $result = $query->execute();
    if (!$result){
      echo 'Une erreur est survenu !';
    }
    if ('ID') {
      return $db->lastInsertId();
    }
    return $result;
}

function result($query, $mode = 'FETCH'){
    global $db;
    $result = $db->query($query);
    $r = false;
    if ($mode === 'FETCH'){
      $r = $result->fetch(PDO::FETCH_ASSOC);
    }else if ($mode === 'FETCHALL'){
      $r = $result->fetchAll(PDO::FETCH_ASSOC);
    }else if ($mode === 'FIRST'){
      $r = $result->fetch(PDO::FETCH_BOTH)[0];
    }
    return $r;
}

/*function table_result($result){
    $keys = [];
    $content = '';
    foreach($result as $r){
        if (!$keys){
            $keys = array_keys ($r);
        }
        $content .= '<div style="border:1px solid #bbb;width:max-content;">';
        foreach ($r as $value){
            $content .= '<span style="display:inline-block;width:150px;padding:5px;box-sizing:border-box;">' . $value . '</span>';
        }
        $content .= '</div>';
    }
    echo '<br><div>';
    foreach ($keys as $key){
        echo '<span style="display:inline-block;border:1px solid black;width:150px;padding:5px;box-sizing:border-box;">' . $key . '</span>';
    }
    echo $content;
    echo '</div>';
}*/