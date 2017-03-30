<?php

include_once 'Scrapping.php';

/**
 * Class ScrappingITVSingle
 */
class ScrappingITVSingle extends Scrapping
{

    /**
     * ScrappingITVSingle constructor.
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
        $data = [];

        $dom = $this->getDom();
        $element = array(
            'entry' => $dom->find('h1.entry-title', 0)->plaintext,
            'province' => $dom->find('span.region', 0)->plaintext,
            'locality' => $dom->find('span.locality', 0)->plaintext,
            'address' => $dom->find('span.street-address', 0)->plaintext,
            'phone' => $dom->find('span.tel', 0)->plaintext,
        );

        print_r(json_encode($element));

        return $element;
    }
}
