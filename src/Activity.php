<?php namespace Locker\XApi;

class Activity extends Element {
  protected $props = [
    'id' => 'Locker\XApi\IRI',
    'definition' => 'Locker\XApi\ObjectDefinition',
    'objectType' => 'Locker\XApi\ObjectType'
  ];
  protected $required_props = ['id'];
}
