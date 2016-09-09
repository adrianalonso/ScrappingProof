<?php

error_reporting(E_ALL);
include_once 'lib/simple_html_dom.php';
include_once 'util.php';

const ITV_URL = 'http://itv.com.es/';

main();

/**
 *  initial function.
 */
function main()
{
    $outputFileName = 'output.csv';
    $html = file_get_html(ITV_URL);

    $provinceLinks = findProvincesUrls($html);

    $singleLinks = scrapProvinceUrls($provinceLinks);
    $data = getItvs($singleLinks);

    $result = Util::convert_to_csv($data, $outputFileName);

    print_r('----FIN DE EJECUCIÓN-----');
}

/**
 * This function scrap dom content for extract
 * provinces urls on main page.
 *
 * @param simple_html_dom $dom
 *
 * @return array provinceUrs
 */
function findProvincesUrls(\simple_html_dom $dom)
{
    $provinceUrls = [];

    $elements = $dom->find('#tituloDesplegable li a');
    foreach ($elements as $key => $provinceLink) {
        $link = ITV_URL.$provinceLink->href;
        $provinceUrls[] = $link;
        print_r("\nProvince found: ".$link);
    }

    return $provinceUrls;
}

/**
 *  find provinces on initial dom.
 */
function scrapProvinceUrls(array $provinceUrls)
{
    $singleUrls = [];

    foreach ($provinceUrls as $key => $url) {
        $dom = file_get_html($url);
        $rows = $dom->find('table tr');
        foreach ($rows as $key => $row) {
            $thirdTd = $row->children[2];
            $link = ITV_URL.$thirdTd->find('a')[0]->href;
            print_r("\n Single ITV found: ".$link);
            $singleUrls[] = $link;
        }
    }

    return $singleUrls;
}

/**
 *  find provinces on initial dom.
 */
function getItvs(array $singleUrls)
{
    $data = [];

    foreach ($singleUrls as $key => $url) {
        $dom = file_get_html($url);
        $province = $dom->find('span.region', 0)->plaintext;

        $element = array(
        'entry' => $dom->find('h1.entry-title', 0)->plaintext,
        'province' => $dom->find('span.region', 0)->plaintext,
        'locality' => $dom->find('span.locality', 0)->plaintext,
        'address' => $dom->find('span.street-address', 0)->plaintext,
        'phone' => $dom->find('span.tel', 0)->plaintext,
      );

        print_r("\n  ITV data found: ".json_encode($element));
        $data[] = $element;
    }

    return $data;
}
