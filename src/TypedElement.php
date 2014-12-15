<?php namespace Locker\XApi;

use Locker\XApi\Errors\Error as Error;

trait TypedElement {

  public function addDefaults() {
    $this->default_props = array_merge($this->default_props, [
      $this->type_prop => $this->type
    ]);
  }

  public function validateTypedElement() {
    $errors = [];

    $object_type = $this->getProp($this->type_prop);
    $object_type = $object_type instanceof Atom ? $object_type->getValue() : '';
    if ($object_type !== $this->type) {
      $errors[] = new Error("`{$this->type_prop}` must be `{$this->type}` not `$object_type`");
    }

    return $errors;
  }
}
