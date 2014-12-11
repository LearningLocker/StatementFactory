<?php namespace Locker\XApi;

class Mailto extends RegexpAtom {
  protected static $pattern = '/^mailto:[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i';
}
