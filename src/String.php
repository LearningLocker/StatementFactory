<?php namespace Locker\XApi;

use Locker\XApi\Errors\Error as Error;

class String extends Atom {
  public function validate() {
    $type = gettype($this->value);
    if ($type !== 'string') {
      return [new Error('Expected a `'.get_class($this).'` not a `'.$type.'`')];
    }
    return [];
  }
}
