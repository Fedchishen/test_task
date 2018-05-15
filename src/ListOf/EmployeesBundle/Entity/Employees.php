<?php

namespace ListOf\EmployeesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Employees")
 */
class Employees
{
	/**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
	protected $id;
	
	/**
     * @ORM\Column(type="string", length=255)
     */
    protected $first_name;
    
    	/**
     * @ORM\Column(type="string", length=255)
     */
    protected $middle_name;
    
    	/**
     * @ORM\Column(type="string", length=255)
     */
    protected $surname;

	/**
     * @ORM\Column(type="integer")
     */
    protected $position_id;

	/**
     * @ORM\Column(type="date")
     */
    protected $date_of_employment;
    
    	/**
     * @ORM\Column(type="integer")
     */
    protected $wages;
    
        /**
     * @ORM\Column(type="integer")
     */
    protected $chief_id;
    
    
    

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
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Employees
     */
    public function setFirstName($firstName)
    {
        $this->first_name = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Set middleName
     *
     * @param string $middleName
     *
     * @return Employees
     */
    public function setMiddleName($middleName)
    {
        $this->middle_name = $middleName;

        return $this;
    }

    /**
     * Get middleName
     *
     * @return string
     */
    public function getMiddleName()
    {
        return $this->middle_name;
    }

    /**
     * Set surname
     *
     * @param string $surname
     *
     * @return Employees
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set positionId
     *
     * @param integer $positionId
     *
     * @return Employees
     */
    public function setPositionId($positionId)
    {
        $this->position_id = $positionId;

        return $this;
    }

    /**
     * Get positionId
     *
     * @return integer
     */
    public function getPositionId()
    {
        return $this->position_id;
    }

    /**
     * Set dateOfEmployment
     *
     * @param \DateTime $dateOfEmployment
     *
     * @return Employees
     */
    public function setDateOfEmployment($dateOfEmployment)
    {
        $this->date_of_employment = $dateOfEmployment;

        return $this;
    }

    /**
     * Get dateOfEmployment
     *
     * @return \DateTime
     */
    public function getDateOfEmployment()
    {
        return $this->date_of_employment;
    }

    /**
     * Set wages
     *
     * @param integer $wages
     *
     * @return Employees
     */
    public function setWages($wages)
    {
        $this->wages = $wages;

        return $this;
    }

    /**
     * Get wages
     *
     * @return integer
     */
    public function getWages()
    {
        return $this->wages;
    }

    /**
     * Set chiefId
     *
     * @param integer $chiefId
     *
     * @return Employees
     */
    public function setChiefId($chiefId)
    {
        $this->chief_id = $chiefId;

        return $this;
    }

    /**
     * Get chiefId
     *
     * @return integer
     */
    public function getChiefId()
    {
        return $this->chief_id;
    }
}
