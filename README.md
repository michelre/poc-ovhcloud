# Documentation

## Démo
http://poc-storage.remimichel.fr/

## Récupération des informations de connexion

* Se connecter sur l'interface OVH avec les identifiants
* Accéder à la partie "Public Cloud": https://www.ovh.com/manager/public-cloud/
* Aller sur "Users & Roles" 
![https://imgur.com/pPsvstx.png](https://imgur.com/pPsvstx.png)
* Créer un utilisateur (et bien conserver le mot de passe)
* Accéder à l'interface "Horizon" et se connecter avec les identifiants de l'utilisateur nouvellement créé
![https://imgur.com/gNWb4QA.png](https://imgur.com/gNWb4QA.png)
* Sélectionner le bon projet et la bonne région (ici SGB). Vous devez retrouver le conteneur créé précédemment
![https://imgur.com/lxSBLH9.png](https://imgur.com/lxSBLH9.png)
* Pour se connecter via une API, il faut récupérer la valeur 'tenantName'. Pour cela, il convient de télécharger le fichier d'identité associé. Pour cela aller sur Project > API Access, puis cliquer sur Download OpenStack RC file puis sélectionner la deuxième entrée (v2.0)
![https://imgur.com/QcwJpFa.png](https://imgur.com/QcwJpFa.png)
* Ce fichier contient notamment les informations de connexion suivantes:
```
#!/usr/bin/env bash
export OS_TENANT_ID=dc7b8047be834ac1801832d4bd3f2b61
export OS_TENANT_NAME="8188658192898647"
export OS_USERNAME="6H7GSpsZpTJx"
```

## Se connecter au container via PHP

* Télécharger le client PHP: `composer require rackspace/php-opencloud`
* Utiliser les identifiants précédemment créés pour se connecter au container

```
<?php
require '/var/www/vendor/autoload.php';
use OpenCloud\OpenStack;
$client = new OpenStack("https://auth.cloud.ovh.net/v2.0", array(
'username' => "",
'password' => "",
'tenantName' => "",
));
$objectStoreService = $client->objectStoreService('swift', "SGB");
$cont = $objectStoreService->getContainer("courtisia");
...
?>
```

## Préconisations & limitations
* Les fichiers générés ne possèdent pas d'URL d'accès unique. Il convient donc de générer des URLs temporaires et donc d'implémenter la génération de ces URLs
* Les fichiers ne sont pas stockés avec des identifiants. C'est le nom qui fait foi. Ainsi il faut prévoir la génération de noms uniques

## Documentation 
* **Wrapper PHP**: https://github.com/php-opencloud/openstack
* Partie SDK: https://docs.ovh.com/fr/public-cloud/gestion-des-tokens/
