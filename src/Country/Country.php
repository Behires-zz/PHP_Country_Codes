<?php
namespace Behires\Country;


use Behires\Country\Exceptions\CountryISOInvalid;
use Behires\Country\Exceptions\CountryISONotFound;
use Behires\Country\Exceptions\CountryNameNotFound;

class Country
{
    /**
     * @var array Store the country list here
     */
    private static $list;

    /**
     * Check if the list is loaded and when not it will be loaded
     *
     * @return void
     */
    private static function listLoaded()
    {
        if(empty(self::$list)) {
            self::loadList();
        }
    }

    /**
     * Load the list in to the class
     *
     * @return void
     */
    private static function loadList()
    {
        self::$list = (require 'source.php');
    }

    /**
     * Return all countries
     *
     * @return array
     */
    public static function getList()
    {
        self::listLoaded();

        return self::$list;
    }

    /**
     * Get the information by a country name
     *
     * @param string $name The country name
     *
     * @return array
     *
     * @throws CountryNameNotFound
     */
    public static function getByCountryName($name)
    {
        $key = array_search($name, array_column(self::getList(), 'name'));

        if(!$key) {
            throw new CountryNameNotFound("The country name '" . $name . "' was not founded in the list!");
        }

        return self::$list[$key];
    }

    /**
     * Get the information by a ISO3 code
     *
     * @param string $iso3 The ISO3 country code
     *
     * @return array
     *
     * @throws CountryISOInvalid
     * @throws CountryISONotFound
     */
    public static function getByISO3($iso3)
    {
        if(strlen($iso3) != 3) {
            throw new CountryISOInvalid("The ISO3 format is not valid.");
        }

        $key = array_search($iso3, array_column(self::getList(), 'iso3'));

        if(!$key) {
            throw new CountryISONotFound("The ISO3 '" . $iso3 . "' was not founded in the list!");
        }

        return self::$list[$key];
    }

    /**
     * Get the information by a ISO2 code
     *
     * @param string $iso2 The ISO2 country code
     *
     * @return array
     *
     * @throws CountryISOInvalid
     * @throws CountryISONotFound
     */
    public static function getByISO2($iso2)
    {
        if(strlen($iso2) != 2) {
            throw new CountryISOInvalid("The ISO2 format is not valid.");
        }

        $key = array_search($iso2, array_column(self::getList(), 'iso2'));

        if(!$key) {
            throw new CountryISONotFound("The ISO2 '" . $iso2 . "' was not founded in the list!");
        }

        return self::$list[$key];
    }
}