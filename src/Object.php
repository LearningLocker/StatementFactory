<?php namespace Locker\XApi;

class Object extends Blueprint {
  protected $default_type = 'Activity';
  protected $accepted_types = [
    'Activity',
    'Agent',
    'Group',
    'StatementRef',
    'SubStatement'
  ];
}
