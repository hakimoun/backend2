<?php

namespace AppBundle\Entity;

/**
 * Convergence
 */
class Convergence
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;


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
     * Set name
     *
     * @param string $name
     *
     * @return Convergence
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
     * Set description
     *
     * @param string $description
     *
     * @return Convergence
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
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
    private $tags;

    /**
     * @var string
     */
    private $creatorCode;

    /**
     * @var \DateTime
     */
    private $when;

    /**
     * @var \AppBundle\Entity\Place
     */
    private $place;

    /**
     * @var \AppBundle\Entity\User
     */
    private $creator;


    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     *
     * @return Convergence
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
     * @return Convergence
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
     * Set tags
     *
     * @param string $tags
     *
     * @return Convergence
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get tags
     *
     * @return string
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set creatorCode
     *
     * @param string $creatorCode
     *
     * @return Convergence
     */
    public function setCreatorCode($creatorCode)
    {
        $this->creatorCode = $creatorCode;

        return $this;
    }

    /**
     * Get creatorCode
     *
     * @return string
     */
    public function getCreatorCode()
    {
        return $this->creatorCode;
    }

    /**
     * Set when
     *
     * @param \DateTime $when
     *
     * @return Convergence
     */
    public function setWhen($when)
    {
        $this->when = $when;

        return $this;
    }

    /**
     * Get when
     *
     * @return \DateTime
     */
    public function getWhen()
    {
        return $this->when;
    }

    /**
     * Set place
     *
     * @param \AppBundle\Entity\Place $place
     *
     * @return Convergence
     */
    public function setPlace(\AppBundle\Entity\Place $place = null)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get place
     *
     * @return \AppBundle\Entity\Place
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Set creator
     *
     * @param \AppBundle\Entity\User $creator
     *
     * @return Convergence
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
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $invitations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->creationDate = new \DateTime();
        $this->invitations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add invitation
     *
     * @param \AppBundle\Entity\Invitation $invitation
     *
     * @return Convergence
     */
    public function addInvitation(\AppBundle\Entity\Invitation $invitation)
    {
        $this->invitations[] = $invitation;

        return $this;
    }

    /**
     * Remove invitation
     *
     * @param \AppBundle\Entity\Invitation $invitation
     */
    public function removeInvitation(\AppBundle\Entity\Invitation $invitation)
    {
        $this->invitations->removeElement($invitation);
    }

    /**
     * Get invitations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInvitations()
    {
        return $this->invitations;
    }
    /**
     * @var string
     */
    private $creatorToken;


    /**
     * Set creatorToken
     *
     * @param string $creatorToken
     *
     * @return Convergence
     */
    public function setCreatorToken($creatorToken)
    {
        $this->creatorToken = $creatorToken;

        return $this;
    }

    /**
     * Get creatorToken
     *
     * @return string
     */
    public function getCreatorToken()
    {
        return $this->creatorToken;
    }
    /**
     * @var boolean
     */
    private $is_active;


    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Convergence
     */
    public function setIsActive($isActive)
    {
        $this->is_active = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->is_active;
    }
}
