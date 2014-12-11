<?php namespace Locker\XApi\Errors;

class MissingProperties extends Error {
  public function __construct(array $properties) {
    $message = 'Missing properties [`' . implode('`, `', $properties) . '`]';
    parent::__construct($message);
  }
}
