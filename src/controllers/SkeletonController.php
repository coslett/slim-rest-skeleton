<?php
namespace Skeleton\Controller;

/**
 * Requirements:
 *  - Include a resource, repository and entity
 *  - Update Namespace (also update in composer.json)
 */

use Skeleton\Resource\Resource;
use Skeleton\Repository\Repository;
use Skeleton\Entity\Entity;

use Doctrine\ORM\Mapping\ClassMetadata;
use Symfony\Component\HttpFoundation\Response;

class SkeletonController extends BaseController {

    public function __construct()
    {
        parent::__construct();
        $this->resource   = new BaseResource;
        $this->repository = new ModelRepository($this->resource->getEntityManager(), new ClassMetadata(new Model()));
    }

    /**
     * Routes are defined in web/index.php
     * @param  $unitCode
     * @return object
     */
    public function getSkeleton($id) 
    {
        $data = $this->getElement(["id" => $id]);

        return $this->response(
            $this->serializer->serialize($data, 'json'),
            Response::HTTP_OK
        );
    }
}