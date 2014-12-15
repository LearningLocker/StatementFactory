<?php namespace Locker\XApi;

class Activity extends Element {
  use TypedElement;

  protected $props = [
    'id' => 'Locker\XApi\IRI',
    'definition' => 'Locker\XApi\ObjectDefinition',
    'objectType' => 'Locker\XApi\ObjectType'
  ];
  protected $required_props = ['id', 'objectType'];
  protected $type = 'Activity';
  protected $type_prop = 'objectType';

  public function __construct($value = null) {
    $this->addDefaults();
    parent::__construct($value);
  }

  public function validate() {
    return array_merge(parent::validate(), $this->validateTypedElement());
  }
}
