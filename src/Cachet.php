<?php

/*
 * This file is part of Cachet SDK.
 *
 * (c) Alt Three Services Limited
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CachetHQ\SDK;

use CachetHQ\SDK\Adapter\AdapterInterface;

/**
 * This is the cachet class.
 *
 * @author James Brooks <james@alt-three.com>
 */
class Cachet
{
    /**
     * The adapter.
     *
     * @var \CachetHQ\SDK\Adapter\AdapterInterface
     */
    protected $adapter;

    /**
     * Create a new cachet instance.
     *
     * @param \CachetHQ\SDK\Adapter\AdapterInterface $adapter
     *
     * @return void
     */
    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }
}
