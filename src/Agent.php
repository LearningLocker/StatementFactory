<?php namespace Locker\XApi;

use Locker\XApi\Errors\Error as Error;

class Agent extends Element {
  use TypedElement;

  protected $props = [
    'name' => 'Locker\XApi\Str',
    'mbox' => 'Locker\XApi\Mailto',
    'mbox_sha1sum' => 'Locker\XApi\Sha1',
    'openid' => 'Locker\XApi\IRI',
    'account' => 'Locker\XApi\Account',
    'objectType' => 'Locker\XApi\ObjectType'
  ];
  protected $required_props = ['objectType'];
  protected $type = 'Agent';
  protected $type_prop = 'objectType';

  public function __construct($value = null) {
    $this->addDefaults();
    parent::__construct($value);
  }

  private function countIdentifiers() {
    $identifiers = ['mbox', 'mbox_sha1sum', 'openid', 'account'];
    return count(array_filter($identifiers, function ($identifier) {
      return isset($this->value->{$identifier});
    }));
  }

  protected function identifierError($used_identifiers) {
    return "A `".get_class($this)."` must have exactly one identifier not `$used_identifiers`";
  }

  protected function validateIdentifiers($used_identifiers) {
    return $used_identifiers === 1;
  }

  public function validate() {
    $errors = $this->validateTypedElement();

    // Gets the used identifiers.
    $used_identifiers = $this->countIdentifiers();
    $hasOneIdent = $this->validateIdentifiers($used_identifiers);

    // Checks that only one identifier is used.
    if (!$hasOneIdent) {
      $errors[] = new Error($this->identifierError($used_identifiers));
    }

    return array_merge($errors, parent::validate());
  }
}
