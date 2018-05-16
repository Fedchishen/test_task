<?php

namespace ListOf\EmployeesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class DefaultController extends Controller
{
    /**
     * @Route("/list")
     */
    public function indexAction()
    {

        $repository = $this->getDoctrine()->getRepository('ListOfEmployeesBundle:Employees');	
	$employees = $repository->findAll();	
        return $this->render('@ListOfEmployees/Default/index.html.twig', array(
            'employees' => $employees
        ));
    }
}
