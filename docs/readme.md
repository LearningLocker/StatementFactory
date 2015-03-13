# Getting Started

Basic use.
```php
use \Locker\XApi\Statement as Statement;

// Returns the given statement as a string of JSON.
function getJsonStatement($statement) {
  return $statement->toJson();
}

// Returns the given errors as a string of JSON.
function getJsonValidationErrors($errors) {
  return json_encode(array_map(function ($error) {
    $error->addTrace('statement');
    return (string) $error;
  }, $errors));
}

// Creates a statement and validates it.
$statement = Statement::createFromJson($json_string);
$errors = $statement->validate();

// Outputs validation errors or the statement as JSON.
if (empty($errors)) {
  echo getJsonStatement($statement);
} else {
  echo getJsonValidationErrors($errors);
}
```
