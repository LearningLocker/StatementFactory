<?php namespace Locker\XApi\Errors;

class UnknownProperties extends Error {
  public function __construct(array $properties, $class) {
    $properties_string = implode(', ', $properties);
    $message = "Unknown properties ($properties_string) from `$class`";
    parent::__construct($message);
  }
}
