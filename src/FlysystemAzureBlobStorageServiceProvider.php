<?php

namespace DiamondByBOLD\FlysystemAzureBlobStorage;

use League\Flysystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use MicrosoftAzure\Storage\Blob\BlobRestProxy;

class FlysystemAzureBlobStorageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        Storage::extend('azure', function ($app, $config) {
            $connectionString = sprintf(
                'DefaultEndpointsProtocol=%s;AccountName=%s;AccountKey=%s;EndpointSuffix=%s',
                isset($config['protocol']) ? $config['protocol'] : 'https',
                $config['account']['name'],
                $config['account']['key'],
                $config['endpoint-suffix']
            );

            $client = BlobRestProxy::createBlobService($connectionString);

            return new Filesystem(new AzureBlobStorageAdapter($client, $config['container']));
        });
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/filesystems.php', 'filesystems');
    }
}
