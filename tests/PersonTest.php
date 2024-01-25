<?php


namespace Tests;

use App\Entity\Person;
use App\Entity\Product;
use App\Entity\Wallet;
use PHPUnit\Framework\TestCase;

class PersonTest extends TestCase
{
    public Person $Person;

    protected function setUp(): void
    {
        parent::setUp();
        $this->Person = new Person("Clement", "EUR");
    }

    public function testGetName(): void
    {
        $this->assertEquals("Clement", $this->Person->getName());
    }
    public function testSetName(): void
    {
        $this->Person->setName("N");
        $this->assertEquals("N", $this->Person->getName());
    }
    public function testGetWallet(): void
    {
        $this->assertEquals("EUR", $this->Person->getWallet()->getCurrency());
    }
    public function testSetWallet(): void
    {
        $this->Person->setWallet(new Wallet("USD"));
        $this->assertEquals("USD", $this->Person->getWallet()->getCurrency());
    }

    public function testSetWalletError(): void
    {
        $this->expectException(\TypeError::class);
        $this->Person->setWallet("USD");
    }

    public function testHasFundTrue(): void
    {
        $this->Person->getWallet()->setBalance(10);
        $this->assertTrue($this->Person->hasFund());
    }

    public function testHasFundFalse(): void
    {
        $this->assertFalse($this->Person->hasFund());
    }

    public function testTransfertFund(): void
    {
        $n = new Person("N", "EUR");
        $this->Person->getWallet()->setBalance(10);
        $this->Person->transfertFund(10, $n);
        $this->assertEquals(0, $this->Person->getWallet()->getBalance());
        $this->assertEquals(10, $n->getWallet()->getBalance());
    }

    public function testTransfertFundError(): void
    {
        $n = new Person("N", "EUR");
        $this->expectException(\Exception::class);
        $this->Person->transfertFund(10, $n);
    }
    public function testTransfertFundDifferentCurrency(): void
    {
        $n = new Person("N", "USD");
        $this->expectException(\Exception::class);
        $this->Person->transfertFund(10, $n);
    }
    public function testDivideWallet(): void
    {
        $n = new Person("N", "EUR");
        $this->Person->getWallet()->setBalance(10);
        $this->Person->divideWallet([$this->Person, $n]);
        $this->assertEquals(5, $this->Person->getWallet()->getBalance());
        $this->assertEquals(5, $n->getWallet()->getBalance());
    }

    public function testDivideWalletError(): void
    {
        $n = new Person("N", "EUR");
        $this->expectException(\Error::class);
        $this->Person->divideWallet([$this->Person, "n"]);
    }

    public function testBuyProduct(): void
    {
        $tacos = new Product("Tacos", ["EUR" => 10], "food");
        $this->Person->getWallet()->setBalance(10);
        $this->Person->buyProduct($tacos);
        $this->assertEquals(0, $this->Person->getWallet()->getBalance());
    }

    public function testBuyProductError(): void
    {
        $tacos = new Product("Tacos", ["EUR" => 10], "food");
        $this->expectException(\Exception::class);
        $this->Person->buyProduct($tacos);
    }

    public function testBuyProductWrongCurrency(): void
    {
        $tacos = new Product("Tacos", ["USD" => 10], "food");
        $this->Person->getWallet()->setBalance(10);
        $this->expectException(\Exception::class);
        $this->Person->buyProduct($tacos);
    }
}
