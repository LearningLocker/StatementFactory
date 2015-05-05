<?php namespace Locker\XApi;

class Activities extends Collection {
  protected $member_type = 'Locker\XApi\Activity';

  public function setValue($new_value) {
    if (is_object($new_value)) {
      $new_value = [$new_value];
    }
    return parent::setValue($new_value);
  }
}
