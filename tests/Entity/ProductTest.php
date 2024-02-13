<?php

namespace App\Tests;

use App\Entity\Product; 
use App\Entity\Categoryproduct; 
use App\Entity\Trader; 


use PHPUnit\Framework\TestCase; 

class ProductTest extends TestCase
{
    public function testValide(): void
    {
    
        $product= new Product(); 

        $product->setTitle('kiwi')
            ->setDescription('description')
            ->setWeightprice(0.99)
            ->setUnitprice(0.10)
            ->setWeightproduct(1.4)
            ->setComposition('composition'); 
            

            $this->assertTrue($product->getTitle()==='kiwi');
            $this->assertTrue($product->getDescription()==='description');
            $this->assertTrue($product->getWeightprice()===0.99);
            $this->assertTrue($product->getUnitprice()===0.10);
            $this->assertTrue($product->getWeightproduct()===1.4);
            $this->assertTrue($product->getComposition()==='composition');

            

    
    }

    public function testNonValide(): void
    {

        $product= new Product(); 

        $product->setTitle('kiwi')
            ->setDescription('description')
            ->setWeightprice(0.99)
            ->setUnitprice(0.10)
            ->setWeightproduct(1.4)
            ->setComposition('composition'); 
            

            $this->assertFalse($product->getTitle()==='citron');
            $this->assertFalse($product->getDescription()==='ce bon produit');
            $this->assertFalse($product->getWeightprice()===0.75);
            $this->assertFalse($product->getUnitprice()===0.50);
            $this->assertFalse($product->getWeightproduct()===2.6);
            $this->assertFalse($product->getComposition()==='naturel');

 

    }

    public function testVide(): void
    {
        $product= new Product(); 

        $product->setTitle('')
            ->setDescription('')
            ->setWeightprice(0)
            ->setUnitprice(0)
            ->setWeightproduct(0)
            ->setComposition(''); 
            

            $this->assertEmpty($product->getTitle());
            $this->assertEmpty($product->getDescription());
            $this->assertEmpty($product->getWeightprice()===0);
            $this->assertEmpty($product->getUnitprice()===0);
            $this->assertEmpty($product->getWeightproduct()===0);
            $this->assertEmpty($product->getComposition());

 
    }















} //fin class 
