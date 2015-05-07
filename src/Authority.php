<?php namespace Locker\XApi;

use Locker\XApi\Errors\Error as Error;

class Authority extends Actor {
  public function validate() {
    $errors = parent::validate();

    $object_type = $this->getProp('objectType');
    $object_type = $object_type !== null && $object_type instanceof Atom ? $object_type->getValue() : null;
    if ($object_type === 'Group') {
      $members = $this->getProp('members');
      $members = $members !== null && $members instanceof Atom ? $members->getValue() : [];
      $members_count = count($members);
      if ($members_count !== 2) {
        $errors[] = new Error("An authority must be an `Agent` or a `Group` with exactly two Agents not `$members_count` members");
      } else {
        foreach ($members as $index => $member) {
          if ($member->objectType !== 'Agent') {
            $errors[] = new Error("All members of an authority must be Agents, but member `$index` is a `{$member->objectType}`");
          }
        }
      }
    }

    return $errors;
  }
}
