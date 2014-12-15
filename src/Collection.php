<?php namespace Locker\XApi;

use Locker\XApi\Errors\Error as Error;

class Collection extends Atom {
  protected $member_type = 'Locker\XApi\Element';

  public function setValue($new_value) {
    Helpers::checkType('new_value', 'array', $new_value);
    $member_type = $this->member_type;

    $this->value = array_map(function ($element) use ($member_type) {
      return new $member_type($element);
    }, $new_value);

    return $this;
  }

  public function getValue() {
    $values = [];

    foreach ($this->value as $actor) {
      $values[] = $actor->getValue();
    }

    return $values;
  }

  public function validate() {
    $errors = [];

    foreach ($this->value as $id => $actor) {
      $errors = array_merge($errors, array_map(function (Error $error) use ($id) {
        return $error->addTrace((string) $id);
      }, $actor->validate()));
    }

    return $errors;
  }
}
