<?php
namespace Devedge\XmlRpc\Client;

use Devedge\XmlRpc\Server;
use PHPUnit_Framework_TestCase;

class XmlRpcParserTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {

    }

    public function testParseFault()
    {
        $element = simplexml_load_string("<?xml version=\"1.0\"?>\n<fault>
              <value>
                 <struct>
                    <member>
                       <name>faultCode</name>
                       <value><int>4</int></value>
                       </member>
                    <member>
                       <name>faultString</name>
                       <value><string>Too many parameters.</string></value>
                       </member>
                    </struct>
                 </value>
              </fault>
        \n");
        $this->assertInstanceOf('\Devedge\XmlRpc\Client\RemoteException', XmlRpcParser::parseFault($element));
        $this->assertEquals(4, XmlRpcParser::parseFault($element)->getCode());
        $this->assertEquals("Too many parameters.", XmlRpcParser::parseFault($element)->getMessage());
    }
}
