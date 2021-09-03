<?php

/*
 * This file is part of the Dubas Custom Formulas - EspoCRM extension.
 *
 * DUBAS S.C. - contact@dubas.pro
 * Copyright (C) 2021 Arkadiy Asuratov, Emil Dubielecki
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

namespace Espo\Modules\DubasCustomFormulas\Core\Formula\Functions\StringGroup;

use Espo\Core\Exceptions\Error;

class DubasBase64DecodeType extends \Espo\Core\Formula\Functions\Base
{
    public function process(\StdClass $item)
    {
        if (
            !property_exists($item, 'value')
        ) {
            return true;
        }

        if (
            !is_array($item->value)
        ) {
            throw new Error('You have to provide parameter to DubasBase64Decode formula.');
        }
   
        return base64_decode($this->evaluate($item->value[0]));
    }
}
