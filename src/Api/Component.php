<?php

/*
 * This file is part of Cachet SDK.
 *
 * (c) Alt Three Services Limited
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CachetHQ\SDK\Api;

use CachetHQ\SDK\Entity\Component as ComponentEntity;

/**
 * This is the component api class.
 *
 * @author James Brooks <james@alt-three.com>
 */
class Component extends AbstractApi
{
    /**
     * Get all components.
     *
     * @param int $perPage
     * @param int $page
     *
     * @return \CachetHQ\SDK\Entity\Component[]
     */
    public function getAll($perPage = 200, $page = 1)
    {
        $url = sprintf('%s/components?per_page=%d&page=%d', $this->endpoint, $perPage, $page);

        $components = json_decode($this->adapter->get($url));

        return array_map(function ($component) {
            return new ComponentEntity($component);
        }, $components->data);
    }
}
