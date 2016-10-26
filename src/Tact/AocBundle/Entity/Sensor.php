<?php

namespace Tact\AocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sensor
 *
 * @ORM\Table(name="sensor")
 * @ORM\Entity(repositoryClass="Tact\AocBundle\Repository\SensorRepository")
 */
class Sensor
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
  protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="displayName", type="string", length=255, unique=true)
     */
    protected $displayName;

    /**
     * @var int
     *
     * @ORM\Column(name="vendor", type="integer")
     */
    protected $vendor;

    /**
     * @var int
     *
     * @ORM\Column(name="product", type="integer")
     */
    protected $product;

    /**
     * @var int
     *
     * @ORM\Column(name="version", type="integer")
     */
    protected $version;

    /**
     * @var bool
     *
     * @ORM\Column(name="enable", type="boolean")
     */
    protected $enable;




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
     * Set displayName
     *
     * @param string $displayName
     *
     * @return Sensor
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;

        return $this;
    }

    /**
     * Get displayName
     *
     * @return string
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * Set vendor
     *
     * @param int $vendor
     *
     * @return Sensor
     */
    public function setVendor($vendor)
    {
        $this->vendor = $vendor;

        return $this;
    }

    /**
     * Get vendor
     *
     * @return int
     */
    public function getVendor()
    {
        return $this->vendor;
    }

    /**
     * Set product
     *
     * @param int $product
     *
     * @return Sensor
     */
    public function setProduct($product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return int
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set version
     *
     * @param int $version
     *
     * @return Sensor
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return int
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set enable
     *
     * @param bool $enable
     *
     * @return Sensor
     */
    public function setEnable($enable)
    {
        $this->enable = $enable;

        return $this;
    }

    /**
     * Get enable
     *
     * @return bool
     */
    public function getEnable()
    {
        return $this->enable;
    }
}

