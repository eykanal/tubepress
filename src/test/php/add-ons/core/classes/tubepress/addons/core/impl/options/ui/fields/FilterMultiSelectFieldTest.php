<?php
/**
 * Copyright 2006 - 2013 TubePress LLC (http://tubepress.com)
 *
 * This file is part of TubePress (http://tubepress.com)
 *
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

/**
 * @covers tubepress_addons_core_impl_options_ui_fields_FilterMultiSelectField<extended>
 */
class tubepress_test_addons_core_impl_options_ui_fields_FilterMultiSelectFieldTest extends tubepress_test_impl_options_ui_fields_AbstractMultiSelectFieldTest
{
    /**
     * @var ehough_mockery_mockery_MockInterface
     */
    private $_mockOptionDescriptorReference;

    /**
     * @var tubepress_spi_options_ui_PluggableOptionsPageParticipantInterface[]
     */
    private $_mockOptionsPageParticipants;

    /**
     * @return tubepress_impl_options_ui_fields_AbstractOptionsPageField
     */
    protected function buildSut()
    {
        $sut = new tubepress_addons_core_impl_options_ui_fields_FilterMultiSelectField();

        $sut->setOptionsPageParticipants($this->_mockOptionsPageParticipants);

        return $sut;
    }

    public function testGetId()
    {
        $result = $this->getSut()->getId();

        $this->assertEquals('participant-filter-field', $result);
    }

    public function testIsProOnly()
    {
        $this->assertFalse($this->getSut()->isProOnly());
    }

    protected function doOnSetup()
    {
        $this->_mockOptionDescriptorReference = $this->createMockSingletonService(tubepress_spi_options_OptionDescriptorReference::_);

        $mockOd = new tubepress_spi_options_OptionDescriptor(tubepress_api_const_options_names_OptionsUi::DISABLED_OPTIONS_PAGE_PARTICIPANTS);
        $mockOd->setLabel('mock label');
        $mockOd->setDescription('mock desc');

        $this->_mockOptionDescriptorReference->shouldReceive('findOneByName')->once()->with(tubepress_api_const_options_names_OptionsUi::DISABLED_OPTIONS_PAGE_PARTICIPANTS)->andReturn($mockOd);

        $this->_mockOptionsPageParticipants = array();

        foreach (array('a', 'b', 'c', 'd') as $letter) {

            $participant = ehough_mockery_Mockery::mock('tubepress_spi_options_ui_PluggableOptionsPageParticipantInterface');
            $participant->shouldReceive('getId')->andReturn($letter);
            $participant->shouldReceive('getTranslatedDisplayName')->andReturn(strtoupper($letter));
            $this->_mockOptionsPageParticipants[] = $participant;
        }
    }

    protected function setupExpectationsForFailedStorageWhenAllMissing($errorMessage)
    {
        $this->getMockStorageManager()->shouldReceive('set')->once()->with(tubepress_api_const_options_names_OptionsUi::DISABLED_OPTIONS_PAGE_PARTICIPANTS, 'a;b;c;d')->andReturn($errorMessage);
    }

    protected function setupExpectationsForGoodStorageWhenAllMissing()
    {
        $this->getMockStorageManager()->shouldReceive('set')->once()->with(tubepress_api_const_options_names_OptionsUi::DISABLED_OPTIONS_PAGE_PARTICIPANTS, 'a;b;c;d')->andReturn(true);
    }

    /**
     * @return void
     */
    protected function doPrepareForGetWidgetHtml(ehough_mockery_mockery_MockInterface $mockTemplate)
    {
        $this->getMockStorageManager()->shouldReceive('get')->once()->with(tubepress_api_const_options_names_OptionsUi::DISABLED_OPTIONS_PAGE_PARTICIPANTS)->andReturn('a;b;c');

        $mockTemplate->shouldReceive('setVariable')->once()->with('currentlySelectedValues', array('d'));
        $mockTemplate->shouldReceive('setVariable')->once()->with('ungroupedChoices', array('a' => 'A', 'b' => 'B', 'c' => 'C', 'd' => 'D'));
        $mockTemplate->shouldReceive('setVariable')->once()->with('groupedChoices', array());
    }

    protected function getExpectedFieldId()
    {
        return 'participant-filter-field';
    }

    protected function getExpectedUntranslatedFieldLabel()
    {
        return 'mock label';
    }

    protected function getExpectedUntranslatedFieldDescription()
    {
        return 'mock desc';
    }
}

