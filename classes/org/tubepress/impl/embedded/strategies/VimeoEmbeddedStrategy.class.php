<?php
/**
 * Copyright 2006 - 2010 Eric D. Hough (http://ehough.com)
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

function_exists('tubepress_load_classes')
    || require dirname(__FILE__) . '/../../../../../tubepress_classloader.php';
tubepress_load_classes(array('org_tubepress_impl_embedded_strategies_AbstractEmbeddedStrategy',
    'org_tubepress_api_ioc_IocService',
    'org_tubepress_api_options_OptionsManager',
    'org_tubepress_impl_embedded_EmbeddedPlayerUtils',
    'org_tubepress_api_const_options_Embedded',
    'org_tubepress_api_provider_Provider',
    'net_php_pear_Net_URL2'));

/**
 * Embedded player strategy for native Vimeo
 */
class org_tubepress_impl_embedded_strategies_VimeoEmbeddedStrategy extends org_tubepress_impl_embedded_strategies_AbstractEmbeddedStrategy
{
    const VIMEO_EMBEDDED_PLAYER_URL = 'http://player.vimeo.com/';
    const VIMEO_QUERYPARAM_AUTOPLAY = 'autoplay';
    const VIMEO_QUERYPARAM_TITLE    = 'title';
    const VIMEO_QUERYPARAM_BYLINE   = 'byline';
    const VIMEO_QUERYPARAM_COLOR    = 'color';
    const VIMEO_QUERYPARAM_LOOP     = 'loop';
    const VIMEO_QUERYPARAM_PORTRAIT = 'portrait';

    protected function _canHandle($providerName, $videoId, org_tubepress_api_ioc_IocService $ioc, org_tubepress_api_options_OptionsManager $tpom)
    {
        return $providerName === org_tubepress_api_provider_Provider::VIMEO;
    }

    protected function _getTemplatePath($providerName, $videoId, org_tubepress_api_ioc_IocService $ioc, org_tubepress_api_options_OptionsManager $tpom)
    {
        return 'embedded_flash/vimeo.tpl.php';
    }

    protected function _getEmbeddedDataUrl($providerName, $videoId, org_tubepress_api_ioc_IocService $ioc, org_tubepress_api_options_OptionsManager $tpom)
    {
        $autoPlay = $tpom->get(org_tubepress_api_const_options_Embedded::AUTOPLAY);
        $color    = $tpom->get(org_tubepress_api_const_options_Embedded::PLAYER_COLOR);
        $showInfo = $tpom->get(org_tubepress_api_const_options_Embedded::SHOW_INFO);
        $loop     = $tpom->get(org_tubepress_api_const_options_Embedded::LOOP);

        /* build the data URL based on these options */
        $link = new net_php_pear_Net_URL2(self::VIMEO_EMBEDDED_PLAYER_URL . "video/$videoId");
        $link->setQueryVariable(self::VIMEO_QUERYPARAM_AUTOPLAY, org_tubepress_impl_embedded_EmbeddedPlayerUtils::booleanToOneOrZero($autoPlay));
        $link->setQueryVariable(self::VIMEO_QUERYPARAM_COLOR, $color);
        $link->setQueryVariable(self::VIMEO_QUERYPARAM_LOOP, org_tubepress_impl_embedded_EmbeddedPlayerUtils::booleanToOneOrZero($loop));
        $link->setQueryVariable(self::VIMEO_QUERYPARAM_TITLE, org_tubepress_impl_embedded_EmbeddedPlayerUtils::booleanToOneOrZero($showInfo));
        $link->setQueryVariable(self::VIMEO_QUERYPARAM_BYLINE, org_tubepress_impl_embedded_EmbeddedPlayerUtils::booleanToOneOrZero($showInfo));
        $link->setQueryVariable(self::VIMEO_QUERYPARAM_PORTRAIT, org_tubepress_impl_embedded_EmbeddedPlayerUtils::booleanToOneOrZero($showInfo));

        return $link->getURL(true);
    }
}
