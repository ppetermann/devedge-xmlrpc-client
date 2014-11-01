<?php
namespace Devedge\XmlRpc\Client;

use Devedge\XmlRpc\Server;
use PHPUnit_Framework_TestCase;

class XmlRpcBuilderTest extends PHPUnit_Framework_TestCase
{
    protected function setUp()
    {

    }

    public function testCreateRequest()
    {
        // we test with int, as if one works others work too.
        $this->assertEquals(
            "<?xml version=\"1.0\"?>\n<methodCall><methodName>test</methodName><params><param><value><int>1</int></value></param></params></methodCall>\n",
            XmlRpcBuilder::createRequest("test", [1])
        );
    }
}
