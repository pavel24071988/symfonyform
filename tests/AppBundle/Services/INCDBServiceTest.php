<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 20.09.18
 * Time: 15:30
 */

namespace Tests\AppBundle\Services;

use AppBundle\Services\INCDBService;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Exception\GuzzleException;

class INCDBServiceTest extends TestCase
{
    /**
     * @covers \AppBundle\Services\INCDBService::getCategories
     *
     * @throws GuzzleException
     */
    public function testCategory(): void
    {
        $incdb = new INCDBService();
        $result = $incdb->getCategories();

        $this->assertNotEmpty($result);
        $this->assertInternalType('array', $result);
    }
}