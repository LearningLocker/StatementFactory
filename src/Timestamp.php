<?php namespace Locker\XApi;

class Timestamp extends RegexpAtom {
  protected static $pattern = '/^([\+-]?\d{4}(?!\d{2}\b))((-?)((0[1-9]|1[0-2])(\3([12]\d|0[1-9]|3[01]))?|W([0-4]\d|5[0-2])(-?[1-7])?|(00[1-9]|0[1-9]\d|[12]\d{2}|3([0-5]\d|6[1-6])))([T\s]((([01]\d|2[0-3])((:?)[0-5]\d)?|24\:?00)([\.,]\d+(?!:))?)?(\17[0-5]\d([\.,]\d+)?)?([zZ]|((?!-0{2}(:0{2})?)([\+-])([01]\d|2[0-3]):?([0-5]\d)?)?)?)?)?$/';

  /**
   * Sets the $value.
   * @param mixed $new_value
   * @return Atom $this
   */
  public function setValue($new_value) {
    if (preg_match('/[-+]\d\d$/', $new_value)) {
      $new_value .= ':00';
    }
    return parent::setValue($new_value);
  }
}
