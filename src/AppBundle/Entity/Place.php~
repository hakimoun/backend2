<?php

namespace AppBundle\Entity;

/**
 * Place
 */
class Place
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $creationDate;

    /**
     * @var \DateTime
     */
    private $modificationDate;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $googlePlaceJson;

    /**
     * @var string
     */
    private $lat;

    /**
     * @var string
     */
    private $lng;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $convergences;

    /**
     * @var \AppBundle\Entity\User
     */
    private $creator;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->creationDate = new \DateTime();
        $this->convergences = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     *
     * @return Place
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate
     *
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set modificationDate
     *
     * @param \DateTime $modificationDate
     *
     * @return Place
     */
    public function setModificationDate($modificationDate)
    {
        $this->modificationDate = $modificationDate;

        return $this;
    }

    /**
     * Get modificationDate
     *
     * @return \DateTime
     */
    public function getModificationDate()
    {
        return $this->modificationDate;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Place
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set googlePlaceJson
     *
     * @param string $googlePlaceJson
     *
     * @return Place
     */
    public function setGooglePlaceJson($googlePlaceJson)
    {
        $this->googlePlaceJson = $googlePlaceJson;

        return $this;
    }

    /**
     * Get googlePlaceJson
     *
     * @return string
     */
    public function getGooglePlaceJson()
    {
        return $this->googlePlaceJson;
    }

    /**
     * Set lat
     *
     * @param string $lat
     *
     * @return Place
     */
    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * Get lat
     *
     * @return string
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set lng
     *
     * @param string $lng
     *
     * @return Place
     */
    public function setLng($lng)
    {
        $this->lng = $lng;

        return $this;
    }

    /**
     * Get lng
     *
     * @return string
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * Add convergence
     *
     * @param \AppBundle\Entity\Convergence $convergence
     *
     * @return Place
     */
    public function addConvergence(\AppBundle\Entity\Convergence $convergence)
    {
        $this->convergences[] = $convergence;

        return $this;
    }

    /**
     * Remove convergence
     *
     * @param \AppBundle\Entity\Convergence $convergence
     */
    public function removeConvergence(\AppBundle\Entity\Convergence $convergence)
    {
        $this->convergences->removeElement($convergence);
    }

    /**
     * Get convergences
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getConvergences()
    {
        return $this->convergences;
    }

    /**
     * Set creator
     *
     * @param \AppBundle\Entity\User $creator
     *
     * @return Place
     */
    public function setCreator(\AppBundle\Entity\User $creator = null)
    {
        $this->creator = $creator;

        return $this;
    }

    /**
     * Get creator
     *
     * @return \AppBundle\Entity\User
     */
    public function getCreator()
    {
        return $this->creator;
    }
}
