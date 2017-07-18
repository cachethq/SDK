<?php

/*
 * This file is part of Cachet SDK.
 *
 * (c) Alt Three Services Limited
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CachetHQ\SDK\Adapter;

/**
 * This is the adapter interface.
 * 
 * @author James Brooks <james@alt-three.com>
 */
interface AdapterInterface
{
    /**
     * Get a resource.
     *
     * @param string $endpoint
     * 
     * @throws \CachetHQ\SDK\Exception\HttpException
     *
     * @return mixed
     */
    public function get($endpoint);

    /**
     * Delete a resource.
     *
     * @param string $endpoint
     * 
     * @throws \CachetHQ\SDK\Exception\HttpException
     *
     * @return mixed
     */
    public function delete($endpoint);

    /**
     * Post a resource.
     *
     * @param string       $endpoint
     * @param array|string $content
     * 
     * @throws \CachetHQ\SDK\Exception\HttpException
     *
     * @return mixed
     */
    public function post($endpoint, $content = '');

    /**
     * Put a resource.
     *
     * @param string       $endpoint
     * @param array|string $content
     * 
     * @throws \CachetHQ\SDK\Exception\HttpException
     *
     * @return mixed
     */
    public function put($endpoint, $content = '');

    /**
     * Get the latest response headers.
     *
     * @return mixed
     */
    public function getLatestResponseHeaders();
}
