<?php namespace Locker\XApi;

abstract class Atom {
  protected $value;

  /**
   * Constructs a new instance of IO from the $value.
   * @param mixed $value
   */
  public function __construct($value = null) {
    if ($value === null) return;
    $this->setValue($value);
  }

  /**
   * Outputs the value of $this as a JSON string.
   * @return string
   */
  public function toJson() {
    return json_encode($this->getValue());
  }

  /**
   * Adds properties from JSON.
   * @param string $json
   * @return IO $this
   */
  public function fromJson($json) {
    Helpers::scalar('json', 'string', $json);
    return $this->setValue(json_decode($json));
  }

  /**
   * Creates a new instance of an IO object from $json.
   * @param string $json
   * @return IO
   */
  public static function createFromJson($json) {
    $new_instance = new static();
    return $new_instance->fromJson($json);
  }

  /**
   * Sets the $value.
   * @param mixed $new_value
   * @return Atom $this
   */
  public function setValue($new_value) {
    $this->value = $new_value;
    return $this;
  }

  /**
   * Outputs the $value.
   * @return mixed
   */
  public function getValue() {
    return $this->value;
  }

  /**
   * Validates $this.
   * @return [Error]
   */
  public function validate() {
    return [];
  }
}
