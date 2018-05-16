<?php

namespace ListOf\EmployeesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Employees")
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

}
