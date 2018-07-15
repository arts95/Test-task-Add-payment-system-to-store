<?php

namespace AppBundle\Service;

/**
 * Class CountryService.
 */
class CountryService
{
    /**
     * @var string
     */
    private $url;

    /**
     * CountryService constructor.
     *
     * @param string $url
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * @param string $ip
     *
     * @return null|string
     */
    public function getCountryCodeAlpha3(string $ip): ?string
    {
        /** speed decision */
        $ipData = @json_decode(file_get_contents("{$this->url}?ip={$ip}"));
        if ($ipData && null !== $ipData->geoplugin_countryName) {
            $alpha2 = $ipData->geoplugin_countryCode;
        }
        $codes = \CountryCodes::get('alpha2', 'alpha3');
        if (isset($alpha2) && isset($codes[$alpha2])) {
            return $codes[$alpha2];
        }

        return null;
    }
}
