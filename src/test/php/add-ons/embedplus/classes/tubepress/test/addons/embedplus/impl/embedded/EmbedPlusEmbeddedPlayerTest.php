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
class tubepress_test_addons_embedplus_impl_embedded_EmbedPlusEmbeddedPlayerTest extends tubepress_test_TubePressUnitTest
{
    /**
     * @var tubepress_addons_embedplus_impl_embedded_EmbedPlusPluggableEmbeddedPlayerService
     */
    private $_sut;

    public function onSetup() {

        $this->_sut = new tubepress_addons_embedplus_impl_embedded_EmbedPlusPluggableEmbeddedPlayerService();
    }

    public function testGetName()
    {
        $this->assertEquals('embedplus', $this->_sut->getName());
    }

    public function testGetProviderName()
    {
        $this->assertEquals('youtube', $this->_sut->getHandledProviderName());
    }

    public function testGetTemplate()
    {
        $mockThemeHandler = $this->createMockSingletonService(tubepress_spi_theme_ThemeHandler::_);

        $mockThemeHandler->shouldReceive('getTemplateInstance')->once()->with(

            'embedded/embedplus.tpl.php',
            TUBEPRESS_ROOT . '/src/main/php/add-ons/embedplus/resources/templates'
        )->andReturn('abc');

        $result = $this->_sut->getTemplate($mockThemeHandler);

        $this->assertEquals('abc', $result);
    }

    public function testGetDataUrl()
    {
        $mockExecutionContext = $this->createMockSingletonService(tubepress_spi_context_ExecutionContext::_);

        $result = $this->_sut->getDataUrlForVideo('xx');

        $this->assertTrue($result instanceof ehough_curly_Url);
        $this->assertEquals('http://www.youtube.com/embed/xx', $result->toString());
    }

}

