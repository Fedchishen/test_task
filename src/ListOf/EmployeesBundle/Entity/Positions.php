<?php

namespace ListOf\EmployeesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Positions")
 */
class Positions
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
    protected $position_name;
    
    	/**
     * @ORM\Column(type="integer")
     */
    protected $position_rank;


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
     * Set positionName
     *
     * @param string $positionName
     *
     * @return Positions
     */
    public function setPositionName($positionName)
    {
        $this->position_name = $positionName;

        return $this;
    }

    /**
     * Get positionName
     *
     * @return string
     */
    public function getPositionName()
    {
        return $this->position_name;
    }

    /**
     * Set positionRank
     *
     * @param integer $positionRank
     *
     * @return Positions
     */
    public function setPositionRank($positionRank)
    {
        $this->position_rank = $positionRank;

        return $this;
    }

    /**
     * Get positionRank
     *
     * @return integer
     */
    public function getPositionRank()
    {
        return $this->position_rank;
    }
}
