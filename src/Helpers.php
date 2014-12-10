<?php namespace Locker\XApi;

class Helpers {
  /**
   * Expects $name to be of $type when $name is $value.
   * @param string $name
   * @param string $type
   * @param mixed $value
   */
  public static function scalar($name, $type, $value) {
    if (gettype($value) !== $type) {
      throw new \UnexpectedValueException("Expected `$name` to be a `$type`.");
    }
  }

  /**
   * Expects $name to be an instance of $class when $name is $value.
   * @param string $name
   * @param string $class
   * @param mixed $value
   */
  public static function isclass($name, $class, $value) {
    if (get_class($value) !== $class) {
      throw new \UnexpectedValueException("Expected `$name` to be a `$class`.");
    }
  }
}
