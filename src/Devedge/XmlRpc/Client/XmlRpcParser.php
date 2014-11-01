<?php
namespace Devedge\XmlRpc\Client;

class XmlRpcParser extends \Devedge\XmlRpc\Common\XmlRpcParser
{
    /**
     * Convert an XMLRPC Fault in an Exception
     * @param \SimpleXMLElement $fault
     * @return \Exception
     */
    public static function parseFault(\SimpleXMLElement $fault)
    {
        $faultData = static::parseStruct($fault->value->struct);
        return new \Devedge\XmlRpc\Client\RemoteException($faultData['faultString'], $faultData['faultCode']);
    }
}