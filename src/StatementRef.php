<?php namespace Locker\XApi;

class StatementRef extends Element {
  protected $props = [
    'id' => 'Locker\XApi\UUID',
    'objectType' => 'Locker\XApi\ObjectType'
  ];
  protected $required_props = ['id'];
}
