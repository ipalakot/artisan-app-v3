<?php

namespace App\Tests;

use App\Entity\Categoryproduct; 

use PHPUnit\Framework\TestCase;

class CategoryproductTest extends TestCase
{
    public function testValide(): void
    {

        $category= new Categoryproduct();

        $category->setTitle('fruit');

        $this->assertTrue($category->getTitle()==='fruit');


    }


    public function testNonValide(): void
    {
        $category= new Categoryproduct();

        $category->setTitle('banane');

        $this->assertFalse($category->getTitle()==='pomme');


    }

    public function testVide(): void
    {
        $category= new Categoryproduct(); 
    
        $category->setTitle(''); 

        $this->assertEmpty($category->getTitle());



    }
}
