<?php namespace Locker\XApi;

class Attachment extends Element {
  protected $props = [
    'usageType' => 'Locker\XApi\IRI',
    'display' => 'Locker\XApi\LanguageMap',
    'description' => 'Locker\XApi\LanguageMap',
    'contentType' => 'Locker\XApi\IMT',
    'length' => 'Locker\XApi\Integer',
    'sha2' => 'Locker\XApi\String',
    'fileUrl' => 'Locker\XApi\IRI'
  ];
  protected $required_props = ['usageType', 'display', 'contentType', 'length', 'sha2'];
}
