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
