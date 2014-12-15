<?php namespace Locker\XApi;

class Context extends Element {
  protected $props = [
    'registration' => 'Locker\XApi\UUID',
    'instructor' => 'Locker\XApi\Actor',
    'team' => 'Locker\XApi\Group',
    'contextActivities' => 'Locker\XApi\ContextActivities',
    'revision' => 'Locker\XApi\String',
    'platform' => 'Locker\XApi\String',
    'language' => 'Locker\XApi\Language',
    'statement' => 'Locker\XApi\StatementRef',
    'extensions' => 'Locker\XApi\Extensions'
  ];
}

class ContextActivities extends Element {
  protected $props = [
    'parent' => 'Locker\XApi\Activities',
    'grouping' => 'Locker\XApi\Activities',
    'category' => 'Locker\XApi\Activities',
    'other' => 'Locker\XApi\Activities'
  ];
}

class Activities extends Collection {
  protected $member_type = 'Locker\XApi\Activity';
}
