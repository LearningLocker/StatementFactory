<?php namespace Locker\XApi\Errors;

use Locker\XApi\Helpers as Helpers;

class Error {
  protected $message = '';
  protected $trace = [];

  /**
   * Constructs a new Error with a $message.
   * @param string $message
   */
  public function __construct($message) {
    Helpers::checkType('message', 'string', $message);
    $this->message = $message;
  }

  /**
   * Adds a $trace.
   * @param string $trace
   */
  final public function addTrace($trace) {
    Helpers::checkType('trace', 'string', $trace);
    array_splice($this->trace, 0, 0, [$trace]);
    return $this;
  }

  /**
   * Gets the $message.
   * @return string
   */
  final public function getMessage() {
    return $this->message;
  }

  /**
   * Gets the $trace.
   * @return array
   */
  final public function getTrace() {
    return $this->trace;
  }

  /**
   * Gets the $trace as a string.
   * @return string
   */
  final public function getTraceAsString() {
    return implode('.', $this->getTrace());
  }

  /**
   * Gets the Error as a string.
   * @return string
   */
  final public function __toString() {
    $trace = $this->getTraceAsString();
    $ending = $trace === '' ? '' : ' in `' . $trace . '`';
    return $this->getMessage() . $ending;
  }
}
