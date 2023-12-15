<?php
namespace Slim\Tests;

use PHPUnit\Framework\TestCase;
use ReflectionClass;

class MigratingTestCase extends TestCase
{
    public function assertAttributeEquals(mixed $value, string $property, mixed $object): void
    {
        if (is_object($object)) {
            $reflectedClass = new ReflectionClass($object);
            $reflection = $reflectedClass->getProperty($property);
            $reflection->setAccessible(true);
            $attributeValue = $reflection->getValue($object);
            $this->assertEquals($value, $attributeValue);
        } elseif (is_array($object)) {
            $this->assertEquals($value, $object[$property]);
        } else {
            $this->fail(__METHOD__);
        }
    }

    public function assertAttributeSame(mixed $expected, string $property, mixed $object): void
    {
        if (is_object($object)) {
            $reflectedClass = new ReflectionClass($object);
            $reflection = $reflectedClass->getProperty($property);
            $reflection->setAccessible(true);
            $attributeValue = $reflection->getValue($object);
            $this->assertSame($expected, $attributeValue);
        } elseif (is_array($object)) {
            $this->assertSame($expected, $object[$property]);
        } else {
            $this->fail(__METHOD__);
        }
    }

    public function assertAttributeNotSame(mixed $expected, string $property, mixed $object): void
    {
        if (is_object($object)) {
            $reflectedClass = new ReflectionClass($object);
            $reflection = $reflectedClass->getProperty($property);
            $reflection->setAccessible(true);
            $attributeValue = $reflection->getValue($object);
            $this->assertNotSame($expected, $attributeValue);
        } elseif (is_array($object)) {
            $this->assertNotSame($expected, $object[$property]);
        } else {
            $this->fail(__METHOD__);
        }
    }

    public function assertAttributeContains(mixed $value, string $property, mixed $object): void
    {
        $reflectedClass = new ReflectionClass($object);
        $reflection = $reflectedClass->getProperty($property);
        $reflection->setAccessible(true);
        $attributeValue = $reflection->getValue($object);
        $this->assertIsArray($attributeValue);
        $this->assertContains($value, $attributeValue);
    }

    public function assertInternalType(string $type, mixed $object): void
    {
        switch ($type) {
            case 'array':
                $this->assertIsArray($object);
                break;
            case 'resource':
                $this->assertIsResource($object);
                break;
            case 'boolean':
                $this->assertIsBool($object);
                break;
            case 'callable':
                $this->assertIsCallable($object);
                break;
            case 'int':
                $this->assertIsInt($object);
                break;
            default:
                $this->assertTrue(false, 'Unknown type to assert: ' . $type);
                break;
        }
    }

    public function assertAttributeInstanceOf(string $expected, string $property, mixed $object): void
    {
        $reflectedClass = new ReflectionClass($object);
        $reflection = $reflectedClass->getProperty($property);
        $reflection->setAccessible(true);
        $attributeValue = $reflection->getValue($object);
        $this->assertInstanceOf($expected, $attributeValue);
    }
}
