<?php

error_reporting(E_ALL);
include_once 'lib/simple_html_dom.php';
include_once 'ScrappingProvinces.php';
include_once 'ScrappingProvincesSingle.php';
include_once 'ScrappingITVSingle.php';
include_once 'util.php';

const ITV_URL = 'http://itv.com.es/';

main();

/**
 *  initial function.
 */
function main()
{
    $outputFileName = 'output.csv';

    $scrappingProvinces = new ScrappingProvinces(ITV_URL);
    $urls = $scrappingProvinces->extract();

    $singleUrls = [];
    foreach ($urls as $key => $url) {
        $scrappingProvincesSingle = new ScrappingProvincesSingle($url);
        $singleUrls = array_merge($singleUrls, $scrappingProvincesSingle->extract());
    }

    $data = [];
    foreach ($singleUrls as $key => $url) {
        $scrappingITVSingle = new ScrappingITVSingle($url);
        $data[] = $scrappingITVSingle->extract();
    }

    $result = Util::convert_to_csv($data, $outputFileName);

    print_r('----FIN DE EJECUCIÓN-----');
}
