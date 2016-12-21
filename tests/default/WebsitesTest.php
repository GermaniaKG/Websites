<?php
namespace tests;

use Germania\Websites\Websites;
use Germania\Websites\WebsiteNotFoundException;
use Interop\Container\Exception\NotFoundException;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Prophecy\Argument;


class WebsitesTest extends \PHPUnit_Framework_TestCase
{

    public $logger;


    public function setUp()
    {
        parent::setUp();
        $this->logger = new NullLogger;
    }


    public function testWebsiteNotFoundException(  )
    {
        $sut = new Websites;
        $this->expectException( WebsiteNotFoundException::class );
        $this->expectException( NotFoundException::class );

        $w = $sut->get( "foo ");
    }


}
