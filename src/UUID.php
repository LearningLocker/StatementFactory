<?php namespace Locker\XApi;

class UUID extends RegexpAtom {
  protected static $pattern = '/^\{?[A-Z0-9]{8}-[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{12}\}?$/i';
}
