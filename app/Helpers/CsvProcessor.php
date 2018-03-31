<?php
/**
 * Created by PhpStorm.
 * User: newexe
 * Date: 30.03.18
 * Time: 23:27
 */

namespace App\Helpers;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class CsvProcessor
 * @package App\Helpers
 */
class CsvProcessor
{
    /**
     * @var string CSV fields separator
     */
    const SEPARATOR = ';';

    /**
     * @param Collection $data
     * @param int $fillHeadingFrom
     */
    function outputCsv(Collection $data, $fillHeadingFrom = 0)
    {
        /** @var string $csvHeading CSV heading row */
        $csvHeading = '';
        /** @var string $csvContent Main CSV content */
        $csvContent = '';

        $modelForHeading = $data[$fillHeadingFrom];
        $csvHeading .= implode(self::SEPARATOR, array_keys($modelForHeading->getAttributes()));
        $relations = $modelForHeading->getRelations();

        foreach ($relations as $relation)
        {
            $csvHeading .= implode(self::SEPARATOR, array_keys($relation->getAttributes()));
            $csvHeading .= self::SEPARATOR;
        }

        $csvHeading .= "\n";

        foreach ($data as $model)
        {
            $csvContent .= implode(self::SEPARATOR, $model->getAttributes());

            $relations = $model->getRelations();
            foreach ($relations as $relation)
            {
                $csvContent .= implode(self::SEPARATOR, $relation->getAttributes());
                $csvHeading .= self::SEPARATOR;
            }

            $csvContent .= "\n";
        }

        $this->_sendHeadersForCsvOutput();

        echo $csvHeading . $csvContent;
    }

    /**
     * @return void
     */
    private function _sendHeadersForCsvOutput()
    {
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=export.csv");
        header("Pragma: no-cache");
        header("Expires: 0");
    }
}