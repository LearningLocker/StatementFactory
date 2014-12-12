<?php namespace Locker\XApi;

class ObjectType extends RegexpAtom {
  protected static $pattern = '/^(Agent)|(Group)|(StatementRef)|(SubStatement)|(Activity)$/';
}
