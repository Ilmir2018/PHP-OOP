<?php

class MyTest extends \PHPUnit\Framework\TestCase
{
    public function testFirst(){
        $a = 2 + 2;
        $this->assertGreaterThan(0, $a);
        $this->assertTrue(is_numeric($a));
        $this->assertEquals(4, $a);
    }

    public function testProduct(){
        $product = new \app\model\Product();
        $string = "This is description";
        $product->discription = $string;

        $result = $product->getShortDescription();
        $this->assertTrue(is_string($result));
        $this->assertEquals(10, mb_strlen($result));
        $this->assertEquals(mb_substr($string, 0 , 10), $result);
    }
}