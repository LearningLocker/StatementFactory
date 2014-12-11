<?php namespace Locker\XApi\Errors;

class UnknownProperties extends Error {
  public function __construct(array $properties) {
    $message = 'Unknown properties [`' . implode('`, `', $properties) . '`]';
    parent::__construct($message);
  }
}
