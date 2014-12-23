<?php namespace Locker\XApi;

abstract class Atom {
  protected $value;

  /**
   * Constructs a new instance of Atom from the $value.
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
   * @return Atom $this
   */
  public function fromJson($json) {
    Helpers::checkType('json', 'string', $json);
    $decoded_value = json_decode($json);
    if ($decoded_value === null && ($json !== 'null' || $json !== '')) {
      throw new \Exception('Invalid JSON.');
    }
    return $this->setValue($decoded_value);
  }

  /**
   * Creates a new instance of an Atom object from $json.
   * @param string $json
   * @return Atom
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
