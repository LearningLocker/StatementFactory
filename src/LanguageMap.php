<?php namespace Locker\XApi;

use Locker\XApi\Language as Language;

class LanguageMap extends Element {
  protected $allow_unknown_props = true;

  public function validate() {
    $errors = [];
    foreach ($this->getSetProps() as $set_prop) {
      $errors = array_merge($errors, (new Language($set_prop))->validate());
      $errors = array_merge($errors, array_map(function ($error) use ($set_prop) {
        return $error->addTrace($set_prop);
      }, (new String($this->value->{$set_prop}))->validate()));
    }
    return array_merge($errors, parent::validate());
  }
}
