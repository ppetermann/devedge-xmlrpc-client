<?php
namespace Devedge\XmlRpc;

use Devedge\Log\NoLog;
use Devedge\XmlRpc\Client\XmlRpcBuilder;
use Devedge\XmlRpc\Common\XmlRpcParser;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;

/**
 * Class Server
 */
class Client implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    /**
     * @var string Version string (to be updated by RMT, dont change manually)
     */
    public static $version = "0.0.0";

    /**
     * @var
     */
    protected $url;

    /**
     * @var
     */
    protected $namespace;

    public function __construct($url, $namespace = null)
    {

        $this->url = $url;
        $this->namespace = $namespace;
    }

    /**
     * @todo add fault / error handling
     * @todo add logging
     * @todo add cache
     * @param string $method
     * @param array $arguments
     * @return array
     */
    public function invokeRpcCall($method, $arguments)
    {
        if (!is_null($this->namespace)) {
            $method = $this->namespace . '.' . $method;
        }

        $body = XmlRpcBuilder::createRequest($method, $arguments);

        $guzzle = new \GuzzleHttp\Client();

        $response = $guzzle->post(
            $this->url,
            [
                'body' => $body,
                'headers' => [
                    'User-Agent' => 'Devedge\XmlRpc\Client/' .self::$version,
                    'Content-Type' => 'text/xml'
                ]
            ]
        );
        
        // responses always have only one param
        return array_shift(XmlRpcParser::parseParams($response->xml()->params));

    }


    protected function getLogger()
    {
        // if no logger is set on the first getLogger call we set a null Logger, so we can proceed without
        // errors.
        if (is_null($this->logger)) {
            $this->logger = new NoLog();
        }
        return $this->logger;
    }
}
