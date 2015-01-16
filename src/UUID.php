<?php namespace Locker\XApi;

class UUID extends RegexpAtom {
  protected static $pattern = '/^\{?[A-Z0-9]{8}-[A-Z0-9]{4}-[A-Z0-9]{4}-[8,9,a,b][A-Z0-9]{3}-[A-Z0-9]{12}\}?$/i';
  protected static $invalid_message = 'Only versions of variant 2 in RFC 4122 are valid. ';
}
