<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 20.09.18
 * Time: 15:30
 */

namespace Tests\AppBundle\Services;

use AppBundle\Services\GuzzleService;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Exception\GuzzleException;

class GuzzleServiceTest extends TestCase
{
    private const category = [
        'method' => 'GET',
        'url' => 'http://api.icndb.com/categories',
        'params' => []
    ];

    private const joke = [
        'method' => 'GET',
        'url' => 'http://api.icndb.com/jokes/random',
        'params' => []
    ];

    /**
     * @covers \AppBundle\Services\GuzzleService::getGuzzleResponse
     *
     * @throws GuzzleException
     */
    public function testResponse(): void
    {
        $guzzle = new GuzzleService(self::category['url'], self::category['method'], self::category['params']);
        $categories = $guzzle->getGuzzleResponse();

        $this->assertNotEmpty($categories);
        $this->assertSame(200, $categories->getStatusCode());
        $this->assertSame('application/json', $categories->getHeader('content-type')[0]);
        $this->assertNotEmpty((string) $categories->getBody());

        $categories = json_decode($categories->getBody());

        $this->assertSame('success', $categories->type);

        foreach ($categories->value as $category) {
            $guzzle = new GuzzleService(self::joke['url'], self::joke['method'], ['limitTo' => [$category]]);
            $joke = $guzzle->getGuzzleResponse();

            $this->assertNotEmpty($joke);
            $this->assertSame(200, $joke->getStatusCode());
            $this->assertSame('application/json', $joke->getHeader('content-type')[0]);
            $this->assertNotEmpty((string) $joke->getBody());

            $joke = json_decode($joke->getBody());

            $this->assertSame('success', $joke->type);
            $this->assertInternalType('string', $joke->value->joke);
        }
    }
}