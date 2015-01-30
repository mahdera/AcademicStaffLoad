<?php
  require_once (__DIR__ . '/../classes/Calculator.php');

  class CalculatorTest extends PHPUnit_Framework_TestCase{

    public function testAdd(){
      $a = new Calculator();
      $this->assertEquals(8, $a->add(4,4));
    }

  }//end class
?>
