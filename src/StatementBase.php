<?php namespace Locker\XApi;
use Locker\XApi\Errors\Error as Error;

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

  public function validate() {
    $errors = [];
    $verb_id = $this->getPropValue('verb.id');
    $object_type = $this->getPropValue('object.objectType');

    // Validates voider.
    if (
      $verb_id === 'http://adlnet.gov/expapi/verbs/voided' &&
      $object_type !== 'StatementRef'
    ) {
      $errors[] = new Error("`object.objectType` must be `StatementRef` not `$object_type` when voiding");
    }

    return array_merge($errors, parent::validate());
  }
}
