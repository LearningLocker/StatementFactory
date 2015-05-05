<?php namespace Locker\XApi;

class Version extends RegexpAtom {
  protected static $pattern = '/^1\.0\.[0-9]+$/';
}
