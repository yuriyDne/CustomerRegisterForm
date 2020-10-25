<?php

namespace YT\CustomerRegisterForm\Service;

use GuzzleHttp\Client;
use GuzzleHttp\ClientFactory;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ResponseFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\Webapi\Rest\Request;
use Psr\Log\LoggerInterface;

class ImportCountryService
{
    const API_REQUEST_URI = 'https://restcountries.eu/';

    const COUNTRY_DATA_ENDPOINT = 'rest/v2/all';

    const BATCH_SIZE = 100;

    /**
     * @var \YT\CustomerRegisterForm\Model\ResourceModel\Country
     */
    protected $countryResourceModel;
    /**
     * @var LoggerInterface
     */
    protected $logger;
    /**
     * @var ClientFactory
     */
    protected $clientFactory;
    /**
     * @var ResponseFactory
     */
    protected $responseFactory;
    /**
     * @var Json
     */
    protected $jsonSerializer;

    /**
     * ImportCountryService constructor.
     *
     * @param \YT\CustomerRegisterForm\Model\ResourceModel\Country $countryResourceModel
     * @param ClientFactory $clientFactory
     * @param ResponseFactory $responseFactory
     * @param Json $jsonSerializer
     * @param LoggerInterface $logger
     */
    public function __construct(
        \YT\CustomerRegisterForm\Model\ResourceModel\Country $countryResourceModel,
        ClientFactory $clientFactory,
        ResponseFactory $responseFactory,
        Json $jsonSerializer,
        LoggerInterface $logger
    ) {
        $this->countryResourceModel = $countryResourceModel;
        $this->logger = $logger;
        $this->clientFactory = $clientFactory;
        $this->responseFactory = $responseFactory;
        $this->jsonSerializer = $jsonSerializer;
    }

    public function execute()
    {
        $countriesData = $this->getCountriesData();
        $convertedData = $this->convertData($countriesData);
        $this->logger->debug(count($convertedData) . ' Items Found');
        $this->logger->debug('Start insert data to database');
        $tableName = $this->countryResourceModel->getTable('yt_country');
        try {
            foreach (array_chunk($convertedData, self::BATCH_SIZE) as $insertData) {
                $this->countryResourceModel->getConnection()->insertMultiple($tableName, $insertData);
            }
        } catch (\Exception $e) {
            $this->logger->error('Insert to database Error: ' . $e->getMessage());
            throw new LocalizedException(__('Cannot import country options. See log files for more information'));
        }

        return true;
    }

    protected function convertData(array $countriesData)
    {
        $result = [];
        foreach ($countriesData as $item) {
            $alpha2Code = $item['alpha2Code'];
            $alpha3Code = $item['alpha3Code'];
            $name = $item['name'];
            $result[$alpha2Code] = [
                'iso2_code' => $alpha2Code,
                'iso3_code' => $alpha3Code,
                'name'      => $name
            ];
        }

        return $result;
    }

    /**
     * @return array
     * @throws LocalizedException
     */
    protected function getCountriesData()
    {
        $this->logger->debug('Start country Import');
        $this->logger->debug('Send Request to ' . static::API_REQUEST_URI . static::COUNTRY_DATA_ENDPOINT);
        $response = $this->doRequest(static::COUNTRY_DATA_ENDPOINT);
        $status = $response->getStatusCode();
        $responseBody = $response->getBody();
        $responseContent = $responseBody->getContents();
        if ($status == 200) {
            $this->logger->debug('Response: ' . $responseContent);
            return $this->jsonSerializer->unserialize($responseContent);
        }

        throw new LocalizedException('Cannot import country options. See log files for more information');
    }

    /**
     * Do API request with provided params
     *
     * @param string $uriEndpoint
     * @param array $params
     * @param string $requestMethod
     *
     * @return Response
     */
    protected function doRequest(
        string $uriEndpoint,
        array $params = [],
        string $requestMethod = Request::HTTP_METHOD_GET
    ): Response {
        /** @var Client $client */
        $client = $this->clientFactory->create(['config' => [
            'base_uri' => self::API_REQUEST_URI,
            'decode_content' => true,
            'connect_timeout' => 100,
            'read_timeout' => 100
        ]]);

        try {
            $response = $client->request(
                $requestMethod,
                $uriEndpoint,
                $params
            );
        } catch (GuzzleException $exception) {
            $this->logger->error('Send Request Error: ' . $exception->getMessage());
            /** @var Response $response */
            $response = $this->responseFactory->create([
                'status' => $exception->getCode(),
                'reason' => $exception->getMessage()
            ]);
        }

        return $response;
    }
}
