<?php
namespace Skeleton\Entity;

/**
 * Refer to Doctrine document for annotation support
 * http://doctrine-orm.readthedocs.org/en/latest/reference/annotations-reference.html
 */

use Doctrine\ORM\Mapping;

/**
 * @Entity(repositoryClass="Skeleton\Repository\SkeletonRepository")
 * @Table(name="skeleton")
 *
 */
class OperatingUnit
{
    /**
     * @var string
     * @Id
     * @Column(name="skeleton", type="string", length=64)
     */
    protected $skeleton;

    public function setSkeleton($skeleton)
    {
        $this->skeleton = $skeleton;

        return $this;
    }

    public function getSkeleton() 
    {
        return $this->skeleton;
    } 
}