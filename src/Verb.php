<?php namespace Locker\XApi;

class Verb extends Element {
  protected $props = [
    'id' => 'Locker\XApi\IRI',
    'display' => 'Locker\XApi\LanguageMap',
  ];

  protected $required_props = ['id'];
}
