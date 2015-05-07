<?php namespace Locker\XApi;

class Result extends Element {
  protected $props = [
    'score' => 'Locker\XApi\Score',
    'success' => 'Locker\XApi\Boolean',
    'completion' => 'Locker\XApi\Boolean',
    'response' => 'Locker\XApi\String',
    'duration' => 'Locker\XApi\Duration',
    'extensions' => 'Locker\XApi\Extensions',
  ];
}
