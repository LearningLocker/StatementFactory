<?php namespace Locker\XApi\Errors;

class UnknownProperties extends Error {
  public function __construct(array $properties, $trace) {
    $message = 'Unknown properties [' . implode(', ', $properties) . ']';
    parent::__construct($message, $trace);
  }
}
