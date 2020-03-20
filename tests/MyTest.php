<?php

class MyTest extends \PHPUnit\Framework\TestCase {

    public function testFirst(){
        $a = 2 + 2;
        $this->assertEquals(4, 2 + 2);
        $this->assertTrue(is_numeric($a));
    }

    public function testProduct(){
        $product = new \app\models\Product();
        $product->description = "This is description";

        $result = $product->getShortDescription();
        $this->assertTrue(is_string($result));
        $this->assertEquals(mb_substr($product->description, 0, 10), $result);
    }

}
