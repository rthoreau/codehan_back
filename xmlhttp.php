<?php
require_once 'base.php';
headers();
$operation = p('operation');
$r = [];
if ($operation) {
  if ($operation === 'save_code') {
    $check = p('check');
    if ($check !== CHECK) {
      $r['error'] = 1;
      $error = result('SELECT id_error, message FROM error WHERE id_error = IF((SELECT id_error FROM error, appli_var av WHERE av.name="last_error" AND id_error = av.value + 1) IS NOT NULL, (SELECT id_error FROM error, appli_var av WHERE av.name="last_error" AND id_error = av.value + 1), 1);', 'FETCH');
      $r['message'] = $error['message'];
      rexec('UPDATE appli_var SET value = '.$error['id_error'].' WHERE name = "last_error"');
    } else {
      $code = new Code();
      $code->recover();
      $code->content = preg_replace('/\t/', '    ', $code->content);

      $newLanguages = p('newLanguages');
      if (!empty($newLanguages)) {
        foreach($newLanguages as $nl) {
          $language = new Language($nl->id_language);

          if ($language->name !== $nl->name) {
            $language->setId();
            $language->name = $nl->name;
            $language->save();
            if ($code->id_language === $nl->id_language) {
              $code->id_language = $language->getId();
            }
          }
        }
      }
      $r['id'] = $code->save();
    }
  }
  if ($operation === 'languages_list') {
    $languages = new Language();
    $r = $languages->listAll();
  }
  if ($operation === 'codes_list') {
    if (p(TEMP_TOKEN_NAME) !== TEMP_TOKEN) {
      return;
    }
    $code = new Code();
    $r = $code->listAll();
    $r_size = sizeof($r);
    for($i = 0; $i < $r_size; $i++) {
      $r[$i]['content'] = substr($r[$i]['content'], 0, 200);
    }
  }
  if ($operation === 'code') {
    if (p(TEMP_TOKEN_NAME) !== TEMP_TOKEN) {
      return;
    }
    $r = new Code(p('id_code'));
  }
}
echo json_encode($r);