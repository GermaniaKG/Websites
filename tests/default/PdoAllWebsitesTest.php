<?php
namespace tests;

use Germania\Websites\PdoAllWebsites;
use Prophecy\Argument;
use PHPUnit\Framework\TestCase;

class PdoAllWebsitesTest extends TestCase
{

    public function testFindingPage(  )
    {
        $index = 0;
        $search_term = 'bar';
        $website_mock = (object) [ 'foo' => $search_term, 'is_active' => '1' ];

        $result_array = [ $index => $website_mock ];

        $stmt_mock = $this->prophesize(\PDOStatement::class);
        $stmt_mock->setFetchMode( Argument::any(), Argument::any()  )->willReturn( null );
        $stmt_mock->execute()->willReturn( true );
        $stmt_mock->fetchAll( Argument::any() )->willReturn( $result_array );
        $stmt = $stmt_mock->reveal();

        $pdo_mock = $this->prophesize(\PDO::class);
        $pdo_mock->prepare( Argument::type('string') )->willReturn( $stmt );
        $pdo = $pdo_mock->reveal();

        $sut = new PdoAllWebsites( $pdo, "pages" );
        $w = $sut->get( $index );
        $this->assertEquals($w->foo, $search_term);

    }


}
