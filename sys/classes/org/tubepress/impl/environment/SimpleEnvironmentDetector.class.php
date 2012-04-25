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

class_exists('org_tubepress_impl_classloader_ClassLoader') || require dirname(__FILE__) . '/../classloader/ClassLoader.class.php';
org_tubepress_impl_classloader_ClassLoader::loadClasses(array(
    'org_tubepress_api_environment_EnvironmentDetector'
));

/**
 * Detects TubePress's environment
 */
class org_tubepress_impl_environment_SimpleEnvironmentDetector implements org_tubepress_api_environment_EnvironmentDetector
{
    /**
     * Detects if the user is running TubePress Pro.
     *
     * @return boolean True is the user is running TubePress Pro. False otherwise.
     */
    public function isPro()
    {
        return is_readable(dirname(__FILE__) . '/../ioc/ProIocService.class.php');
    }

    /**
     * Detects if the user is running within WordPress
     *
     * @return boolean True is the user is running within WordPress. False otherwise.
     */
    public function isWordPress()
    {
        return strpos(realpath(__FILE__), 'wp-content' . DIRECTORY_SEPARATOR . 'plugins') !== false
            || function_exists('wp_cron');
    }

    /**
     * Find the absolute path of the user's content directory. In WordPress, this will be
     * wp-content/tubepress. In standalone PHP, this will be tubepress/content. Confusing, I know.
     *
     * @return string The absolute path of the user's content directory.
     */
    function getUserContentDirectory()
    {
        if ($this->isWordPress()) {

            return ABSPATH . 'wp-content/tubepress-content';

        } else {

            return $this->getTubePressBaseInstallationPath() . '/tubepress-content';
        }
    }

    /**
     * Attempt to get temporary directory.
     *
     * @return string The absolute path of a temporary directory, preferably the system directory.
     */
    public function getSystemTempDirectory()
    {
        if (function_exists('sys_get_temp_dir')) {

            return sys_get_temp_dir();
        }

        // Try to get from environment variable
        if (!empty($_ENV['TMP'])) {

            return realpath($_ENV['TMP']);

        } else if (!empty($_ENV['TMPDIR'])) {

            return realpath($_ENV['TMPDIR']);

        } else if (!empty($_ENV['TEMP'])) {

            return realpath($_ENV['TEMP']);

        } else {

            // Detect by creating a temporary file
            // Try to use system's temporary directory
            // as random name shouldn't exist
            $tempfile = @tempnam(md5(uniqid(rand(), true)), '');

            if ($tempfile) {

                $tempdir = realpath(dirname($tempfile));
                @unlink($tempfile);

                return $tempdir;

            } else {

                return false;
            }
        }
    }

    /**
     * Finds the absolute path of the TubePress installation on the filesystem.
     *
     * @return string The absolute filesystem path of this TubePress installation.
     */
    public function getTubePressBaseInstallationPath()
    {
        return realpath(dirname(__FILE__) . '/../../../../../../');
    }

    /**
     * Find the directory name of the TubePress base installation.
     *
     * @return string The base name of the TubePress installation directory.
     */
    function getTubePressInstallationDirectoryBaseName()
    {
        return basename($this->getTubePressBaseInstallationPath());
    }
}
