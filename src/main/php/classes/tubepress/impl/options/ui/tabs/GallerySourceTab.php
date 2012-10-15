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
 * Displays the video source tab.
 */
class tubepress_impl_options_ui_tabs_GallerySourceTab extends tubepress_impl_options_ui_tabs_AbstractPluggableOptionsPageTab
{
    const TEMPLATE_VAR_CURRENT_MODE = 'tubepress_impl_options_ui_tabs_GallerySourceTab__mode';

    /**
     * Get the untranslated title of this tab.
     *
     * @return string The untranslated title of this tab.
     */
    protected final function getRawTitle()
    {
        return 'Which videos?';  //>(translatable)<
    }

    /**
     * Override point.
     *
     * Allows subclasses to perform additional modifications to the template.
     *
     * @param ehough_contemplate_api_Template $template The template for this tab.
     */
    protected final function addToTemplate(ehough_contemplate_api_Template $template)
    {
        $executionContext = tubepress_impl_patterns_ioc_KernelServiceLocator::getExecutionContext();

        $currentMode = $executionContext->get(tubepress_api_const_options_names_Output::GALLERY_SOURCE);

        $template->setVariable(self::TEMPLATE_VAR_CURRENT_MODE, $currentMode);
    }

    /**
     * Override point.
     *
     * Allows subclasses to change the template path.
     *
     * @param $originaltemplatePath string The original template path.
     *
     * @return string The (possibly) modified template path.
     */
    protected final function getModifiedTemplatePath($originaltemplatePath)
    {
        return 'src/main/resources/system-templates/options_page/gallery_source_tab.tpl.php';
    }

    public final function getName()
    {
        return 'gallery-source';
    }

    /**
     * Override point.
     *
     * @return array An array of fields that should always show up in this tab.
     */
    protected function getHardCodedFields()
    {
        $fieldBuilder = tubepress_impl_patterns_ioc_KernelServiceLocator::getOptionsUiFieldBuilder();

        return array(

            tubepress_api_const_options_names_Output::GALLERY_SOURCE =>
                $fieldBuilder->build(tubepress_api_const_options_names_Output::GALLERY_SOURCE,
                    tubepress_impl_options_ui_fields_TextField::FIELD_CLASS_NAME, $this->getName()),
        );
    }
}