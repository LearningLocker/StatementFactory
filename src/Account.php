<?php namespace Locker\XApi;

class Account extends Element {
  protected $props = [
    'homePage' => 'Locker\XApi\IRI',
    'name' => 'Locker\XApi\Str',
  ];
  protected $required_props = ['homePage', 'name'];
}
