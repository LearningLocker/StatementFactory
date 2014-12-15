<?php

trait TraitA {
  public function methodA() {
    return parent::methodA();
  }
}

class ClassA {
  public function methodA() {
    return 'Message B';
  }
}

class ClassB extends ClassA {
  use TraitA;
}

echo json_encode(
  (new ClassB)->methodA()
);
