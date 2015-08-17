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
    $members = $this->getPropValue('member') ?: null;
    $validateIdentifiers = parent::validateIdentifiers($used_identifiers);
    $validateMembers = $members === null || count($members) === 0;
    return $validateIdentifiers && $validateMembers;
  }
}
