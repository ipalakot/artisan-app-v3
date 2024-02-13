<?php

namespace App\Tests;
use App\Entity\User; 

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testValide(): void
    {
        $user= new User();

        $user->setLastname('hugo')
            ->setFirstname('victor')
            ->setEmail('victor@test.fr')
            ->setPassword('victormdp')
            ->setConfirmpassword('victormdp'); 


            $this->assertTrue($user->getLastname()==='hugo');
            $this->assertTrue($user->getFirstname()==='victor');
            $this->assertTrue($user->getEmail()==='victor@test.fr');
            $this->assertTrue($user->getPassword()==='victormdp');
            $this->assertTrue($user->getConfirmpassword()==='victormdp');
    }

    public function testNonValide(): void
    {
        $user= new User();

        $user->setLastname('hugo')
            ->setFirstname('victor')
            ->setEmail('victor@test.fr')
            ->setPassword('victormdp')
            ->setConfirmpassword('victormdp'); 


            $this->assertFalse($user->getLastname()==='zorro');
            $this->assertFalse($user->getFirstname()==='diego');
            $this->assertFalse($user->getEmail()==='diego@gmail.com');
            $this->assertFalse($user->getPassword()==='tornadomdp');
            $this->assertFalse($user->getConfirmpassword()==='cheval');

    }

    
    public function testVide(): void
    {
        $user= new User(); 

        $user->setLastname('')
            ->setFirstname('')
            ->setEmail('')
            ->setPassword('')
            ->setConfirmpassword('');
        
        
                $this->assertEmpty($user->getLastname());
        $this->assertEmpty($user->getFirstname());
        $this->assertEmpty($user->getPassword());
        $this->assertEmpty($user->getConfirmpassword());



    }
    




}
