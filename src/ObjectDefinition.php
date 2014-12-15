<?php namespace Locker\XApi;

class ObjectDefinition extends Definition {
  protected $props = [
    'interactionType' => 'Locker\XApi\InteractionType',
    'correctResponsesPattern' => 'Locker\XApi\Strings',
    'choices' => 'Locker\XApi\InteractionComponents',
    'scale' => 'Locker\XApi\InteractionComponents',
    'source' => 'Locker\XApi\InteractionComponents',
    'target' => 'Locker\XApi\InteractionComponents',
    'steps' => 'Locker\XApi\InteractionComponents'
  ];
  protected $knowable_props = ['choices', 'scale', 'source', 'target', 'steps'];
  protected $type_map = [
    'choice' => ['choices'],
    'sequencing' => ['choices'],
    'likert' => ['scale'],
    'matching' => ['source', 'target'],
    'performance' => ['steps']
  ];

  public function validate() {
    $errors = [];

    // Finds allowed props.
    $interaction_type = $this->getProp('interactionType');
    $interaction_type = $interaction_type instanceof Atom ? $interaction_type->getValue() : null;
    $allowed_props = isset($this->type_map[$interaction_type]) ? $this->type_map[$interaction_type] : [];

    // Changes known_props.
    $disallowed_props = array_diff($this->knowable_props, $allowed_props);
    $known_props = array_keys($this->props);
    $this->known_props = array_diff($known_props, $disallowed_props);

    return parent::validate();
  }
}

class InteractionType extends RegexpAtom {
  protected static $pattern = '/^(choice)|(sequencing)|(likert)|(matching)|(performance)|(true-false)|(fill-in)|(long-fill-in)|(numeric)|(other)$/';
}

use Locker\XApi\Errors\Error as Error;

class InteractionComponents extends Collection {
  protected $member_type = 'Locker\XApi\InteractionComponent';

  public function validate() {
    $errors = [];

    // Gets the ids of the components.
    $ids = array_map(function ($member) {
      return $member->getProp('id')->getValue();
    }, $this->value);

    // Checks that the IDs are distinct.
    $unique_ids = array_unique($ids);
    if (count($ids) > count($unique_ids)) {
      $duplicate_ids = array_diff_assoc($ids, $unique_ids);
      $errors[] = new Error('The IDs of interaction components must be distinct. The IDs ['.implode(', ', $duplicate_ids).'] were found to be duplicates');
    }

    return array_merge($errors, parent::validate());
  }
}

class InteractionComponent extends Element {
  protected $props = [
    'id' => 'Locker\XApi\String',
    'description' => 'Locker\XApi\LanguageMap'
  ];
}

class Strings extends Collection {
  protected $member_type = 'Locker\XApi\String';
}
