<?php namespace Locker\XApi;

use Locker\XApi\Errors\Error as Error;

class TypedAtom extends Atom {
  protected static $expected_types = [];

  public function validate() {
    $type = gettype($this->value);
    if (!in_array($type, static::$expected_types)) {
      $encoded_value = json_encode($this->value);
      return [new Error('`'.$encoded_value.'` should be a `'.get_class($this).'` not a `'.$type.'`')];
    }
    return [];
  }
}
