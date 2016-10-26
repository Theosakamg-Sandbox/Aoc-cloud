<?php
/**************************************************************************
 * User.php, AOC
 *
 * Mickael Gaillard Copyright 2016
 * Description :
 * Author(s) : Mickael Gaillard <mickael.gaillard@tactfactory.com>
 * Licence : All right reserved.
 * Last update : 8 August, 2016
 *
 **************************************************************************/
namespace Tact\AocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JSON;
use Doctrine\Common\Collections\ArrayCollection;
use Tact\DoryBundle\Entity\User as DoryUser;

/**
 * User
 *
 * @ORM\Table(name="sys_user")
 * @ORM\Entity(repositoryClass="Tact\AocBundle\Repository\UserRepository")
 * @ORM\HasLifecycleCallbacks()
 * @JSON\ExclusionPolicy("ALL")
 */
class User extends DoryUser
{
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * ToString.
     */
    public function __toString()
    {
        return $this->getDisplayFullName();
    }

    /**
     * Get the user full name.
     *
     * @return string
     */
    public function getDisplayFullName()
    {
        return sprintf('%s %s', $this->getFirstname(), $this->getLastname());
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->subscriptions = new ArrayCollection();
    }

    /**
     * Hook on pre-persist operations
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        parent::prePersist();
    }
}

