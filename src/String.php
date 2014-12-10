<?php namespace Locker\XApi;

use Locker\XApi\Errors\Error as Error;

class String extends Atom {
  public function validate() {
    if (gettype($this->value) !== 'string') {
      return [new Error('Invalid `Locker\XApi\String`')];
    }
    return [];
  }
}
