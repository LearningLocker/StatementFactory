<?php namespace Locker\XApi;

use Locker\XApi\Errors\Error as Error;

class Actor extends Element {
  protected $props = [
    'name' => 'Locker\XApi\String',
    'objectType' => 'Locker\XApi\ObjectType',
    'mbox' => 'Locker\XApi\Mailto',
    'mbox_sha1sum' => 'Locker\XApi\MboxSha1Sum',
    'openid' => 'Locker\XApi\IRI',
    'account' => 'Locker\XApi\Account',
  ];

  public function validate() {
    $errors = [];

    // Gets the used identifiers.
    $identifiers = ['mbox', 'mbox_sha1sum', 'open_id', 'account'];
    $used_identifiers = count(array_filter($identifiers, function ($identifier) {
      return isset($this->value->{$identifier});
    }));

    // Checks that only one identifier is used.
    if ($used_identifiers !== 1) {
      $errors[] = new Error('An Actor can only have one identifier', get_class($this));
    }

    return array_merge($errors, parent::validate());
  }
}
