<?php namespace Locker\XApi;

define('ISO_YEAR', '(\d{4})');
define('ISO_MONTH', '((0[1-9])|(1[012]))');
define('ISO_DAY', '((0[1-9])|([12]\d)|(3[01]))');
define('ISO_HOUR', '(([01]\d)|(2[0123]))');
define('ISO_NZ_HOUR', '((0[1-9])|(1\d)|(2[0123]))');
define('ISO_MINUTE', '([012345]\d)');
define('ISO_SECOND', '([012345]\d)');
define('ISO_FRACTION', '(\d+)');
define('ISO_DATE_SEPARATOR', '-');
define('ISO_TIME_SEPARATOR', ':');

define('ISO_BASIC_DATE', '('.ISO_YEAR.ISO_MONTH.ISO_DAY.')');
define('ISO_BASIC_TIME', '('.ISO_HOUR.'('.ISO_MINUTE.'('.ISO_SECOND.ISO_FRACTION.'?)?)?)');
define('ISO_BASIC_ZONE', '(Z|(\+'.ISO_HOUR.ISO_MINUTE.'?)|(\-'.ISO_NZ_HOUR.ISO_MINUTE.'?))');
define('ISO_BASIC', '('.ISO_BASIC_DATE.'(T'.ISO_BASIC_TIME.ISO_BASIC_ZONE.')?)');

define('ISO_EXTENDED_MONTH', '('.ISO_DATE_SEPARATOR.ISO_MONTH.')');
define('ISO_EXTENDED_DAY', '('.ISO_DATE_SEPARATOR.ISO_DAY.')');
define('ISO_EXTENDED_MINUTE', '('.ISO_TIME_SEPARATOR.ISO_MINUTE.')');
define('ISO_EXTENDED_SECOND', '('.ISO_TIME_SEPARATOR.ISO_SECOND.')');
define('ISO_EXTENDED_FRACTION', '(\.'.ISO_FRACTION.')');

define('ISO_EXTENDED_DATE', '('.ISO_YEAR.ISO_EXTENDED_MONTH.ISO_EXTENDED_DAY.')');
define('ISO_EXTENDED_TIME', '('.ISO_HOUR.'('.ISO_EXTENDED_MINUTE.'('.ISO_EXTENDED_SECOND.ISO_EXTENDED_FRACTION.'?)?)?)');
define('ISO_EXTENDED_ZONE', '(Z|(\+'.ISO_HOUR.ISO_EXTENDED_MINUTE.'?)|(\-'.ISO_NZ_HOUR.ISO_EXTENDED_MINUTE.'?))');
define('ISO_EXTENDED', '('.ISO_EXTENDED_DATE.'(T'.ISO_EXTENDED_TIME.ISO_EXTENDED_ZONE.')?)');

define('ISO_TIMESTAMP', '/^('.ISO_EXTENDED.'|'.ISO_BASIC.')$/');

class Timestamp extends RegexpAtom {
  protected static $pattern = ISO_TIMESTAMP;

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
