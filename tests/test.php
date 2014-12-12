<?php
require '../vendor/autoload.php';

use Locker\XApi as XApi;


try {
  // Code.
  $obj = XApi\Statement::createFromJson('{
    "actor": {
      "name": "hello",
      "objectType": "Group",
      "members": [{
        "mbox": "mailto:test@example.com",
        "openid": "http://www.example.com"
      }]
    },
    "verb": {
      "id": "http://www.example.com/verbs/test",
      "display": {"en-us":"yo"}
    },
    "object": {
      "id": "http://www.example.com/verbs/test"
    }
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
