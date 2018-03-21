<?php
namespace Vanqard\VanTypes\JsonObjectArray;

use Doctrine\DBAL\Types\Type as DoctrineType;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Zumba\JsonSerializer\JsonSerializer;

/**
 * Class JsonObjectArrayType
 * @package Vanqard\VanTypes\JsonObjectArray
 */
class JsonObjectArrayType extends DoctrineType
{
    const VANQARD_JSON_OBJECT = 'VanqardJsonObjectArray';

    /**
     * @param array $fieldDeclaration
     * @param AbstractPlatform $platform
     * @return string
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return 'jsonobject';
    }

    /**
     * @return JsonSerializer
     */
    private function getSerializer() : JsonSerializer
    {
        $serializer = new JsonSerializer();
        return $serializer;
    }

    /**
     * @param mixed $value
     * @param AbstractPlatform $platform
     * @return mixed
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (empty($value)) {
            $value = '{}';
        }
        $serializer = $this->getSerializer();
        $hydrated = $serializer->unserialize($value);
        return $hydrated;
    }

    /**
     * @param mixed $value
     * @param AbstractPlatform $platform
     * @return string
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (empty($value)) {
            return '{}';
        }
        $serializer = $this->getSerializer();
        return $serializer->serialize($value);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return self::VANQARD_JSON_OBJECT;
    }
}
