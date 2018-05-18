<?php

namespace ListOf\EmployeesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\Query\Expr;

class SortListController extends Controller {

    /**
     * @Route("/sort/{order_by}/{index}", name="sort")
     */
    public function sortAction($order_by = "id", $index = "ASC") {
        return $this->render('@ListOfEmployees/Default/sortlist.html.twig', array(
                    'employees' => $this->orderByList('ListOfEmployeesBundle:Employees', $order_by, $index), //Работники
                    'position' => $this->getPositions() //Должности
        ));
    }

    /**
     * @Route("/search", name="search")
     */
    public function searchAction(Request $request) {
            
        if ($request->isXmlHttpRequest()) {
            
            $name = $request->request->get('name');             
            $like = $request->request->get('like');  

            $positions = $this->getPositions();
            
            $employees = $this->SearchLikeList('ListOfEmployeesBundle:Employees', $name, $like);
                $jsonData = array();  
                $idx = 0;  
                foreach($employees as $em) {  
                    $temp = array(
                        'id' => $em->getId(),  
                        'surname' => $em->getSurname(),
                        'firstname' => $em->getFirstName(),
                        'middlename' => $em->getMiddleName(),
                        'positionid' => $positions[$em->getPositionId()],
                        'dateofemployment' => $em->getDateOfEmployment()->format('Y-m-d'),
                        'wages' => $em->getWages(),
                        'chiefid' => $em->getChiefId()
                    );   
                    $jsonData[$idx++] = $temp;  
                } 
            return new JsonResponse($jsonData); 
            
            //return $response;
            
        } else {
            return $this->render('@ListOfEmployees/Default/sortlist.html.twig', array(
                        'employees' => $this->SearchLikeList('ListOfEmployeesBundle:Employees', "chief_id", "4"), //Работники
                        'position' => $this->getPositions() //Должности
            ));
        }
    }

    public function SearchLikeList($rep, $name, $like) {
        return $this->getDoctrine()->getRepository($rep)
                        ->findBy(array($name => $like));
    }

    // получение информации из бд
    public function orderByList($rep, $order_by, $index) {
        if (empty($order_by)) {
            $order_by = "id";
        }
        if (empty($index)) {
            $index = "ASC";
        }

        return $this->getDoctrine()->getRepository($rep)
                        ->findBy(array(), array($order_by => $index));
    }

    //получение массива с должностями, где $array[ранк_должности]=="Название должности"
    public function getPositions() {
        $positions = $this->orderByList('ListOfEmployeesBundle:Positions', null, null);
        $positions_new = array();
        for ($i = 0; $i < count($positions); $i++) {
            $positions_new[$positions[$i]->getPositionRank()] = $positions[$i]->getPositionName();
        }
        return $positions_new;
    }

}
