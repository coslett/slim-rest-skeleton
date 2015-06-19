<?php
namespace Skeleton\Resource;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Configuration;

class BaseResource
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager = null;

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        if ($this->entityManager === null) {
            $this->entityManager = $this->createEntityManager();
        }

        return $this->entityManager;
    }

    /**
     * @return EntityManager
     */
    public function createEntityManager()
    {     
        if (APPLICATION_MODE == "development") {
            $cache = new \Doctrine\Common\Cache\ArrayCache;
        } else {
            $cache = new \Doctrine\Common\Cache\ApcCache;
        }        

        $config = new Configuration;
        $config->setMetadataCacheImpl($cache);
        $driverImpl = $config->newDefaultAnnotationDriver('entities');
        $config->setMetadataDriverImpl($driverImpl);
        $config->setQueryCacheImpl($cache);
        $config->setProxyDir(PROXY_FILE_LOCATION);
        $config->setProxyNamespace('Skeleton\Proxies');

        return EntityManager::create(DATABASE_SETTINGS, $config);
    }

    public function repository()
    {
        return $this->getEntityManager()->getRepository($this->entity);
    }

    public function getEntity()
    {
        return $this->entity;
    }

    /*
        Takes in an object (entity) and uses the allowedFields variable in that entity
        to determine 1. if the entity contains a getter for it, and if so sets it to an
        array for encoding later on.
    */
    public function convertToArray($object) {
        
        $allowedFields = $object->allowedFields;

        foreach ($object->allowedFields as $field) {
            $method = "get" . $field;

            if ($object->$method()) {
                $array[$field] = $object->$method();
            }
        }

        return $array;
    }    
}