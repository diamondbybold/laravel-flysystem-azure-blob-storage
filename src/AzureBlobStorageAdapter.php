<?php


namespace DiamondByBOLD\FlysystemAzureBlobStorage;

use League\Flysystem\AzureBlobStorage\AzureBlobStorageAdapter as BaseAzureBlobStorageAdapter;
use MicrosoftAzure\Storage\Blob\BlobRestProxy;

final class AzureBlobStorageAdapter extends BaseAzureBlobStorageAdapter
{
    /**
     * The Azure Blob Client
     *
     * @var BlobRestProxy
     */
    private $client;

    /**
     * The container name
     *
     * @var string
     */
    private $container;

    /**
     * @var string
     */
    private $url;

    /**
     * AzureBlobStorageAdapter constructor.
     * @param BlobRestProxy $client
     * @param string $container
     * @param string|null $url
     * @param null $prefix
     * @throws \Exception
     */
    public function __construct(BlobRestProxy $client, string $container, string $url = null, $prefix = null)
    {
        parent::__construct($client, $container, $prefix);

        $this->client = $client;
        $this->container = $container;
        $this->setPathPrefix($prefix);

        if ($url && !filter_var($url, FILTER_VALIDATE_URL)) {
            throw new \Exception('Invalid Url');
        }
        $this->url = $url;
    }

    public function getUrl(string $path) : string{
        if ($this->url) {
            return rtrim($this->url, '/') . '/' . ($this->container === '$root' ? '' : $this->container . '/') . ltrim($path, '/');
        }

        return $this->client->getBlobUrl($this->container, $path);
    }
}
