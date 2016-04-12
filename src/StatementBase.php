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

  private function validateVoider($errors) {
    $verb_id = $this->getPropValue('verb.id');
    $object_type = $this->getPropValue('object.objectType');

    // Validates voider.
    if ($verb_id === 'http://adlnet.gov/expapi/verbs/voided' && $object_type !== 'StatementRef') {
      $errors[] = new Error("`object.objectType` must be `StatementRef` not `$object_type` when voiding");
    }

    return $errors;
  }

  private function validateContextForActivity($errors) {
    $object_type = $this->getPropValue('object.objectType');
    $is_activity = $object_type === 'Activity';

    // Validates context for activity.
    if ($this->getPropValue('context.revision') !== null && !$is_activity) {
      $errors[] = new Error("`context.revision` must only be used if `object.objectType` is `Activity` not `$object_type`");
    }
    if ($this->getPropValue('context.platform') !== null && !$is_activity) {
      $errors[] = new Error("`context.platform` must only be used if `object.objectType` is `Activity` not `$object_type`");
    }

    return $errors;
  }

  public function validate() {
    $errors = [];
    $errors = $this->validateVoider($errors);
    $errors = $this->validateContextForActivity($errors);

    return array_merge($errors, parent::validate());
  }
}
