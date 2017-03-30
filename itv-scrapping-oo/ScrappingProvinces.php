<?php

include_once 'Scrapping.php';

/**
 * Class ScrappingProvinces
 */
class ScrappingProvinces extends Scrapping
{
    /**
     * ScrappingProvinces constructor.
     * @param $url
     */
    public function __construct($url)
    {
        parent::__construct($url);
    }


    /**
     * @return array
     */
    public function extract()
    {
        $provinceUrls = [];

        $elements = $this->getDom()->find('#tituloDesplegable li a');
        foreach ($elements as $key => $provinceLink) {
            $link = ITV_URL . $provinceLink->href;
            $provinceUrls[] = $link;
            print_r("\nProvince found: " . $link);
        }

        return $provinceUrls;
    }
}
