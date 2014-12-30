<?php namespace Locker\XApi;

use Locker\XApi\Errors\Error as Error;

class Blueprint extends Element {
  const LOCKER_NAMESPACE = 'Locker\XApi\\';
  protected $default_type = 'Element';
  protected $accepted_types = [];
  protected $type_prop = 'objectType';

  public function __construct($value = null) {
    if ($value === null) return;
    $this->setValue($value);
  }

  public function setValue($new_value) {
    if (gettype($new_value) !== 'object') {
      $this->value = $new_value;
      return $this;
    }

    $previous_type = $this->value instanceof Element ? $this->value->getProp($this->type_prop) : null;
    $new_type = isset($new_value->{$this->type_prop}) ? $new_value->{$this->type_prop} : null;
    $type = $new_type ?: $previous_type ?: $this->default_type;

    if ($new_value !== null) {
      $new_value->{$this->type_prop} = $type;
      if (!in_array($type, $this->accepted_types)) {
        $type = 'Element';
      }
      $lockerClass = self::LOCKER_NAMESPACE.$type;
      $this->value = new $lockerClass($this->value);
      $this->value->setValue($new_value);
    }

    return $this;
  }

  protected function getSetProps($object = null) {
    return parent::getSetProps($object);
  }

  public function getValue() {
    if (gettype($this->value) !== 'object') {
      return $this->value;
    }

    return $this->value->getValue();
  }

  public function validate() {
    $value_type = gettype($this->value);
    if (gettype($this->value) !== 'object') {
      $encoded_value = json_encode($this->value);
      return [new Error("`$encoded_value` must be `object` not `$value_type`")];
    }

    $errors = [];
    if ($this->value !== null) {
      $type = $this->value->getProp($this->type_prop);
      $type = $type instanceof Atom ? $type->getValue() : $type;
      if (!in_array($type, $this->accepted_types)) {
        $errors[] = new Error(
          "`$type` (".get_class($this->value).") is not a valid `{$this->type_prop}` in `".get_class($this).'`. Acceptable types are `'.implode(', ', $this->accepted_types).'`'
        );
      }
    }
    return array_merge($errors, $this->value->validate());
  }

  public function setProp($prop_key, $prop_value) {
    if (gettype($this->value) !== 'object') {
      return $this;
    }

    $this->value->setProp($prop_key, $prop_value);
    return $this;
  }

  public function getProp($prop_key) {
    if (gettype($this->value) !== 'object') {
      return null;
    }

    return $this->value->getProp($prop_key);
  }
}
