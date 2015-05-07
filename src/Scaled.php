<?php namespace Locker\XApi;

use Locker\XApi\Errors\Error as Error;

class Scaled extends Number {
  public function validate() {
    $errors = [];

    $scaled = $this->getValue();
    if ($scaled !== null && ($scaled < -1 || $scaled > 1)) {
      $errors[] = new Error("`$scaled` should have been between -1 and 1 (inclusive)");
    }

    return array_merge($errors, parent::validate());
  }
}
