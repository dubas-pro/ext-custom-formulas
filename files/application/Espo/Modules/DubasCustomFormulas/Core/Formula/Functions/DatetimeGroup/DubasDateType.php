<?php

namespace Espo\Modules\DubasCustomFormulas\Core\Formula\Functions\DatetimeGroup;

use \Espo\Core\Exceptions\Error;

class DubasDateType extends \Espo\Core\Formula\Functions\Base
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
            count($item->value) < 2
        ) 
        {
             throw new Error("You have to provide 2 parameters to DubasDate formula");
        }

        $formulaDate    = $this->evaluate($item->value[0]);
        $formulaValue   = $this->evaluate($item->value[1]);

        $date = new \DateTime($formulaDate);
        $date->modify( $formulaValue ); 
        
        return $date->format('Y-m-d');
    }
} 
