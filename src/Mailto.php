<?php namespace Locker\XApi;

class Mailto extends RegexpAtom {
  protected $pattern = '/^mailto:[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i';
}
