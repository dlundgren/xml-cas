<?php

declare(strict_types=1);

namespace SimpleSAML\CAS\XML\cas;

use DOMElement;
use SimpleSAML\Assert\Assert;
use SimpleSAML\XML\Exception\InvalidDOMElementException;
use SimpleSAML\XML\XMLStringElementTrait;

/**
 * Class for CAS proxyFailure
 *
 * @package simplesamlphp/cas
 */
class ProxyFailure extends AbstractCasElement
{
    use XMLStringElementTrait;

    /** @var string */
    public const LOCALNAME = 'proxyFailure';


    /**
     * The code for this failure
     *
     * @var string
     */
    protected string $code;


    /**
     * Create a new instance of ProxyFailure
     *
     * @param string $content
     * @param string $code
     */
    public function __construct(string $content, string $code)
    {
        $this->setContent($content);
        $this->setCode($code);
    }

    /**
     * Collect the value of the code-property
     *
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }


    /**
     * Set the value of the code-property
     *
     * @param string $code
     * @throws \SimpleSAML\Assert\AssertionFailedException
     */
    protected function setCode(string $code): void
    {
        Assert::notEmpty($code, 'The code in ProxyFailure must not be a empty.');
        $this->code = $code;
    }


    /**
     * Validate the content of the element.
     *
     * @param string $content  The value to go in the XML textContent
     * @throws \Exception on failure
     * @return void
     */
    protected function validateContent(string $content): void
    {
        Assert::notWhitespaceOnly($content);
    }


    /**
     * Initialize an ProxyFailure element.
     *
     * @param \DOMElement $xml The XML element we should load.
     * @return self
     *
     * @throws \SimpleSAML\XML\Exception\InvalidDOMElementException if the qualified name of the supplied element is wrong
     * @throws \SimpleSAML\XML\Exception\MissingAttributeException if the supplied element is missing any of the mandatory attributes
     */
    public static function fromXML(DOMElement $xml): object
    {
        Assert::same($xml->localName, 'proxyFailure', InvalidDOMElementException::class);
        Assert::same($xml->namespaceURI, ProxyFailure::NS, InvalidDOMElementException::class);

        $code = self::getAttribute($xml, 'code');

        return new self(trim($xml->textContent), $code);
    }


    /**
     * Convert this ProxyFailure to XML.
     *
     * @param \DOMElement|null $parent The element we should append to.
     * @return \DOMElement This ProxyFailure-element.
     */
    public function toXML(DOMElement $parent = null): DOMElement
    {
        $e = $this->instantiateParentElement($parent);
        $e->textContent = $this->content;
        $e->setAttribute('code', $this->code);

        return $e;
    }
}
