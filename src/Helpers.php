<?php namespace Locker\XApi;

class Helpers {
  /**
   * Expects $name to be of $type when $name is $value.
   * @param string $name
   * @param string $type
   * @param mixed $value
   */
  public static function checkType($name, $type, $value) {
    $given_type = self::getType($value);
    if ($given_type !== $type) {
      $value = $value instanceof Atom ? $value->toJson() : json_encode($value);
      throw new \UnexpectedValueException("`$value` should be a `$type` not `$given_type`. If you're decoding JSON, make sure you're using valid JSON.");
    }
  }

  /**
   * Checks that $value is the correct $type.
   * @param mixed $value
   * @param string $type
   * @return boolean
   */
  public static function isType($value, $type) {
    return self::getType($value) === $type;
  }

  /**
   * Gets the type of a $value.
   * @param mixed $value
   * @return string $type
   */
  public static function getType($value) {
    $type = gettype($value);
    if ($type === 'object') {
      return get_class($value);
    } else {
      return $type;
    }
  }
}
