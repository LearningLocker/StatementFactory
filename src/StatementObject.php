<?php namespace Locker\XApi;

class StatementObject extends Blueprint {
  protected $default_type = 'Activity';
  protected $accepted_types = [
    'Activity',
    'Agent',
    'Group',
    'StatementRef',
    'SubStatement'
  ];
}
