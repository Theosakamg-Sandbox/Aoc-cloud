<?php
/**************************************************************************
 * Group.php, AOC
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

/**
 * @ORM\Entity(repositoryClass="Tact\AocBundle\Repository\GroupRepository")
 * @ORM\Table(name="sys_group")
 */
class Group extends \Tact\DoryBundle\Entity\Group
{
    /**
     * @ORM\Column(type="boolean", name="add_by_default")
     *
     * @var boolean
     */
    private $addByDefault = false;

    /**
     * Get the addByDefault.
     *
     * @return boolean
     */
    public function isAddByDefault()
    {
        return $this->addByDefault;
    }

    /**
     * Set the addByDefault.
     *
     * @param boolean $addByDefault
     *
     * @return class_container
     */
    public function setAddByDefault($addByDefault)
    {
        $this->addByDefault = $addByDefault;

        return $this;
    }
}
