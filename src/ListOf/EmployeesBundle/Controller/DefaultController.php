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

        return $this->render('@ListOfEmployees/Default/index.html.twig');
    }
}
