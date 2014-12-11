<?php namespace Locker\XApi;

class Account extends Element {
  protected static $props = [
    'homePage' => 'Locker\XApi\IRI',
    'name' => 'Locker\XApi\String',
  ];
  protected static $required_props = ['homePage', 'name'];
}
