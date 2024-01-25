<?php

namespace Tests;

use App\Entity\Person;
use App\Entity\Wallet;
use PHPUnit\Framework\TestCase;

class WalletTest extends TestCase
{
    public Wallet $wallet;

    protected function setUp(): void
    {
        parent::setUp();
        $this->wallet = new Wallet("EUR");
    }

    public function testGetBalance(): void
    {
        $this->assertEquals(0, $this->wallet->getBalance());
    }
    public function testGetCurrency(): void
    {
        $this->assertEquals("EUR", $this->wallet->getCurrency());
    }
    public function testSetBalance(): void
    {
        $this->wallet->setBalance(10);
        $this->assertEquals(10, $this->wallet->getBalance());
    }

    public function testSetBalanceNeg(): void
    {
        $this->expectException(\Exception::class);
        $this->wallet->setBalance(-10);
    }
    public function testSetCurrency(): void
    {
        $this->wallet->setCurrency("USD");
        $this->assertEquals("USD", $this->wallet->getCurrency());
    }

    public function testSetCurrencyError(): void
    {
        $this->expectException(\Exception::class);
        $this->wallet->setCurrency("USDD");
    }

    public function testRemoveFund(): void
    {
        $this->wallet->setBalance(10);
        $this->wallet->removeFund(5);
        $this->assertEquals(5, $this->wallet->getBalance());
    }

    public function testRemoveFundNeg(): void
    {
        $this->expectException(\Exception::class);
        $this->wallet->setBalance(10);
        $this->wallet->removeFund(-5);
    }

    public function testRemoveFundError(): void
    {
        $this->expectException(\Exception::class);
        $this->wallet->setBalance(10);
        $this->wallet->removeFund(15);
    }

    public function testAddFund(): void
    {
        $this->wallet->setBalance(10);
        $this->wallet->addFund(5);
        $this->assertEquals(15, $this->wallet->getBalance());
    }

    public function testAddFundNeg(): void
    {
        $this->expectException(\Exception::class);
        $this->wallet->setBalance(10);
        $this->wallet->addFund(-5);
    }
}
