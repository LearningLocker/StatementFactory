<?php namespace Locker\XApi;

class Group extends Agent {
  protected $props = [
    'members' => 'Locker\XApi\Members'
  ];

  protected function identifierError($used_identifiers) {
    $message = parent::identifierError($used_identifiers).' or define members';
    return $message;
  }

  protected function validateIdentifiers($used_identifiers) {
    $members = $this->getProp('members') ?: null;
    $members = $members !== null ? $members->getValue() : null;
    $validateIdentifiers = parent::validateIdentifiers($used_identifiers);
    return $validateIdentifiers && $members === null;
  }
}

use Locker\XApi\Errors\Error as Error;

class Members extends Atom {
  public function setValue($new_value) {
    Helpers::checkType('new_value', 'array', $new_value);

    $this->value = array_map(function ($actor) {
      return new Actor($actor);
    }, $new_value);

    return $this;
  }

  public function getValue() {
    $value = [];

    foreach ($this->value as $actor) {
      $value[] = $actor->getValue();
    }

    return $value;
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
