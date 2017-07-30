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

use CachetHQ\SDK\Exception\HttpException;
use Guzzle\Http\Exception\RequestException;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;

/**
 * This is the guzzle http adapter class.
 *
 * @author James Brooks <james@alt-three.com>
 */
class GuzzleHttpAdapter implements AdapterInterface
{
    /**
     * The guzzle http client instance.
     *
     * @var \GuzzleHttp\ClientInterface
     */
    protected $client;

    /**
     * The response object.
     *
     * @var \GuzzleHttp\Psr7\Response|\GuzzleHttp\Message\ResponseInterface
     */
    protected $response;

    /**
     * Create a new guzzle http adapter instance.
     *
     * @param string                           $token
     * @param \GuzzleHttp\ClientInterface|null $client
     *
     * @return void
     */
    public function __construct($token, ClientInterface $client = null)
    {
        if (version_compare(ClientInterface::VERSION, '6') === 1) {
            $this->client = $client ?: new Client(['headers' => ['X-Cachet-Token' => $token]]);
        } else {
            $this->client = $client ?: new Client();
            $this->client->setDefaultOption('headers/X-Cachet-Token', $token);
        }
    }

    /**
     * Get a resource.
     *
     * @param string $endpoint
     *
     * @throws \CachetHQ\SDK\Exception\HttpException
     *
     * @return mixed
     */
    public function get($endpoint)
    {
        try {
            $this->response = $this->client->get($endpoint);
        } catch (RequestException $e) {
            $this->response = $e->getResponse();
            $this->handleError();
        }

        return $this->response->getBody();
    }

    /**
     * Delete a resource.
     *
     * @param string $endpoint
     *
     * @throws \CachetHQ\SDK\Exception\HttpException
     *
     * @return mixed
     */
    public function delete($endpoint)
    {
        try {
            $this->response = $this->client->delete($endpoint);
        } catch (RequestException $e) {
            $this->response = $e->getResponse();
            $this->handleError();
        }

        return $this->response->getBody();
    }

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
    public function post($endpoint, $content = '')
    {
        $options = [];
        $options[is_array($content) ? 'json' : 'body'] = $content;

        try {
            $this->response = $this->client->post($endpoint, $options);
        } catch (RequestException $e) {
            $this->response = $e->getResponse();
            $this->handleError();
        }

        return $this->response->getBody();
    }

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
    public function put($endpoint, $content = '')
    {
        $options = [];
        $options[is_array($content) ? 'json' : 'body'] = $content;

        try {
            $this->response = $this->client->put($endpoint, $options);
        } catch (RequestException $e) {
            $this->response = $e->getResponse();
            $this->handleError();
        }

        return $this->response->getBody();
    }

    /**
     * Get the latest response headers.
     *
     * @return mixed
     */
    public function getLatestResponseHeaders()
    {
        if (null === $this->response) {
            return;
        }
    }

    /**
     * Handle any error responses.
     *
     * @throws \CachetHQ\SDK\Exception\HttpException
     *
     * @return void
     */
    protected function handleError()
    {
        $detail = null;
        $body = (string) $this->response->getBody();
        $code = (int) $this->response->getStatusCode();

        $content = json_decode($body);

        if (isset($content->errors) && is_array($content->errors)) {
            $error = $content->errors[0];
            $detail = $error->detail;
        } else {
            $error = $content;
            $detail = $error->message;
        }

        throw new HttpException($detail ? $detail : 'Request not processed.', $code);
    }
}
