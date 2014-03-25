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

/**
 * @covers tubepress_impl_theme_ThemeBase
 */
class tubepress_test_impl_theme_ThemeBaseTest extends tubepress_test_TubePressUnitTest
{
    /**
     * @var tubepress_impl_theme_ThemeBase
     */
    private $_sut;

    public function onSetup()
    {
        $this->_sut = new tubepress_impl_theme_ThemeBase(
            'my/theme',
            '3.2.1',
            'my theme',
            array('name' => 'foo', 'url' => 'http://bar.com/hello'),
            array(array('type' => 'fooz', 'url' => 'http://foo.com/yoyo')),
            false,
            sys_get_temp_dir()
        );
    }

    public function testParentName()
    {
        $this->_sut->setParentThemeName('parent');

        $this->assertEquals('parent', $this->_sut->getParentThemeName());
    }

    public function testBadParentName()
    {
        $this->setExpectedException('InvalidArgumentException', 'Invalid parent theme name.');

        $this->_sut->setParentThemeName('(*@#(*&*&%');
    }

    public function testSetNonStringParentName()
    {
        $this->setExpectedException('InvalidArgumentException', 'Theme parent name must be a string');

        $this->_sut->setParentThemeName(new stdClass());
    }

    public function testSetNonCssStyles()
    {
        $this->setExpectedException('InvalidArgumentException', 'Theme styles must all end in .css');

        $this->_sut->setStyles(array('hello.js'));
    }

    public function testSetNonStringStyles()
    {
        $this->setExpectedException('InvalidArgumentException', 'Theme styles must all be strings.');

        $this->_sut->setStyles(array(new stdClass()));
    }

    public function testSetStyles()
    {
        $this->_sut->setStyles(array('/some/styles.css'));

        $this->assertEquals(array('/some/styles.css'), $this->_sut->getStyles());
    }

    public function testSetNonJsScripts()
    {
        $this->setExpectedException('InvalidArgumentException', 'Theme scripts must all end in .js');

        $this->_sut->setScripts(array('hello.css'));
    }

    public function testSetNonStringScripts()
    {
        $this->setExpectedException('InvalidArgumentException', 'Theme scripts must all be strings.');

        $this->_sut->setScripts(array(new stdClass()));
    }

    public function testSetScripts()
    {
        $this->_sut->setScripts(array('/some/script.js'));

        $this->assertEquals(array('/some/script.js'), $this->_sut->getScripts());
    }

    public function testBadRootPath()
    {
        $this->setExpectedException('InvalidArgumentException', '/bad/path is not a valid theme root');

        new tubepress_impl_theme_ThemeBase(
            'my/theme',
            '3.2.1',
            'my theme',
            array('name' => 'foo', 'url' => 'http://bar.com/hello'),
            array(array('type' => 'fooz', 'url' => 'http://foo.com/yoyo')),
            false,
            '/bad/path'
        );
    }

    public function testBasics()
    {
        $this->assertFalse($this->_sut->isSystemTheme());
        $this->assertEquals(rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR, $this->_sut->getRootFilesystemPath());
    }
}