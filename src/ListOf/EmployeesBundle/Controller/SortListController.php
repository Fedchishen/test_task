<?php

namespace ListOf\EmployeesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class SortListController extends Controller {

    /**
     * @Route("/search", name="search")
     */
    public function searchSortAction(Request $request) {

        if ($request->isXmlHttpRequest()) {
            //Получаю массив должностей $array[ранк_должности]=="Название должности"
            $positions = $this->getPositions();

            //Полученную инфу от Ajax функции раскидываю по переменным
            $name = $request->request->get('name');
            $like = $request->request->get('like');
            $order_by = $request->request->get('orderby');
            $index = $request->request->get('index');

            
            // Проверяю на null
            if (is_null($name) || is_null($like)) {
                $name_like = array();
            } else {
                $name_like = array($name => $like);
            }
            
            // Проверяю на null
            if (is_null($order_by) || is_null($index)) {
                $order_by_index = array();
            } else {
                $order_by_index = array($order_by => $index);
            }
            
            //Получаю работников
            $employees = $this->getDoctrine()->getRepository('ListOfEmployeesBundle:Employees')
                    ->findBy($name_like, $order_by_index);

            //Формирую json c работниками для ответа в ajax функцию 
            $jsonData = array();
            $idx = 0;
            foreach ($employees as $em) {
                $temp = array(
                    'id' => $em->getId(),
                    'surname' => $em->getSurname(),
                    'firstname' => $em->getFirstName(),
                    'middlename' => $em->getMiddleName(),
                    'positionid' => $positions[$em->getPositionId()],
                    'dateofemployment' => $em->getDateOfEmployment()->format('Y-m-d'),
                    'wages' => $em->getWages(),
                    'chiefid' => $em->getChiefId(),
                    'photo' => $em->getPhoto()
                );
                $jsonData[$idx++] = $temp;
            }
            return new JsonResponse($jsonData);
        } else {
            return $this->render('@ListOfEmployees/SortList/sortlist.html.twig');
        }
    }

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
