<?php

namespace ListOf\EmployeesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller {

    /**
     * @Route("/list")
     */
    public function indexAction() {
        return $this->render('@ListOfEmployees/Default/index.html.twig', array(
                    'employees' => $this->getList('ListOfEmployeesBundle:Employees', null, null), //Работники
                    'position' => $this->getPositions() //Должности
        ));
    }

    //ВАЖНО!!! функции getList() и getPositions() дублируются в SortListController.php
    //Надо решить вопрос с выносом этих функций в отдельный класс
    //
    // получение информации из бд
    public function getList($rep, $order_by, $index) {
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
        $positions = $this->getList('ListOfEmployeesBundle:Positions', null, null);
        $positions_new = array();
        for ($i = 0; $i < count($positions); $i++) {
            $positions_new[$positions[$i]->getPositionRank()] = $positions[$i]->getPositionName();
        }
        return $positions_new;
    }
}
