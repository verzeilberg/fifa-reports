<?php

namespace Application\Traits;

/**
 * Time date Service
 */
trait timeDateService
{

    /*
 * @todo move this to service class
 */

    public function getStartAndEndDate($week, $year) {
        $dto = new \DateTime();
        $dto->setISODate($year, $week);
        $ret['start'] = $dto->format('Y-m-d');
        $dto->modify('+6 days');
        $ret['end'] = $dto->format('Y-m-d');
        return $ret;
    }

}
