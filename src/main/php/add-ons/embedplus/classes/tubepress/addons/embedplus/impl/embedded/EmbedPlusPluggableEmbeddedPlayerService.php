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
 * Plays videos with EmbedPlus.
 */
class tubepress_addons_embedplus_impl_embedded_EmbedPlusPluggableEmbeddedPlayerService implements tubepress_spi_embedded_PluggableEmbeddedPlayerService
{
    /**
     * @return string The name of this embedded player. Never empty or null. All lowercase alphanumerics and dashes.
     */
    public final function getName()
    {
        return 'embedplus';
    }

    /**
     * @param tubepress_spi_theme_ThemeHandler $themeHandler The theme handler.
     *
     * @return ehough_contemplate_api_Template The template for this embedded player.
     */
    public final function getTemplate(tubepress_spi_theme_ThemeHandler $themeHandler)
    {
        return $themeHandler->getTemplateInstance('embedded/embedplus.tpl.php', TUBEPRESS_ROOT . '/src/main/php/add-ons/embedplus/resources/templates');
    }

    /**
     * @param string $videoId The video ID to play.
     *
     * @return ehough_curly_Url The URL of the data for this video.
     */
    public final function getDataUrlForVideo($videoId)
    {
        return new ehough_curly_Url(sprintf('http://www.youtube.com/embed/%s', $videoId));
    }

    /**
     * @return string The name of the video provider whose videos this player handles.
     */
    public final function getHandledProviderName()
    {
        return 'youtube';
    }

    /**
     * @return string The friendly name of this embedded player service.
     */
    public final function getFriendlyName()
    {
        return 'EmbedPlus';
    }
}
