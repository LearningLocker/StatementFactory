<?php namespace Locker\XApi;

class Statement extends Element {
  protected $props = [
    'actor' => 'Locker\XApi\Actor',
    'verb' => 'Locker\XApi\Verb',
    'object' => 'Locker\XApi\Object'
  ];
  protected $required_props = [
    'actor', 'verb', 'object'
  ];
}

class String extends Atom {}

class Actor extends Element {
  protected $props = [
    'name' => 'Locker\XApi\String'
  ];
}

class Verb extends Atom {

}

class Object extends Atom {

}
