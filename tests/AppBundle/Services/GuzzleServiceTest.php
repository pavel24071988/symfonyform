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

class GuzzleServiceTest extends TestCase
{
    private $category = [
        'method' => 'GET',
        'url' => 'http://api.icndb.com/categories',
        'params' => []
    ];

    private $joke = [
        'method' => 'GET',
        'url' => 'http://api.icndb.com/jokes/random',
        'params' => [
            'limitTo' => [
                'nerdy',
                'explicit'
            ]
        ]
    ];

    /**
     * @covers \AppBundle\Services\GuzzleService::getGuzzleResponse
     */
    public function testResponce()
    {
        $guzzle = new GuzzleService($this->category['url'], $this->category['method'], $this->category['params']);
        $categories = $guzzle->getGuzzleResponse();

        $this->assertNotEmpty($categories);
        $this->assertSame(200, $categories->getStatusCode());
        $this->assertSame('application/json', $categories->getHeader('content-type')[0]);
        $this->assertNotEmpty((string) $categories->getBody());

        $categories = json_decode($categories->getBody());

        $this->assertSame('success', $categories->type);

        foreach ($categories->value as $category) {
            $guzzle = new GuzzleService($this->joke['url'], $this->joke['method'], ['limitTo' => [$category]]);
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