<?php namespace Locker\XApi;

use Locker\XApi\Errors\Error as Error;

class InteractionComponents extends Collection {
  protected $member_type = 'Locker\XApi\InteractionComponent';

  public function validate() {
    $errors = [];

    // Gets the ids of the components.
    $ids = array_map(function ($member) {
      return $member->getProp('id')->getValue();
    }, $this->value);

    // Checks that the IDs are distinct.
    $unique_ids = array_unique($ids);
    if (count($ids) > count($unique_ids)) {
      $duplicate_ids = array_diff_assoc($ids, $unique_ids);
      $errors[] = new Error('The IDs of interaction components must be distinct. The IDs ['.implode(', ', $duplicate_ids).'] were found to be duplicates');
    }

    return array_merge($errors, parent::validate());
  }
}
