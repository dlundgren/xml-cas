<?php

declare(strict_types=1);

namespace SimpleSAML\CAS\Test\XML\cas;

use DOMDocument;
use PHPUnit\Framework\TestCase;
use SimpleSAML\CAS\Constants as C;
use SimpleSAML\CAS\XML\cas\AuthenticationFailure;
use SimpleSAML\Test\XML\SerializableElementTestTrait;
use SimpleSAML\XML\DOMDocumentFactory;

use function dirname;
use function strval;

/**
 * Class \SimpleSAML\CAS\XML\cas\AuthenticationFailureTest
 *
 * @covers \SimpleSAML\CAS\XML\cas\AuthenticationFailure
 * @covers \SimpleSAML\CAS\XML\cas\AbstractResponse
 * @covers \SimpleSAML\CAS\XML\cas\AbstractCasElement
 *
 * @package simplesamlphp/cas
 */
final class AuthenticationFailureTest extends TestCase
{
    use SerializableElementTestTrait;

    /**
     */
    protected function setUp(): void
    {
        $this->testedClass = AuthenticationFailure::class;

        $this->xmlRepresentation = DOMDocumentFactory::fromFile(
            dirname(__FILE__, 3) . '/resources/xml/cas_authenticationFailure.xml',
        );
    }


    /**
     */
    public function testMarshalling(): void
    {
        $authenticationFailure = new AuthenticationFailure(
            'Ticket ST-1856339-aA5Yuvrxzpv8Tau1cYQ7 not recognized',
            C::ERR_INVALID_TICKET,
        );

        $this->assertEquals(
            $this->xmlRepresentation->saveXML($this->xmlRepresentation->documentElement),
            strval($authenticationFailure),
        );
    }


    /**
     */
    public function testUnmarshalling(): void
    {
        $authenticationFailure = AuthenticationFailure::fromXML($this->xmlRepresentation->documentElement);

        $this->assertEquals(
            $this->xmlRepresentation->saveXML($this->xmlRepresentation->documentElement),
            strval($authenticationFailure),
        );
    }
}
