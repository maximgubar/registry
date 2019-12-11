<?php

namespace unit;

use Nrgone\Registry\Registry;
use PHPUnit\Framework\TestCase;

class RegistryTest extends TestCase
{
    private $model;

    protected function setUp()
    {
        $this->model = new Registry();
    }

    public function testSetWithNotExistingKeyReturnsSuccess(): void
    {
        $key = 'foo';
        $value = 'bar';

        $this->model->set($key, $value);
        $this->assertEquals($value, $this->model->get($key));
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testSetWithExistingKeyThrowsException(): void
    {
        $key = 'foo';
        $firstValue = 'bar_1';
        $secondValue = 'bar_2';

        $this->expectExceptionMessage(sprintf('Key [%s] already exists in registry.', $key));

        $this->model->set($key, $firstValue);
        $this->model->set($key, $secondValue);
    }

    public function testSetForceWithExistingKeyReturnsSuccess(): void
    {
        $key = 'foo';
        $firstValue = 'bar_1';
        $secondValue = 'bar_2';

        $this->model->set($key, $firstValue);
        $this->assertEquals($firstValue, $this->model->get($key));

        $this->model->set($key, $secondValue, true);
        $this->assertEquals($secondValue, $this->model->get($key));
    }

    public function testHasWithNotExistingKeyReturnsFalse(): void
    {
        $this->assertFalse($this->model->has('foo'));
    }

    public function testHasWithExistingKeyReturnsTrue(): void
    {
        $key = 'foo';
        $value = 'bar';

        $this->model->set($key, $value);

        $this->assertTrue($this->model->has($key));
    }

    public function testRemove(): void
    {
        $key = 'foo';
        $value = 'bar';

        $this->model->set($key, $value);

        $this->assertTrue($this->model->has($key));

        $this->model->remove($key);

        $this->assertFalse($this->model->has($key));
    }

    public function testGetWithNotExistingKeyReturnsNull(): void
    {
        $this->assertNull($this->model->get('foo'));
    }

    public function testGetWithExistingKeyReturnsValue(): void
    {
        $key = 'foo';
        $value = 'bar';

        $this->model->set($key, $value);

        $this->assertEquals($value, $this->model->get($key));
    }
}
