<?php

namespace AppBundle\Entity;

/**
 * User
 */
class User
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
    private $firstname;

    /**
     * @var string
     */
    private $lastname;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $convergences;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $placess;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->creationDate = new \DateTime();
        $this->convergences = new \Doctrine\Common\Collections\ArrayCollection();
        $this->placess = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return User
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
     * @return User
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
     * Set firstname
     *
     * @param string $firstname
     *
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Add convergence
     *
     * @param \AppBundle\Entity\Convergence $convergence
     *
     * @return User
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
     * Add placess
     *
     * @param \AppBundle\Entity\Place $placess
     *
     * @return User
     */
    public function addPlacess(\AppBundle\Entity\Place $placess)
    {
        $this->placess[] = $placess;

        return $this;
    }

    /**
     * Remove placess
     *
     * @param \AppBundle\Entity\Place $placess
     */
    public function removePlacess(\AppBundle\Entity\Place $placess)
    {
        $this->placess->removeElement($placess);
    }

    /**
     * Get placess
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlacess()
    {
        return $this->placess;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $locations;


    /**
     * Add location
     *
     * @param \AppBundle\Entity\UserLocation $location
     *
     * @return User
     */
    public function addLocation(\AppBundle\Entity\UserLocation $location)
    {
        $this->locations[] = $location;

        return $this;
    }

    /**
     * Remove location
     *
     * @param \AppBundle\Entity\UserLocation $location
     */
    public function removeLocation(\AppBundle\Entity\UserLocation $location)
    {
        $this->locations->removeElement($location);
    }

    /**
     * Get locations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLocations()
    {
        return $this->locations;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $invitations;


    /**
     * Add invitation
     *
     * @param \AppBundle\Entity\Invitation $invitation
     *
     * @return User
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
    private $image;


    /**
     * Set image
     *
     * @param string $image
     *
     * @return User
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $createdInvitations;


    /**
     * Add createdInvitation
     *
     * @param \AppBundle\Entity\Invitation $createdInvitation
     *
     * @return User
     */
    public function addCreatedInvitation(\AppBundle\Entity\Invitation $createdInvitation)
    {
        $this->createdInvitations[] = $createdInvitation;

        return $this;
    }

    /**
     * Remove createdInvitation
     *
     * @param \AppBundle\Entity\Invitation $createdInvitation
     */
    public function removeCreatedInvitation(\AppBundle\Entity\Invitation $createdInvitation)
    {
        $this->createdInvitations->removeElement($createdInvitation);
    }

    /**
     * Get createdInvitations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCreatedInvitations()
    {
        return $this->createdInvitations;
    }
    /**
     * @var string
     */
    private $userToken;


    /**
     * Set userToken
     *
     * @param string $userToken
     *
     * @return User
     */
    public function setUserToken($userToken)
    {
        $this->userToken = $userToken;

        return $this;
    }

    /**
     * Get userToken
     *
     * @return string
     */
    public function getUserToken()
    {
        return $this->userToken;
    }
}
