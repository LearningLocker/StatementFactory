<?php namespace Locker\XApi;

class Group extends Agent {
  protected $props = [
    'member' => 'Locker\XApi\Members'
  ];
  protected $type = 'Group';
  protected $type_prop = 'objectType';

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
