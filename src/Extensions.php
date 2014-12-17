<?php namespace Locker\XApi;

class Extensions extends Element {
  protected $allow_unknown_props = true;

  public function validate() {
    $errors = [];
    foreach ($this->getSetProps() as $set_prop) {
      $errors = array_merge($errors, (new IRI($set_prop))->validate());
    }
    return array_merge($errors, parent::validate());
  }
}
