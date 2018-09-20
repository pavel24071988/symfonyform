<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 20.09.18
 * Time: 10:00
 */

namespace AppBundle\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class GuzzleService
{
    private $url;
    private $method;
    private $params;

    /**
     * GuzzleService constructor.
     * @param string $url
     * @param string $method
     * @param array $params
     */
    public function __construct(string $url, string $method = 'GET', array $params = [])
    {
        $this->url = $url;
        $this->method = $method;
        $this->params = $params;
    }

    /**
     * @return Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getGuzzleResponse(): Response
    {
        $client = new Client();
        $res = $client->request($this->method, $this->url, [$this->params]);
        return $res;
    }
}