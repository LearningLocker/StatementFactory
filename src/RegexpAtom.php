<?php namespace Locker\XApi;

use Locker\XApi\Errors\Error as Error;

class RegexpAtom extends Atom {
  protected static $pattern = '//';
  protected static $invalid_message;

  protected function getInvalidMessage() {
    return static::$invalid_message .'`'.$this->value.'` should be a valid `' . get_class($this) . '`';
  }

  public function validate() {
    if (!preg_match(static::$pattern, $this->value)) {
      return [new Error($this->getInvalidMessage())];
    }
    return [];
  }
}
