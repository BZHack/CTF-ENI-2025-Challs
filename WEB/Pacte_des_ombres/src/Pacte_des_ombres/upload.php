<?php
$target_dir = "uploads/";
#$target_file = urldecode($target_dir.$_FILES["uploadFile"]["name"]);

if (!isset($_FILES["uploadFile"]) || $_FILES["uploadFile"]["error"] == UPLOAD_ERR_NO_FILE) {
    echo "ERROR: Aucun fichier n'a été fourni.";
    http_response_code(400);
    exit;
}

// Vérifier si le fichier dépasse la limite de taille définie dans php.ini
if ($_FILES["uploadFile"]["error"] == UPLOAD_ERR_INI_SIZE || $_FILES["uploadFile"]["error"] == UPLOAD_ERR_FORM_SIZE) {
    echo "ERROR: La taille du fichier dépasse la limite autorisée fixée à 10M.";
    http_response_code(413);
    exit;
}

$random_string = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);
$path_info = pathinfo($_FILES["uploadFile"]["name"]);
$extension = $path_info['extension'];
$new_filename = urldecode($target_dir.$path_info['filename'] . "_" . $random_string . "." . $path_info['extension']);

$is = getimagesize($_FILES['uploadFile']['tmp_name']);
if ($is === false || $is[2] != 3) {
  echo 'ERROR: Uniquement le format PNG est autorisé.';
  http_response_code(403);
} else {
  if (move_uploaded_file($_FILES["uploadFile"]["tmp_name"], $new_filename)) {
    echo "Fichier uploadé avec succès : <a href='$new_filename'>$new_filename</a><br>Ce fichier sera automatiquement supprimé dans 10 minutes.";
  } else {
    echo "Désolé, une erreur s'est produite durant l'upload de fichier.";
    http_response_code(403);
  }
} 
?>
