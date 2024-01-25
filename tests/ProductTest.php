<?php

namespace Tests;

use App\Entity\Product;
use App\Entity\Wallet;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public Product $product;

    protected function setUp(): void
    {
        parent::setUp();
        $this->product = new Product("Tacos 3 Viandes tah les oufs Tacos Lès Nancy RPZ", ["EUR" => 12], "food");
    }

    public function testWrongType(): void
    {
        $this->expectException(\Exception::class);
        $this->product->setType("tacos");
    }

    public function testGoodType(): void
    {
        $this->product->setType("alcohol");
        $this->assertEquals("alcohol", $this->product->getType());
    }

    public function testSetName(): void
    {
        $this->product->setName("Tacos du centre ville de Nancy");
        $this->assertEquals("Tacos du centre ville de Nancy", $this->product->getName());
    }

    public function testSetPrices(): void
    {
        $this->product->setPrices(["EUR" => 12, "USD" => 14]);
        $this->assertEquals(["EUR" => 12, "USD" => 14], $this->product->getPrices());
    }

    public function testSetPricesWithWrongCurrency(): void
    {
        $this->expectException(\Exception::class);
        $this->product->setPrices(["EUR" => 12, "USD" => 14, "TACOS" => 14]);
    }

    public function testSetPricesWithWrongPrice(): void
    {
        $this->expectException(\Exception::class);
        $this->product->setPrices(["EUR" => 12, "USD" => -14]);
    }

    public function testGetPrice(): void
    {
        $this->assertEquals(12, $this->product->getPrice("EUR"));
    }

    public function testGetPriceWithWrongCurrency(): void
    {
        $this->expectException(\Exception::class);
        $this->product->getPrice("TACOS");
    }

    public function testGetPriceWithWrongCurrency2(): void
    {
        $this->expectException(\Exception::class);
        $this->product->getPrice("USD");
    }

    public function testGetTva(): void
    {
        $this->assertEquals(2.0, $this->product->getTVA());
    }

    public function testListCurrencies(): void
    {
        $this->assertEquals(["EUR"], $this->product->listCurrencies());
    }


}
