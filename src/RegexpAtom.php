<?php namespace Locker\XApi;

use Locker\XApi\Errors\Error as Error;

class RegexpAtom extends Atom {
  protected $pattern = '//';
  protected $invalid_message;

  protected function getInvalidMessage() {
    return $this->invalid_message ?: 'Invalid `' . get_class($this) . '`';
  }

  public function validate() {
    if (!preg_match($this->pattern, $this->value)) {
      return [new Error($this->getInvalidMessage())];
    }
    return [];
  }
}
