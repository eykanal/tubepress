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
class_exists('tubepress_test_impl_addon_AbstractManifestValidityTest') ||
    require dirname(__FILE__) . '/../../classes/tubepress/test/impl/addon/AbstractManifestValidityTest.php';

class tubepress_test_addons_core_CoreManifestValidityTest extends tubepress_test_impl_addon_AbstractManifestValidityTest
{
    public function testManifest()
    {
        /**
         * @var $addon tubepress_spi_addon_Addon
         */
        $addon = $this->getAddonFromManifest(dirname(__FILE__) . '/../../../../main/php/add-ons/core/core.json');

        $this->assertEquals('tubepress-core-addon', $addon->getName());
        $this->assertEquals('1.0.0', $addon->getVersion());
        $this->assertEquals('TubePress Core', $addon->getTitle());
        $this->assertEquals(array('name' => 'TubePress LLC', 'url' => 'http://tubepress.com'), $addon->getAuthor());
        $this->assertEquals(array(array('type' => 'MPL-2.0', 'url' => 'http://www.mozilla.org/MPL/2.0/')), $addon->getLicenses());
        $this->assertEquals('TubePress core functionality', $addon->getDescription());
        $this->assertEquals(array('tubepress_addons_core' => TUBEPRESS_ROOT . '/src/main/php/add-ons/core/classes'), $addon->getPsr0ClassPathRoots());
        $this->assertEquals(array('tubepress_addons_core_impl_ioc_IocContainerExtension'), $addon->getIocContainerExtensions());
        $this->validateClassMap($this->_getExpectedClassMap(), $addon->getClassMap());
    }
    
    private function _getExpectedClassMap()
    {
        return array(

            'tubepress_addons_core_api_const_options_ui_OptionsPageParticipantConstants'        => 'classes/tubepress/addons/core/api/const/options/ui/OptionsPageParticipantConstants.php',
            'tubepress_addons_core_impl_http_PlayerPluggableAjaxCommandService'                 => 'classes/tubepress/addons/core/impl/http/PlayerPluggableAjaxCommandService.php',
            'tubepress_addons_core_impl_ioc_FilesystemCacheBuilder'                             => 'classes/tubepress/addons/core/impl/ioc/FilesystemCacheBuilder.php',
            'tubepress_addons_core_impl_ioc_IocContainerExtension'                              => 'classes/tubepress/addons/core/impl/ioc/IocContainerExtension.php',
            'tubepress_addons_core_impl_ioc_RegisterListenersCompilerPass'                      => 'classes/tubepress/addons/core/impl/ioc/RegisterListenersCompilerPass.php',
            'tubepress_addons_core_impl_ioc_RegisterTaggedServicesConsumerPass'                 => 'classes/tubepress/addons/core/impl/ioc/RegisterTaggedServicesConsumerPass.php',
            'tubepress_addons_core_impl_listeners_boot_OptionsStorageInitListener'              => 'classes/tubepress/addons/core/impl/listeners/boot/OptionsStorageInitListener.php',
            'tubepress_addons_core_impl_listeners_cssjs_BaseUrlSetter'                          => 'classes/tubepress/addons/core/impl/listeners/cssjs/BaseUrlSetter.php',
            'tubepress_addons_core_impl_listeners_cssjs_GalleryInitJsBaseParams'                => 'classes/tubepress/addons/core/impl/listeners/cssjs/GalleryInitJsBaseParams.php',
            'tubepress_addons_core_impl_listeners_html_JsConfig'                                => 'classes/tubepress/addons/core/impl/listeners/html/JsConfig.php',
            'tubepress_addons_core_impl_listeners_html_PreCssHtmlListener'                      => 'classes/tubepress/addons/core/impl/listeners/html/PreCssHtmlListener.php',
            'tubepress_addons_core_impl_listeners_html_ThumbGalleryBaseJs'                      => 'classes/tubepress/addons/core/impl/listeners/html/ThumbGalleryBaseJs.php',
            'tubepress_addons_core_impl_listeners_StringMagicFilter'                            => 'classes/tubepress/addons/core/impl/listeners/StringMagicFilter.php',
            'tubepress_addons_core_impl_listeners_template_EmbeddedCoreVariables'               => 'classes/tubepress/addons/core/impl/listeners/template/EmbeddedCoreVariables.php',
            'tubepress_addons_core_impl_listeners_template_PlayerLocationCoreVariables'         => 'classes/tubepress/addons/core/impl/listeners/template/PlayerLocationCoreVariables.php',
            'tubepress_addons_core_impl_listeners_template_SearchInputCoreVariables'            => 'classes/tubepress/addons/core/impl/listeners/template/SearchInputCoreVariables.php',
            'tubepress_addons_core_impl_listeners_template_SingleVideoCoreVariables'            => 'classes/tubepress/addons/core/impl/listeners/template/SingleVideoCoreVariables.php',
            'tubepress_addons_core_impl_listeners_template_SingleVideoMeta'                     => 'classes/tubepress/addons/core/impl/listeners/template/SingleVideoMeta.php',
            'tubepress_addons_core_impl_listeners_template_ThumbGalleryCoreVariables'           => 'classes/tubepress/addons/core/impl/listeners/template/ThumbGalleryCoreVariables.php',
            'tubepress_addons_core_impl_listeners_template_ThumbGalleryEmbeddedImplName'        => 'classes/tubepress/addons/core/impl/listeners/template/ThumbGalleryEmbeddedImplName.php',
            'tubepress_addons_core_impl_listeners_template_ThumbGalleryPagination'              => 'classes/tubepress/addons/core/impl/listeners/template/ThumbGalleryPagination.php',
            'tubepress_addons_core_impl_listeners_template_ThumbGalleryPlayerLocation'          => 'classes/tubepress/addons/core/impl/listeners/template/ThumbGalleryPlayerLocation.php',
            'tubepress_addons_core_impl_listeners_template_ThumbGalleryVideoMeta'               => 'classes/tubepress/addons/core/impl/listeners/template/ThumbGalleryVideoMeta.php',
            'tubepress_addons_core_impl_listeners_videogallerypage_PerPageSorter'               => 'classes/tubepress/addons/core/impl/listeners/videogallerypage/PerPageSorter.php',
            'tubepress_addons_core_impl_listeners_videogallerypage_ResultCountCapper'           => 'classes/tubepress/addons/core/impl/listeners/videogallerypage/ResultCountCapper.php',
            'tubepress_addons_core_impl_listeners_videogallerypage_VideoBlacklist'              => 'classes/tubepress/addons/core/impl/listeners/videogallerypage/VideoBlacklist.php',
            'tubepress_addons_core_impl_listeners_videogallerypage_VideoPrepender'              => 'classes/tubepress/addons/core/impl/listeners/videogallerypage/VideoPrepender.php',
            'tubepress_addons_core_impl_options_CoreOptionsProvider'                            => 'classes/tubepress/addons/core/impl/options/CoreOptionsProvider.php',
            'tubepress_addons_core_impl_options_ui_fields_GallerySourceField'                   => 'classes/tubepress/addons/core/impl/options/ui/fields/GallerySourceField.php',
            'tubepress_addons_core_impl_options_ui_fields_MetaMultiSelectField'                 => 'classes/tubepress/addons/core/impl/options/ui/fields/MetaMultiSelectField.php',
            'tubepress_addons_core_impl_options_ui_fields_ParticipantFilterField'               => 'classes/tubepress/addons/core/impl/options/ui/fields/ParticipantFilterField.php',
            'tubepress_addons_core_impl_options_ui_fields_ThemeField'                           => 'classes/tubepress/addons/core/impl/options/ui/fields/ThemeField.php',
            'tubepress_addons_core_impl_player_JqModalPluggablePlayerLocationService'           => 'classes/tubepress/addons/core/impl/player/JqModalPluggablePlayerLocationService.php',
            'tubepress_addons_core_impl_player_NormalPluggablePlayerLocationService'            => 'classes/tubepress/addons/core/impl/player/NormalPluggablePlayerLocationService.php',
            'tubepress_addons_core_impl_player_PopupPluggablePlayerLocationService'             => 'classes/tubepress/addons/core/impl/player/PopupPluggablePlayerLocationService.php',
            'tubepress_addons_core_impl_player_ShadowboxPluggablePlayerLocationService'         => 'classes/tubepress/addons/core/impl/player/ShadowboxPluggablePlayerLocationService.php',
            'tubepress_addons_core_impl_player_SoloPluggablePlayerLocationService'              => 'classes/tubepress/addons/core/impl/player/SoloPluggablePlayerLocationService.php',
            'tubepress_addons_core_impl_player_StaticPluggablePlayerLocationService'            => 'classes/tubepress/addons/core/impl/player/StaticPluggablePlayerLocationService.php',
            'tubepress_addons_core_impl_player_VimeoPluggablePlayerLocationService'             => 'classes/tubepress/addons/core/impl/player/VimeoPluggablePlayerLocationService.php',
            'tubepress_addons_core_impl_player_YouTubePluggablePlayerLocationService'           => 'classes/tubepress/addons/core/impl/player/YouTubePluggablePlayerLocationService.php',
            'tubepress_addons_core_impl_shortcode_SearchInputPluggableShortcodeHandlerService'  => 'classes/tubepress/addons/core/impl/shortcode/SearchInputPluggableShortcodeHandlerService.php',
            'tubepress_addons_core_impl_shortcode_SearchOutputPluggableShortcodeHandlerService' => 'classes/tubepress/addons/core/impl/shortcode/SearchOutputPluggableShortcodeHandlerService.php',
            'tubepress_addons_core_impl_shortcode_SingleVideoPluggableShortcodeHandlerService'  => 'classes/tubepress/addons/core/impl/shortcode/SingleVideoPluggableShortcodeHandlerService.php',
            'tubepress_addons_core_impl_shortcode_SoloPlayerPluggableShortcodeHandlerService'   => 'classes/tubepress/addons/core/impl/shortcode/SoloPlayerPluggableShortcodeHandlerService.php',
            'tubepress_addons_core_impl_shortcode_ThumbGalleryPluggableShortcodeHandlerService' => 'classes/tubepress/addons/core/impl/shortcode/ThumbGalleryPluggableShortcodeHandlerService.php'
        );
    }
}