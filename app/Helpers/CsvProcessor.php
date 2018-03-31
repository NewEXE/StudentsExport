<?php
/**
 * Created by PhpStorm.
 * User: newexe
 * Date: 30.03.18
 * Time: 23:27
 */

namespace App\Helpers;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\Routing\Exception\InvalidParameterException;

/**
 * Class CsvProcessor
 * @package App\Helpers
 */
class CsvProcessor
{
    /**
     * @var string CSV fields separator
     */
    const SEPARATOR = ',';

    /**
     * @var string Postfix for adding current date to output filename
     */
    const DATETIME_FORMAT = '-d-m-Y-H_i_s';

    /**
     * @param Collection|array $data
     * @param int $fillHeadingFrom
     * @param string $filename
     * @throws InvalidParameterException
     */
    function outputCsv($data, $fillHeadingFrom = 0, $filename = 'export')
    {
        if (!count($data)) throw new InvalidParameterException('Collection or array for export must be not empty');

        $this->_sendHeadersForCsvOutput($filename);

        /** @var string $csvHeading CSV heading row */
        $csvHeading = '';
        /** @var string $csvContent Main CSV content */
        $csvContent = '';

        if ($data instanceof Collection)
        {
            $modelForHeading = $data[$fillHeadingFrom];
            $csvHeading .= '"' . implode('"' . self::SEPARATOR . '"', array_keys($modelForHeading->getAttributes())) . '"';
            $csvHeading .= self::SEPARATOR;

            $relations = $modelForHeading->getRelations();
            foreach ($relations as $relation)
            {
                $csvHeading .= '"' . implode('"' . self::SEPARATOR . '"', array_keys($relation->getAttributes())) . '"';
                $csvHeading .= self::SEPARATOR;
            }

            $csvHeading .= "\r\n";

            foreach ($data as $model)
            {
                $csvContent .= '"' . implode('"' . self::SEPARATOR . '"', $model->getAttributes()) . '"';
                $csvContent .= self::SEPARATOR;

                $relations = $model->getRelations();
                foreach ($relations as $key => $relation)
                {
                    $csvContent .= $relation ?
                        '"' . implode('"' . self::SEPARATOR . '"', $relation->getAttributes()) . '"' : '""';

                    $csvContent .= self::SEPARATOR;
                }

                $csvContent .= "\r\n";
            }

            echo $csvHeading . $csvContent;

        }
        elseif (is_array($data))
        {
            $out = fopen('php://output', 'w');

            $itemForHeading = array_keys($data[$fillHeadingFrom]);

            fputcsv($out, $itemForHeading);

            foreach ($data as $item)
            {
                  fputcsv($out, $item);
            }

            fclose($out);
        }
    }

    /**
     * @param string $filename
     * @return void
     */
    private function _sendHeadersForCsvOutput($filename = 'export')
    {
        $filename .= date(self::DATETIME_FORMAT);
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename={$filename}.csv");
        header("Pragma: no-cache");
        header("Expires: 0");
    }
}