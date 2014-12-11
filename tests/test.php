<?php
require '../vendor/autoload.php';

use Locker\XApi as XApi;

try {
  // Code.
  $obj = XApi\Statement::createFromJson('{
    "actor": {
      "name": "hello",
      "account": {
        "name": "hello",
        "homePage": "http://www.example.com"
      }
    },
    "verb": {
      "id": "http://www.example.com/verbs/test",
      "display": {"gdfgdfg":"sfdsdf"}
    },
    "object": {}
  }');

  // Output.
  $errors = $obj->validate();
  if (empty($errors)) {
    echo $obj->toJson();
  } else {
    echo json_encode(array_map(function ($error) {
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
