<?php namespace Locker\XApi;

class Score extends Element {
  protected $props = [
    'scaled' => 'Locker\XApi\Scaled',
    'raw' => 'Locker\XApi\Number',
    'min' => 'Locker\XApi\Number',
    'max' => 'Locker\XApi\Number'
  ];
}
