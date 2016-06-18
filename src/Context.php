<?php namespace Locker\XApi;

class Context extends Element {
  protected $props = [
    'registration' => 'Locker\XApi\UUID',
    'instructor' => 'Locker\XApi\Actor',
    'team' => 'Locker\XApi\Group',
    'contextActivities' => 'Locker\XApi\ContextActivities',
    'revision' => 'Locker\XApi\Str',
    'platform' => 'Locker\XApi\Str',
    'language' => 'Locker\XApi\Language',
    'statement' => 'Locker\XApi\StatementRef',
    'extensions' => 'Locker\XApi\Extensions'
  ];
}
