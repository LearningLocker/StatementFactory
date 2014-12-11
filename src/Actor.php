<?php namespace Locker\XApi;

use Locker\XApi\Errors\Error as Error;

class Actor extends Element {
  protected static $props = [
    'name' => 'Locker\XApi\String',
    'objectType' => 'Locker\XApi\ObjectType',
    'mbox' => 'Locker\XApi\Mailto',
    'mbox_sha1sum' => 'Locker\XApi\Sha1',
    'openid' => 'Locker\XApi\IRI',
    'account' => 'Locker\XApi\Account',
  ];

  public function __construct($value = null) {
    parent::__construct($value);
    $this->value->objectType = 'Agent'; // Default.
  }

  public function validate() {
    $errors = [];

    // Gets the used identifiers.
    $identifiers = ['mbox', 'mbox_sha1sum', 'open_id', 'account'];
    $used_identifiers = count(array_filter($identifiers, function ($identifier) {
      return isset($this->value->{$identifier});
    }));

    // Checks that only one identifier is used.
    if ($used_identifiers !== 1) {
      $errors[] = new Error('An Actor must have exactly one identifier');
    }

    return array_merge($errors, parent::validate());
  }
}
