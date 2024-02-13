<?php

namespace App\Tests;
use App\Entity\Trader; 
use App\Entity\Image; 


use PHPUnit\Framework\TestCase;

class TraderTest extends TestCase
{
    public function testValide(): void
    {

        $trader= new Trader(); 

        $trader->setLastnameboss('duck')
            ->setFirstnameboss('donald')
            ->setEmail('donald@test.fr')
            ->setPhone('012345678')
            ->setPassword('donaldmdp')
            ->setConfirmpassword('donaldmdp')
            ->setAdress('adresse')
            ->setCity('paris')
            ->setPresentation('presentation')
            ->setPostalcode('75001'); 

            $this->assertTrue($trader->getLastnameboss()==='duck');
            $this->assertTrue($trader->getFirstnameboss()==='donald');
            $this->assertTrue($trader->getEmail()==='donald@test.fr');
            $this->assertTrue($trader->getPassword()==='donaldmdp');
            $this->assertTrue($trader->getConfirmpassword()==='donaldmdp');
            $this->assertTrue($trader->getPhone()==='012345678');
            $this->assertTrue($trader->getAdress()==='adresse');
            $this->assertTrue($trader->getPresentation()==='presentation');
            $this->assertTrue($trader->getCity()==='paris');
            $this->assertTrue($trader->getPostalcode()==='75001');

    }


    public function testNonValide(): void
    {
        $trader= new Trader(); 

        $trader->setLastnameboss('duck')
            ->setFirstnameboss('donald')
            ->setEmail('donald@test.fr')
            ->setPhone('012345678')
            ->setPassword('donaldmdp')
            ->setConfirmpassword('donaldmdp')
            ->setAdress('adresse')
            ->setCity('paris')
            ->setPresentation('presentation')
            ->setPostalcode('75001'); 

            $this->assertFalse($trader->getLastnameboss()==='mouse');
            $this->assertFalse($trader->getFirstnameboss()==='mickey');
            $this->assertFalse($trader->getEmail()==='mickey@test.fr');
            $this->assertFalse($trader->getPassword()==='mickeymdp');
            $this->assertFalse($trader->getConfirmpassword()==='mickeymdp');
            $this->assertFalse($trader->getPhone()==='0145632578');
            $this->assertFalse($trader->getAdress()==='rue');
            $this->assertFalse($trader->getPresentation()==='cool');
            $this->assertFalse($trader->getCity()==='lille');
            $this->assertFalse($trader->getPostalcode()==='59123');        
    }

    public function testVide(): void
    {
        $trader= new Trader();

        $trader->setLastnameboss('')
            ->setFirstnameboss('')
            ->setEmail('')
            ->setPhone('')
            ->setPassword('')
            ->setConfirmpassword('')
            ->setAdress('')
            ->setCity('')
            ->setPresentation('')
            ->setPostalcode(''); 

            $this->assertEmpty($trader->getLastnameboss()==='duck');
            $this->assertEmpty($trader->getFirstnameboss()==='donald');
            $this->assertEmpty($trader->getEmail()==='donald@test.fr');
            $this->assertEmpty($trader->getPassword()==='donaldmdp');
            $this->assertEmpty($trader->getConfirmpassword()==='donaldmdp');
            $this->assertEmpty($trader->getPhone()==='012345678');
            $this->assertEmpty($trader->getAdress()==='adresse');
            $this->assertEmpty($trader->getPresentation()==='presentation');
            $this->assertEmpty($trader->getCity()==='paris');
            $this->assertEmpty($trader->getPostalcode()==='75001');


    }


















} //fin class 
