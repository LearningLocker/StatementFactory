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
