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

class INCDBServiceTest extends TestCase
{
    /**
     * @covers \AppBundle\Services\INCDBService::getCategories
     */
    public function testCategory()
    {
        $incdb = new INCDBService();
        $result = $incdb->getCategories();

        $this->assertNotEmpty($result);
        $this->assertInternalType('array', $result);
    }
}