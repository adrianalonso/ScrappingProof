<?php

/**
 * Class Util
 */
class Util
{

    /**
     * @param $input_array
     * @param $output_file_name
     * @param string $delimiter
     */
    public static function convert_to_csv($input_array, $output_file_name, $delimiter = ';')
    {
        /* open raw memory as file, no need for temp files, be careful not to run out of memory thought */
        $f = fopen($output_file_name, 'w');
        fprintf($f, chr(0xEF) . chr(0xBB) . chr(0xBF));
        /* loop through array  */
        foreach ($input_array as $line) {
            /* default php csv handler **/
            fputcsv($f, $line, $delimiter);
        }

        fclose($f);
    }
}
