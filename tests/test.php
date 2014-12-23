<?php
require '../vendor/autoload.php';

use Locker\XApi as XApi;


try {
  // Code.
  $file_location = 'assets/test.json';
  $obj = XApi\Statement::createFromJson(file_get_contents($file_location));
  // Output.
  $errors = $obj->validate();
  if (empty($errors)) {
    echo $obj->toJson();
  } else {
    echo json_encode(array_map(function ($error) {
      $error->addTrace('statement');
      return (string) $error;
    }, $errors));
  }
} catch (Exception $ex) {
  $arrEx = [
    'message' => $ex->getMessage(),
    'trace' => $ex->getTrace()
  ];
  echo json_encode($arrEx);
}
