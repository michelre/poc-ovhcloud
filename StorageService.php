<?php

use OpenCloud\OpenStack;

class StorageService
{

    private $container;

    public function __construct()
    {
        try {
            $env = parse_ini_file(__DIR__ . '/env');

            $client = new OpenStack(
                'https://auth.cloud.ovh.net/v2.0',
                [
                    'username' => $env['ovh_user'],
                    'password' => $env['ovh_password'],
                    'tenantName' => $env['ovh_tenant']
                ]);

            $client->authenticate();
            $objectStoreService = $client->objectStoreService('swift', "SBG");
            $this->container = $objectStoreService->getContainer('courtisia');

        } catch (\Exception $e) {
            var_dump($e->getMessage());
        }
    }

    public function getFileNames()
    {
        $names = [];
        /** @var \OpenCloud\ObjectStore\Resource\DataObject $file */
        foreach ($this->container->objectList() as $file) {
            $names[] = $file->getName();
        }
        return $names;
    }

    public function getFileUrl($name)
    {
        $file = $this->container->getObject($name);
        return $file->getTemporaryUrl(3600, 'GET');
    }

    public function sendFile($file)
    {
        try {
            $fileData = fopen($file['tmp_name'], 'r+');
            $this->container->uploadObject(uniqid() . '_' . $file['name'], $fileData);
        } catch (\Exception $e){
            var_dump($e->getMessage());
        }
    }

    public function deleteFile($name){
        $this->container->getObject($name)->delete();
    }


}
