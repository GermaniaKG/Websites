<?php
namespace tests;

use Germania\Websites\Website;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Prophecy\Argument;
use Prophecy\PhpUnit\ProphecyTrait;
use PHPUnit\Framework\TestCase;

class WebsiteTest extends TestCase
{
    use ProphecyTrait;

    public $logger;


    public function setUp() : void
    {
        parent::setUp();
        $this->logger = new NullLogger;
    }


    public function testFluidInterface(  )
    {
        $sut = new Website();

        $this->assertEquals( "foo", $sut->setId("foo")->getId() );
        $this->assertEquals( "foo", $sut->setTitle("foo")->getTitle() );
        $this->assertEquals( "foo", $sut->setRoute("foo")->getRoute() );
        $this->assertEquals( "foo", $sut->setRouteName("foo")->getRouteName() );
        $this->assertEquals( "foo", $sut->setContentFile("foo")->getContentFile() );
        $this->assertEquals( "foo", $sut->setController("foo")->getController() );
        $this->assertEquals( "foo", $sut->setTemplate("foo")->getTemplate() );
        $this->assertEquals( "foo", $sut->setDomId("foo")->getDomId() );

        $this->assertIsArray($sut->getJavascripts());
        $this->assertIsArray($sut->getStylesheets());

        $this->assertEquals( array("foo"), $sut->setJavascripts(array("foo"))->getJavascripts() );
        $this->assertEquals( array("foo"), $sut->setStylesheets(array("foo"))->getStylesheets() );
    }


    /**
     * @dataProvider provideActiveStates
     */
    public function testActiveState( $status, $expected_result )
    {
        $sut = new Website();

        $this->assertEquals( $expected_result, $sut->isActive( $status )->isActive() );
    }


    public function provideActiveStates()
    {
        return array(
            [ 1,  true],
            [ 0,  false],
            [ -1, false]
        );
    }

}
