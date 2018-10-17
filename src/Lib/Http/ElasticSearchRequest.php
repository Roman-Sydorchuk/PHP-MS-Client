<?php
/**
 * Created by PhpStorm.
 * User: DmitriyVorobey
 * Date: 19.02.2018
 * Time: 11:12
 */

namespace SphereMall\MS\Lib\Http;

use Elasticsearch\ClientBuilder;
use SphereMall\MS\Lib\Helpers\HttpHelper;

/**
 * Class ElasticSearchRequest
 * @package SphereMall\MS\Lib\Http
 */
class ElasticSearchRequest extends Request
{
    /**
     * @param string $method
     * @param bool $body
     * @param bool $uriAppend
     * @param array $queryParams
     *
     * @return \GuzzleHttp\Promise\PromiseInterface|ElasticSearchResponse|Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    public function handle(string $method, $body = false, $uriAppend = false, array $queryParams = [])
    {
        $clientBuilder = new ClientBuilder();
        $url           = HttpHelper::setHttPortToUrl($this->client->getGatewayUrl(), false) . '/' . $this->resource->getVersion() . '/' . $this->resource->getURI();
        $client = $clientBuilder->setConnectionParams(['client' => ['headers' => $this->setAuthorization()]])
                                ->setHosts(['host' => $url])
                                ->build();

        try {

            $size = $queryParams['body']['size'] ?? 0;
            $from = $queryParams['body']['from'] ?? 0;

            $response = new ElasticSearchResponse($this->multi ? $client->msearch($queryParams) : $client->search($queryParams), $this->multi, $size, $from);
        } catch (\Exception $ex) {
            $error = json_decode($ex->getMessage());
            throw new \Exception($error->error->reason ?? $ex->getMessage());
        }

        return $response;
    }
}
