<?php

include_once 'Scrapping.php';

class ScrappingProvincesSingle extends Scrapping
{
    public function __construct($url)
    {
        parent::__construct($url);
    }

    public function extract()
    {
        $singleUrls = [];

        $rows = $this->getDom()->find('table tr');
        foreach ($rows as $key => $row) {
            $thirdTd = $row->children[2];
            $link = ITV_URL.$thirdTd->find('a')[0]->href;
            print_r("\n Single ITV found: ".$link);
            $singleUrls[] = $link;
        }

        return $singleUrls;
    }
}
