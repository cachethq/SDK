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

use CachetHQ\SDK\Adapter\AdapterInterface;

/**
 * This is the abstract api class.
 *
 * @author James Brooks <james@alt-three.com>
 */
abstract class AbstractApi
{
    /**
     * The adapter.
     *
     * @var \CachetHQ\SDK\Adapter\AdapterInterface
     */
    protected $adapter;

    /**
     * The Cachet endpoint.
     *
     * @var string
     */
    protected $endpoint;

    /**
     * Create a new abstract api instance.
     *
     * @param \CachetHQ\SDK\Adapter\AdapterInterface $adapter
     * @param string                                 $endpoint
     *
     * @return void
     */
    public function __construct(AdapterInterface $adapter, $endpoint)
    {
        $this->adapter = $adapter;
        $this->endpoint = $endpoint;
    }
}
