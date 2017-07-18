<?php

/*
 * This file is part of Cachet SDK.
 *
 * (c) Alt Three Services Limited
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CachetHQ\SDK\Entity;

use DateTime;
use DateTimeZone;
use ReflectionClass;
use ReflectionProperty;
use stdClass;

/**
 * This is the abstract entity class.
 *
 * @author James Brooks <james@alt-three.com>
 */
abstract class AbstractEntity
{
    /**
     * Create a new abstract entity instance.
     *
     * @param \stdClass|array|null $parameters
     *
     * @return void
     */
    public function __construct($parameters = null)
    {
        if (!$parameters) {
            return;
        }

        if ($parameters instanceof stdClass) {
            $parameters = get_object_vars($parameters);
        }

        $this->build($parameters);
    }

    /**
     * Build the entity.
     *
     * @param array $parameters
     *
     * @return void
     */
    public function build(array $parameters)
    {
        foreach ($parameters as $property => $value) {
            $property = static::convertToCamelCase($property);

            if (property_exists($this, $property)) {
                $this->$property = $value;
            }
        }
    }

    /**
     * Convert an entity to an array.
     *
     * @return array
     */
    public function toArray()
    {
        $settings = [];
        $called = get_called_class();
        $reflection = new ReflectionClass($called);
        $properties = $reflection->getProperties(ReflectionProperty::IS_PUBLIC);

        foreach ($properties as $property) {
            $prop = $property->getName();

            if (isset($this->$prop) && $property->class == $called) {
                $settings[self::convertToSnakeCase($prop)] = $this->$prop;
            }
        }

        return $settings;
    }

    /**
     * Convert a string to a ISO8601 format.
     *
     * @param string|null $date
     *
     * @return string|null
     */
    protected static function convertDateTime($date)
    {
        if (!$date) {
            return;
        }

        $date = new DateTime($date);
        $date->setTimezone(new DateTimeZone(date_default_timezone_get()));

        return $date->format(DateTime::ISO8601);
    }

    /**
     * Converts a string to camelCase.
     *
     * @param string $str
     *
     * @return string
     */
    protected static function convertToCamelCase($str)
    {
        $callback = function ($match) {
            return strtoupper($match[2]);
        };

        return lcfirst(preg_replace_callback('/(^|_)([a-z])/', $callback, $str));
    }

    /**
     * Convert a string to snake_case.
     *
     * @param string $str
     *
     * @return string
     */
    protected static function convertToSnakeCase($str)
    {
        return strtolower(implode('_', preg_split('/(?=[A-Z])/', $str)));
    }
}
