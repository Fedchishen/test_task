<?php

namespace ListOf\EmployeesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use ListOf\EmployeesBundle\Controller\SortListController;

class DefaultController extends Controller {

    /**
     * @Route("/list")
     */
    public function indexAction() {
        return $this->render('@ListOfEmployees/Default/index.html.twig', array(
                    'employees' => $this->getDoctrine()->getRepository('ListOfEmployeesBundle:Employees')->findAll(), //Работники
                    'position' => $this->getPositions() //Должности
        ));
    }
    
//     /**
//     * @Route("/byid" name="byid")
//     */
//    public function byIdAction(Request $request){
//        $search = new SortListController();
//        return $search->searchSortAction($request);
//    }

    //получение массива с должностями, где $array[ранк_должности]=="Название должности"
    public function getPositions() {
        $positions = $this->getDoctrine()->getRepository('ListOfEmployeesBundle:Positions')
                ->findAll();
        $positions_new = array();
        for ($i = 0; $i < count($positions); $i++) {
            $positions_new[$positions[$i]->getPositionRank()] = $positions[$i]->getPositionName();
        }
        return $positions_new;
    }

}
