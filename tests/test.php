<?php
require '../vendor/autoload.php';

use Locker\XApi\Actor as Actor;

try {
  // Code.
  $obj = Actor::createFromJson('{
    "name": "Bilbo",
    "mbox": "mailto:bilbo.b@ggins.com"
  }');

  // Output.
  echo 'Errors = ["'. implode('", "', $obj->validate()) . '"]';
  echo $obj->toJson();
} catch (Exception $ex) {
  $arrEx = [
    'message' => $ex->getMessage(),
    'trace' => $ex->getTrace()
  ];
  echo json_encode($arrEx);
}
