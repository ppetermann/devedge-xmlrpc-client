<?php
namespace Devedge\XmlRpc;

/**
 * Class MagicClient
 *
 * conveniance client that allows to call xml-rpc methods as
 * if this was a local object.
 *
 * @package Devedge\XmlRpc
 */
class MagicClient
{
    /**
     * @var Client
     */
    protected $xmlRpcClient;

    /**
     * @param string $url
     * @param string $namespace
     */
    public function __construct($url, $namespace = null)
    {
        $this->xmlRpcClient = new Client($url, $namespace);
    }

    /**
     * @param string $method
     * @param array $params
     * @throws \Exception
     */
    public function __call($method, $params)
    {
        return $this->xmlRpcClient->invokeRpcCall($method, $params);
    }
}