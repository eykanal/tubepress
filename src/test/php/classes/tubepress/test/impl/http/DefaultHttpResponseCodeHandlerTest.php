<?php
/**
 * Copyright 2006 - 2014 TubePress LLC (http://tubepress.com)
 *
 * This file is part of TubePress (http://tubepress.com)
 *
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */
class tubepress_test_impl_http_DefaultHttpResponseCodeHandlerTest extends tubepress_test_TubePressUnitTest
{
    /**
     * @var tubepress_impl_http_DefaultResponseCodeHandler
     */
    private $_sut;

    public function onSetup()
    {
        $this->_sut = new tubepress_impl_http_DefaultResponseCodeHandler();

    }

    public function testGetHttpStatusCode()
    {
        $this->assertEquals(200, $this->_sut->__simulatedHttpResponseCode());
    }

    public function testSetHttpStatusCode()
    {
        $this->_sut->__simulatedHttpResponseCode(505);

        $this->assertEquals(505, $this->_sut->__simulatedHttpResponseCode());
    }
}