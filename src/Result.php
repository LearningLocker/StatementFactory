<?php namespace Locker\XApi;

class Result extends Element {
  protected $props = [
    'score' => 'Locker\XApi\Score',
    'success' => 'Locker\XApi\Boolean',
    'completion' => 'Locker\XApi\Boolean',
    'response' => 'Locker\XApi\String',
    'duration' => 'Locker\XApi\Duration',
    'extensions' => 'Locker\XApi\Extensions',
  ];
}

use Locker\XApi\Errors\Error as Error;

class Score extends Element {
  protected $props = [
    'scaled' => 'Locker\XApi\Scaled',
    'raw' => 'Locker\XApi\Number',
    'min' => 'Locker\XApi\Number',
    'max' => 'Locker\XApi\Number'
  ];
}

class Duration extends RegexpAtom {
  protected static $pattern = '/^P((\d+([\.,]\d+)?Y)?(\d+([\.,]\d+)?M)?(\d+([\.,]\d+)?W)?(\d+([\.,]\d+)?D)?)?(T(\d+([\.,]\d+)?H)?(\d+([\.,]\d+)?M)?(\d+([\.,]\d+)?S)?)?$/i';
}

class Boolean extends TypedAtom {
  protected static $expected_types = ['boolean'];
}

class Number extends TypedAtom {
  protected static $expected_types = ['integer', 'double'];
}

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

class Extensions extends Element {
  protected $allow_unknown_props = true;

  public function validate() {
    $errors = [];
    foreach ($this->getSetProps() as $set_prop) {
      $errors = array_merge($errors, (new IRI($set_prop))->validate());
    }
    return array_merge($errors, parent::validate());
  }
}
