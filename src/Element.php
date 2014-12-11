<?php namespace Locker\XApi;

use Locker\XApi\Errors\MissingProperties as MissingProperties;
use Locker\XApi\Errors\UnknownProperties as UnknownProperties;
use Locker\XApi\Errors\Error as Error;

abstract class Element extends Atom {
  protected static $props = [];
  protected static $required_props = [];
  protected static $default_props = [];
  protected static $allow_unknown_props = null;

  /**
   * Constructs a new instance of Element from the $value.
   * @param mixed $value
   */
  public function __construct($value = null) {
    $this->value = new \stdClass();

    // Sets defaults.
    foreach (static::getDefaultProps() as $key => $value) {
      $this->value->{$key} = $value;
    }

    parent::__construct($value);
  }

  /**
   * Gets the default properties.
   * @return [string => mixed]
   */
  protected static function getDefaultProps() {
    $current_class = get_called_class();
    $parent_class = get_parent_class($current_class);
    $parent_props = $parent_class === 'Locker\XApi\Atom' ? [] : $parent_class::getDefaultProps();
    return array_merge($parent_props, static::$default_props) ?: [];
  }

  /**
   * Gets the known properties.
   * @return [string]
   */
  protected static function getKnownProps() {
    return array_keys(static::getProps());
  }

  /**
   * Gets the expected properties.
   * @return [string => string]
   */
  protected static function getProps() {
    $current_class = get_called_class();
    $parent_class = get_parent_class($current_class);
    $parent_props = $parent_class === 'Locker\XApi\Atom' ? [] : $parent_class::getProps();
    return array_merge($parent_props, static::$props) ?: [];
  }

  /**
   * Gets the required properties.
   * @return [string]
   */
  protected static function getRequiredProps() {
    $current_class = get_called_class();
    $parent_class = get_parent_class($current_class);
    $parent_props = $parent_class === 'Locker\XApi\Atom' ? [] : $parent_class::getRequiredProps();
    return array_merge($parent_props, static::$required_props) ?: [];
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
    $known_props = static::getKnownProps();
    $usable_props = array_intersect($set_props, $known_props);

    // Finds missing properties.
    $missing_props = array_diff(static::getRequiredProps(), $set_props);
    if (!empty($missing_props)) {
      $errors[] = new MissingProperties($missing_props);
    }

    // Finds unknown properties.
    if (!static::$allow_unknown_props) {
      $unknown_props = array_diff($set_props, $known_props);
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

    $defaults = static::getDefaultProps();

    if ($prop_value === null) {
      if (isset($defaults[$prop_key])) {
        $this->value->{$prop_key} = null;
      }
    } else {
      $props = static::getProps();
      $known_props = static::getKnownProps();

      // Constructs the $prop_value if it's a known a property and hasn't been constructed.
      if (in_array($prop_key, $known_props) && !Helpers::isType($prop_value, $props[$prop_key])) {
        $this->value->{$prop_key} = new $props[$prop_key]($prop_value);
      } else {
        $this->value->{$prop_key} = $prop_value;
      }
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
