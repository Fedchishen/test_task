<?php

namespace ListOf\EmployeesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ListOf\EmployeesBundle\Entity;

class DefaultController extends Controller
{
    /**
     * @Route("/list")
     */
    public function indexAction()
    {

        $rep_employees = $this->getDoctrine()->getRepository('ListOfEmployeesBundle:Employees');	
	$employees = $rep_employees->findAll();	
        
        $rep_positions = $this->getDoctrine()->getRepository('ListOfEmployeesBundle:Positions');	
	$positions = $rep_positions->findAll();
        
        $positions_new = array();
        for ($i = 0; $i < count($positions); $i++)
        {
            $positions_new[$positions[$i]->getPositionRank()] = $positions[$i]->getPositionName();
        }
        
        return $this->render('@ListOfEmployees/Default/index.html.twig', array(
            'employees' => $employees,
            'position' => $positions_new
        ));
    }
}
