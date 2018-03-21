<?php
namespace Vanqard\VanTypes\JsonDateTime;

use Doctrine\DBAL\Types\Type as DoctrineType;
use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * Class JsonDateTimeType
 * @package Vanqard\VanTypes\JsonDateTime
 */
class JsonDateTimeType extends DoctrineType
{
    const VANQARD_JSON_DATE_TIME = 'VanqardJsonDateTime';

    /**
     * @param array $fieldDeclaration
     * @param AbstractPlatform $platform
     * @return string
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return 'jsondatetime';
    }

    /**
     * @param null|string $value
     * @param AbstractPlatform $platform
     * @return JsonDateTime
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        $returnValue = null;
        if (is_string($value) && date_create($value)) {
            $returnValue = new JsonDateTime($value);
        }
        return $returnValue;
    }

    /**
     * @param mixed $value
     * @param AbstractPlatform $platform
     * @return null|string
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (empty($value)) {
            return null;
        }

        $returnValue = null;

        if (is_object($value) && $value instanceof \DateTime) {
            $returnValue = $value->format('Y-m-d H:i:s');
        }

        if (is_string($value)) {
            $returnValue = $value;
        }

        return $returnValue;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return self::VANQARD_JSON_DATE_TIME;
    }
}
