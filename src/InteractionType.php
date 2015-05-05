<?php namespace Locker\XApi;

class InteractionType extends RegexpAtom {
  protected static $pattern = '/^(choice)|(sequencing)|(likert)|(matching)|(performance)|(true-false)|(fill-in)|(long-fill-in)|(numeric)|(other)$/';
}
