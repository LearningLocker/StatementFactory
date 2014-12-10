<?php namespace Locker\XApi;

class Statement extends Element {
  protected $props = [
    'id' => 'Locker\XApi\UUID',
    'actor' => 'Locker\XApi\Actor',
    'verb' => 'Locker\XApi\Verb',
    'object' => 'Locker\XApi\Object',
    'result' => 'Locker\XApi\Result',
    'context' => 'Locker\XApi\Context',
    'timestamp' => 'Locker\XApi\Timestamp',
    'stored' => 'Locker\XApi\Timestamp',
    'authority' => 'Locker\XApi\Authority',
    'version' => 'Locker\XApi\Version',
    'attachments' => 'Locker\XApi\Attachments'
  ];
  protected $required_props = ['actor', 'verb', 'object'];
}

class Verb extends Atom {}
class Object extends Atom {}
class Result extends Atom {}
class Context extends Atom {}
class Timestamp extends Atom {}
class Authority extends Atom {}
class Version extends Atom {}
class Attachments extends Atom {}

class ObjectType extends Atom {}
class MboxSha1Sum extends Atom {}
