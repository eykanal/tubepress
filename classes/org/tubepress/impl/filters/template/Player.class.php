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

function_exists('tubepress_load_classes')
    || require dirname(__FILE__) . '/../../../../../tubepress_classloader.php';
tubepress_load_classes(array('org_tubepress_impl_ioc_IocContainer',
    'org_tubepress_api_const_options_Display',
    'org_tubepress_api_template_Template',
    'org_tubepress_api_const_FilterExecutionPoint',
    'org_tubepress_api_feed_FeedResult',
    'org_tubepress_api_video_Video',
    'org_tubepress_api_player_Player'));

/**
 * Handles applying the player HTML to the gallery template.
 */
class org_tubepress_impl_filters_template_Player
{
    public function filter($template, $feedResult, $galleryId)
    {
        $ioc        = org_tubepress_impl_ioc_IocContainer::getInstance();
        $tpom       = $ioc->get('org_tubepress_api_options_OptionsManager');
        $playerName = $tpom->get(org_tubepress_api_const_options_Display::CURRENT_PLAYER_NAME);
        $player     = $ioc->get('org_tubepress_api_player_Player');
        $videos     = $feedResult->getVideoArray();
        $playerHtml = $player->getHtml($videos[0], $galleryId);

        $template->setVariable(org_tubepress_api_const_Template::PLAYER_HTML, $playerHtml);
        $template->setVariable(org_tubepress_api_const_Template::PLAYER_NAME, $playerName);
        
        return $template;
    }
}

$ioc      = org_tubepress_impl_ioc_IocContainer::getInstance();
$fm       = $ioc->get('org_tubepress_api_patterns_FilterManager');
$instance = $ioc->get('org_tubepress_impl_filters_template_Player');

$fm->registerFilter(org_tubepress_api_const_FilterExecutionPoint::GALLERY_TEMPLATE, array($instance, 'filter'));
