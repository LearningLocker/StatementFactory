<?php namespace Locker\XApi;

class Statement extends StatementBase {
  protected $props = [
    'id' => 'Locker\XApi\UUID',
    'stored' => 'Locker\XApi\Timestamp',
    'authority' => 'Locker\XApi\Authority',
    'version' => 'Locker\XApi\Version'
  ];

  protected $default_props = [
    'version' => '1.0.0'
  ];
}
