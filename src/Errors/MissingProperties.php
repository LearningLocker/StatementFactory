<?php namespace Locker\XApi\Errors;

class MissingProperties extends Error {
  public function __construct(array $properties, $class) {
    $properties_string = implode(', ', $properties);
    $message = "Missing properties ($properties_string) from `$class`";
    parent::__construct($message);
  }
}
