<?php

namespace AppBundle\Entity;

/**
 * Invitation
 */
class Invitation
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
    private $token;

    /**
     * @var string
     */
    private $message;

    /**
     * @var string
     */
    private $publicDescription;

    /**
     * @var \AppBundle\Entity\User
     */
    private $user;

    /**
     * @var \AppBundle\Entity\Convergence
     */
    private $convergence;



    public function __construct()
    {
        $this->creationDate = new \DateTime();
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
     * @return Invitation
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
     * @return Invitation
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
     * Set token
     *
     * @param string $token
     *
     * @return Invitation
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return Invitation
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set publicDescription
     *
     * @param string $publicDescription
     *
     * @return Invitation
     */
    public function setPublicDescription($publicDescription)
    {
        $this->publicDescription = $publicDescription;

        return $this;
    }

    /**
     * Get publicDescription
     *
     * @return string
     */
    public function getPublicDescription()
    {
        return $this->publicDescription;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Invitation
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set convergence
     *
     * @param \AppBundle\Entity\Convergence $convergence
     *
     * @return Invitation
     */
    public function setConvergence(\AppBundle\Entity\Convergence $convergence = null)
    {
        $this->convergence = $convergence;

        return $this;
    }

    /**
     * Get convergence
     *
     * @return \AppBundle\Entity\Convergence
     */
    public function getConvergence()
    {
        return $this->convergence;
    }
    /**
     * @var \AppBundle\Entity\User
     */
    private $creator;


    /**
     * Set creator
     *
     * @param \AppBundle\Entity\User $creator
     *
     * @return Invitation
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
