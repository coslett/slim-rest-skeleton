<?php
namespace DomainHomes\Trait;
use Doctrine\ORM\Mapping as ORM;
/**
 * This trait allows us to easily include auto-updating createdAt and updatedAt
 * fields to any of our Doctrine Entities. To use, simply include the namespace:
 * GotChosen\ApiBundle\Entity\Behavior and then add a 'use Behavior\Timestampable;'
 * statement inside your class. You will also need to add @ORM\HasLifecycleCallbacks
 * to your class docblock for the Entity.
 */
trait Timestampable
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     *
     */
    protected $createdAt;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     *
     */
    protected $updatedAt;
    /**
     * Sets createdAt.
     *
     * @param  \DateTime $createdAt
     * @return $this
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }
    /**
     * Returns createdAt.
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    /**
     * Sets updatedAt.
     *
     * @param  \DateTime $updatedAt
     * @return $this
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
    /**
     * Returns updatedAt.
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    /**
     * Runs on Doctrine PrePersist event to set createdAt time.
     *
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->createdAt = new \DateTime('now');
        $this->updatedAt = new \DateTime('now');
    }
    /**
     * Runs on Doctrine PreUpdate event to set updatedAt time.
     *
     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        $this->updatedAt = new \DateTime('now');
    }
}