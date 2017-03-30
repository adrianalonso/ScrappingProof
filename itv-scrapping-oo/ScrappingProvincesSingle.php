<?php

include_once 'Scrapping.php';

/**
 * Class ScrappingProvincesSingle
 */
class ScrappingProvincesSingle extends Scrapping
{

    /**
     * ScrappingProvincesSingle constructor.
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
        $singleUrls = [];

        $rows = $this->getDom()->find('table tr');
        foreach ($rows as $key => $row) {
            $thirdTd = $row->children[2];
            $link = ITV_URL . $thirdTd->find('a')[0]->href;
            print_r("\n Single ITV found: " . $link);
            $singleUrls[] = $link;
        }

        return $singleUrls;
    }
}
