<?php
namespace tests;

use Germania\Websites\Websites;
use Germania\Websites\WebsiteNotFoundException;
use Psr\Container\NotFoundExceptionInterface;
use PHPUnit\Framework\TestCase;

class WebsitesTest extends TestCase
{

    public function testWebsiteNotFoundException(  )
    {
        $sut = new Websites;
        $this->expectException( WebsiteNotFoundException::class );
        $this->expectException( NotFoundExceptionInterface::class );

        $w = $sut->get( "foo ");
    }

    public function testContainerInterfaceGetMethod(  )
    {
        $sut = new Websites;
        $sut->websites['foo'] = "foo";

        $w = $sut->get( "foo" );
        $this->assertEquals( "foo", $w );
    }

    public function testContainerInterfaceHasMethod(  )
    {
        $sut = new Websites;
        $this->assertFalse( $sut->has('foo') );

        $sut->websites['foo'] = "foo";
        $this->assertTrue( $sut->has('foo') );
    }

    public function testIterator(  )
    {
        $sut = new Websites;
        $this->assertTrue( $sut instanceOf \Traversable );

        $iterator = $sut->getIterator();
        $this->assertTrue( $iterator instanceOf \Traversable );
    }

    public function testCountable(  )
    {
        $sut = new Websites;
        $this->assertInternalType( "int", count($sut) );
    }


}
