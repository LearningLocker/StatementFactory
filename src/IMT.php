<?php namespace Locker\XApi;

class IMT extends RegexpAtom {
  protected static $pattern = '/^(application|audio|example|image|message|model|multipart|text|video)(\/[-\w\+]+)(;\s*[-\w]+\=[-\w]+)*;?$/';
}
