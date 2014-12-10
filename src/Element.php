<?php namespace Locker\XApi;

use Locker\XApi\Errors\MissingProperties as MissingProperties;
use Locker\XApi\Errors\UnknownProperties as UnknownProperties;
use Locker\XApi\Errors\Error as Error;

abstract class Element extends Atom {
  protected $props = [];
  protected $required_props = [];
  protected $allow_unknown_props = false;
  private $known_props = [];

  /**
   * Constructs a new instance of Element from the $value.
   * @param mixed $value
   */
  public function __construct($value = null) {
    $this->value = new \stdClass();
    $this->known_props = array_keys($this->props);
    parent::__construct($value);
  }

  /**
   * Adds properties from $new_value.
   * @param \stdClass $new_value
   * @return Element $this
   */
  public function setValue($new_value) {
    Helpers::checkType('new_value', 'stdClass', $new_value);
    $new_props = $this->getSetProps($new_value);

    foreach ($new_props as $new_prop) {
      $this->setProp($new_prop, $new_value->{$new_prop});
    }

    return $this;
  }

  /**
   * Gets all of the properties set on an $object or ($this->value).
   * @param Object
   * @return [string]
   */
  private function getSetProps($object = null) {
    $object = $object ?: $this->value;
    return array_keys((array) $object);
  }

  /**
   * Outputs the value of $this.
   * @return stdClass
   */
  public function getValue() {
    $value = clone($this->value);
    $set_props = $this->getSetProps();

    // Adds properties to value.
    foreach ($set_props as $set_prop) {
      if ($value->{$set_prop} instanceof Atom) {
        $value->{$set_prop} = $value->{$set_prop}->getValue();
      }
    }

    return $value;
  }

  /**
   * Validates $this.
   * @return [Error]
   */
  public function validate() {
    $errors = [];

    // Gets properties.
    $set_props = $this->getSetProps();
    $usable_props = array_intersect($set_props, $this->known_props);

    // Finds missing properties.
    $missing_props = array_diff($this->required_props, $set_props);
    if (!empty($missing_props)) {
      $errors[] = new MissingProperties($missing_props);
    }

    // Finds unknown properties.
    if (!$this->allow_unknown_props) {
      $unknown_props = array_diff($set_props, $this->known_props);
      if (!empty($unknown_props)) {
        $errors[] = new UnknownProperties($unknown_props);
      }
    }

    // Validates usable properties.
    foreach ($set_props as $set_prop) {
      if ($this->value->{$set_prop} instanceof Atom) {
        $prop_errors = $this->value->{$set_prop}->validate();
        $errors = array_merge(array_map(function (Error $error) use ($set_prop) {
          return $error->addTrace($set_prop);
        }, $prop_errors), $errors);
      }
    }

    return $errors;
  }

  /**
   * Sets $prop_key on $this->value using $prop_value.
   * @param string $prop_key
   * @param mixed $prop_value
   * @return Element $this
   */
  public function setProp($prop_key, $prop_value) {
    Helpers::checkType('prop_key', 'string', $prop_key);

    // Constructs the $prop_value if it's a known a property and hasn't been constructed.
    if (in_array($prop_key, $this->known_props) && !Helpers::isType($prop_value, $this->props[$prop_key])) {
      $this->value->{$prop_key} = new $this->props[$prop_key]($prop_value);
    } else {
      $this->value->{$prop_key} = $prop_value;
    }

    return $this;
  }

  /**
   * Gets $prop_key on $this->value.
   * @param string $prop_key
   * @return mixed
   */
  public function getProp($prop_key) {
    Helpers::checkType('prop_key', 'string', $prop_key);
    return isset($this->value->{$prop_key}) ? $this->value->{$prop_key} : null;
  }
}
