<?php

namespace Espo\Modules\DubasCustomFormulas\Core\Formula\Functions\DatetimeGroup;

use \Espo\Core\Exceptions\Error;

class DubasDate extends \Espo\Core\Formula\Functions\Base
{
    public function process(\StdClass $item)
    {
        if 
        (
            !property_exists($item, 'value')
        ) 
        {
            return true;
        }

        if 
        (
            !is_array($item->value)
        ) 
        {
            throw new Error("You have to provide parameters to DubasDate formula.");
        }

        if 
        (
            count($item->value) < 3
        ) 
        {
             throw new Error("You have to provide 3 parameters to DubasDate formula");
        }

        $formulaDate    = $this->evaluate($item->value[0]);
        $formulaValue   = $this->evaluate($item->value[1]);
        $formulaPeriod  = $this->evaluate($item->value[2]);

        $date = new \DateTime($formulaDate);
        $date->modify( $formulaValue . ' ' . $formulaPeriod); 
        
        return $date->format('Y-m-d');
    }
} 
