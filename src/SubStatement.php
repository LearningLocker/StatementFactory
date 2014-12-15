<?php namespace Locker\XApi;

use Locker\XApi\Errors\Error as Error;

class SubStatement extends StatementBase {
  use TypedElement;

  protected $props = [
    'objectType' => 'Locker\XApi\ObjectType'
  ];
  protected $required_props = ['objectType'];
  protected $type = 'SubStatement';
  protected $type_prop = 'objectType';

  public function __construct($value = null) {
    $this->addDefaults();
    parent::__construct($value);
  }

  public function validate() {
    $errors = parent::validate();
    $errors = array_merge($errors, $this->validateTypedElement());

    $object = $this->getProp('object');
    $object_type = $object !== null ? $object->getProp('objectType') : null;
    $object_type = $object_type !== null ? $object_type->getValue() : null;

    if ($object_type === 'SubStatement') {
      $class = get_class($this);
      $errors[] = new Error("`$class` cannot contain a `SubStatement`");
    }

    return $errors;
  }
}
