<?php

namespace App\Tests;

use App\Entity\Activitytype; 

use PHPUnit\Framework\TestCase;

class ActivitytypeTest extends TestCase
{
    public function testValide(): void
    {
        $activity= new Activitytype(); 

        $activity->setTitle('boucherie'); 
            
        $this->assertTrue($activity->getTitle()==='boucherie');
        

    }

    public function testNonValide(): void
    {
        $activity= new Activitytype(); 

        $activity->setTitle('fromagerie'); 

        $this->assertFalse($activity->getTitle()==='boucherie');

    }

    public function testVide(): void
    {
        $activity= new Activitytype(); 

        $activity->setTitle(''); 

        $this->assertEmpty($activity->getTitle());


    }






}
