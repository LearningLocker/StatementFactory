<?php namespace Locker\XApi;

class Sha1 extends RegexpAtom {
  protected static $pattern = '/^\b[0-9a-f]{5,40}$/i';
}
