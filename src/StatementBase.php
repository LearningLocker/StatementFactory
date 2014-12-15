<?php namespace Locker\XApi;

class StatementBase extends Element {
  protected $props = [
    'actor' => 'Locker\XApi\Actor',
    'verb' => 'Locker\XApi\Verb',
    'object' => 'Locker\XApi\Object',
    'result' => 'Locker\XApi\Result',
    'context' => 'Locker\XApi\Context',
    'timestamp' => 'Locker\XApi\Timestamp',
    'attachments' => 'Locker\XApi\Attachments'
  ];
  protected $required_props = ['actor', 'verb', 'object'];
}

class Attachments extends Collection {
  protected $member_type = 'Locker\XApi\Attachment';
}

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

class IMT extends RegexpAtom {
  protected static $pattern = '/^(application|audio|example|image|message|model|multipart|text|video)(\/[-\w\+]+)(;\s*[-\w]+\=[-\w]+)*;?$/';
}

class Integer extends TypedAtom {
  protected static $expected_types = ['integer'];
}
