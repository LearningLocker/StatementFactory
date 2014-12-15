<?php
require '../vendor/autoload.php';

use Locker\XApi as XApi;


try {
  // Code.
  $obj = XApi\Statement::createFromJson('{
    "actor": {
      "name": "hello",
      "objectType": "Agent",
      "mbox": "mailto:test@example.com"
    },
    "verb": {
      "id": "http://www.example.com/verbs/test",
      "display": {
        "en-us": "yo"
      }
    },
    "object": {
      "objectType": "SubStatement",
      "actor": {
        "name": "hello",
        "objectType": "Agent",
        "mbox": "mailto:test@example.com"
      },
      "verb": {
        "id": "http://www.example.com/verbs/test",
        "display": {
          "en-us": "yo"
        }
      },
      "object": {
        "id": "33616af0-8450-11e4-b4a9-0800200c9a66",
        "objectType": "StatementRef"
      }
    },
    "result": {
      "score": {
        "scaled": -1.0,
        "raw": 1.0,
        "min": 1.2,
        "max": 1.3
      },
      "success": true,
      "completion": false,
      "response": "Hello World",
      "duration": "P1DT12H",
      "extensions": {
        "hello": "world"
      }
    },
    "context": {
      "registration": "277cb330-8463-11e4-b4a9-0800200c9a66",
      "instructor": {
        "name": "hello",
        "objectType": "Agent",
        "mbox": "mailto:test@example.com"
      },
      "team": {
        "name": "hello",
        "objectType": "Group",
        "mbox": "mailto:test@example.com"
      },
      "revision": "test",
      "platform": "Test",
      "language": "en-us",
      "statement": {
        "id": "609d5570-8463-11e4-b4a9-0800200c9a66"
      },
      "extensions": {
        "hello": "world"
      },
      "contextActivities": {
        "parent": [
          {
            "id": "http://www.example.com/activities/test"
          }
        ]
      }
    },
    "authority": {
      "objectType": "Group",
      "members": [
        {
          "mbox": "mailto:test@example.com"
        },
        {
          "mbox": "mailto:test@example.com"
        }
      ]
    },
    "version": "1.0.7002",
    "attachments": [
      {
        "usageType": "http://www.example.com",
        "display": {
          "en-us": "hello world"
        },
        "description": {
          "en-us": "hello world"
        },
        "contentType": "text/plain",
        "length": 1,
        "sha2": "dgdfgdfg",
        "fileUrl": "http://www.example.com"
      }
    ]
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
