<?php
/**
 * Copyright 2006 - 2013 TubePress LLC (http://tubepress.org)
 *
 * This file is part of TubePress (http://tubepress.org)
 *
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */
class tubepress_impl_player_DefaultAddonLoaderTest extends TubePressUnitTest
{
    /**
     * @var tubepress_impl_addon_DefaultAddonLoader
     */
    private $_sut;

    public function onSetup()
    {
        $this->_sut = new tubepress_impl_addon_DefaultAddonLoader();
    }

    public function testBootstrapClass()
    {
        $plugin = ehough_mockery_Mockery::mock(tubepress_spi_addon_Addon::_);

        $plugin->shouldReceive('getBootstrap')->once()->andReturn('ValidBootstrapper');

        $result = $this->_sut->load($plugin);

        $this->assertNull($result);
    }

    public function testBootstrapFileThrowsException()
    {
        $plugin = ehough_mockery_Mockery::mock(tubepress_spi_addon_Addon::_);

        $tempFile = tempnam(sys_get_temp_dir(), 'tubepress-testBootstrapThrowsException');
        $handle = fopen($tempFile, 'w');
        fwrite($handle, '<?php throw new Exception("Hi");');
        fclose($handle);

        $plugin->shouldReceive('getBootstrap')->once()->andReturn($tempFile);
        $plugin->shouldReceive('getName')->once()->andReturn('some plugin');

        $result = $this->_sut->load($plugin);

        $this->assertEquals('Hit exception when trying to load some plugin: Hi', $result);

        unlink($tempFile);
    }

    public function testBootstrapFile()
    {
        $plugin = ehough_mockery_Mockery::mock(tubepress_spi_addon_Addon::_);

        $tempFile = tempnam(sys_get_temp_dir(), 'tubepress-testLoadGoodPlugin');

        $plugin->shouldReceive('getBootstrap')->once()->andReturn($tempFile);

        $result = $this->_sut->load($plugin);

        $this->assertNull($result);
    }
}

class ValidBootstrapper
{
    public $bell;

    public function boot()
    {
        $this->bell = true;
    }
}