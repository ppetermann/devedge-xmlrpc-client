<?php
namespace Devedge\XmlRpc\Client;

class XmlRpcBuilder extends \Devedge\XmlRpc\Common\XmlRpcBuilder
{

    /**
     * @param string $method
     * @param array $args
     * @return string
     * @throws \Exception
     */
    public static function createRequest($method, $args)
    {
        $request = new \SimpleXMLElement("<methodCall></methodCall>");
        $request->addChild("methodName", $method);

        $params = $request->addChild("params");
        foreach ($args as $argument) {
            $param = $params->addChild("param");
            $data = static::typeByGuess($argument);
            $param->addChild($data->getName());
            $param->{$data->getName()} = $data;
        }

        return $request->asXML();
    }
}
