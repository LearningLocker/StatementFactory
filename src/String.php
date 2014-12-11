<?php namespace Locker\XApi;

use Locker\XApi\Errors\Error as Error;

class String extends Atom {
  public function validate() {
    $type = gettype($this->value);
    if ($type !== 'string') {
      return [new Error('Expected `Locker\XApi\String` not `'.$type.'`')];
    }
    return [];
  }
}
