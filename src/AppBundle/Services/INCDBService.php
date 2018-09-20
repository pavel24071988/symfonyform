<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 20.09.18
 * Time: 10:07
 */

namespace AppBundle\Services;

class INCDBService
{
    private const DOMAIN = 'http://api.icndb.com/';
    private const CATEGORIES = 'categories';
    private const JOKE = 'jokes/random';

    /**
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCategories(): array
    {
        $guzzleService = new GuzzleService(self::DOMAIN . self::CATEGORIES, 'GET', []);
        $guzzleServiceResponse = $guzzleService->getGuzzleResponse();
        $categories = json_decode($guzzleServiceResponse->getBody());
        return $categories->value;
    }

    /**
     * @param array $category
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getJokeFromCategory(array $category): string
    {
        $guzzleService = new GuzzleService(self::DOMAIN . self::JOKE, 'GET', ['limitTo' => $category]);
        $guzzleServiceResponse = $guzzleService->getGuzzleResponse();
        $joke = json_decode($guzzleServiceResponse->getBody());
        return $joke->value->joke;
    }
}