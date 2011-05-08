<?php
/**
 * Copyright 2006 - 2011 Eric D. Hough (http://ehough.com)
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
 * Handles applying the embedded player's HTML to the template.
 */
class org_tubepress_impl_plugin_singlevideotemplate_EmbeddedSource
{
    public function alter_singleVideoTemplate(org_tubepress_api_template_Template $template, org_tubepress_api_video_Video $video)
    {
        $ioc            = org_tubepress_impl_ioc_IocContainer::getInstance();
        $tpom           = $ioc->get(org_tubepress_api_options_OptionsManager);
        $eps            = $ioc->get(org_tubepress_api_embedded_EmbeddedPlayer);
        $embeddedString = $eps->toString($video->getId());
        $width          = $tpom->get(org_tubepress_api_const_options_names_Embedded::EMBEDDED_WIDTH);

        /* apply it to the template */
        $template->setVariable(org_tubepress_api_const_template_Variable::EMBEDDED_SOURCE, $embeddedString);
        $template->setVariable(org_tubepress_api_const_template_Variable::EMBEDDED_WIDTH, $width);
       
        return $template;
    }
}