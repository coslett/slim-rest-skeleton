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
}