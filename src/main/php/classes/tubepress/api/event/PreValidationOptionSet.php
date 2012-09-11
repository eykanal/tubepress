<?php
/**
 * Copyright 2006 - 2012 Eric D. Hough (http://ehough.com)
 *
 * This file is part of TubePress (http://tubepress.org)
 *
 * TubePress is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * TubePress is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with TubePress.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

/**
 * This event is fired when a TubePress option (a name-value pair) is being set. It is fired
 * *before* any validation takes place, so use caution when handling these values.
 */
class tubepress_api_event_PreValidationOptionSet extends ehough_tickertape_api_Event
{
    const EVENT_NAME = 'tubepress.api.event.PreValidationOptionSet';

    /**
     * @var string The name of the option.
     */
    public $optionName;

    /**
     * @var mixed The incoming option value.
     */
    public $optionValue;

    public function __construct($optionName, $candidateValue)
    {
        $this->optionName  = $optionName;
        $this->optionValue = $candidateValue;
    }

}
