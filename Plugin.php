<?php
/**
 * A modern CSS theme for Kanboard.
 * ============================================================================
 * Copyright © Stack Strategy Inc. All Rights Reserved.
 * Website: https://viggo.coding.me/blog/
 * ----------------------------------------------------------------------------
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * ============================================================================
 * Author: Viggo <leanclose@gmail.com>
 * Date: 2019-07-11
 */
namespace Kanboard\Plugin\Spectre;

use Kanboard\Core\Plugin\Base;

class Plugin extends Base
{
    public function initialize()
    {
        $this->hook->on('template:layout:css', ['template' => 'plugins/Spectre/skin.min.css']);
    }

    public function getPluginName()
    {
        return 'Spectre Theme';
    }

    public function getPluginDescription()
    {
        return t('A CSS-only theme for Kanboard');
    }

    public function getPluginAuthor()
    {
        return 'viggo <leanclose@gmail.com>';
    }

    public function getPluginVersion()
    {
        return '1.0.2';
    }

    public function getCompatibleVersion()
    {
        return '>=1.2.10';
    }

    public function getPluginHomepage()
    {
        return 'https://github.com/kuerme/kanboard-theme-spectre';
    }
}
