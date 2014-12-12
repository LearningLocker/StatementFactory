<?php namespace Locker\XApi;

class Actor extends Blueprint {
  protected $default_type = 'Agent';
  protected $accepted_types = ['Agent', 'Group'];
}
