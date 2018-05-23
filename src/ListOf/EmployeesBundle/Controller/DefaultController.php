<?php

namespace ListOf\EmployeesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;







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
    
     /**
     * @Route("/newchief", name="newchief")
     */
    public function newchiefAction(Request $request) {
        if ($request->isXmlHttpRequest()) {
            $id = $request->request->get('id');
            $chief_id = $request->request->get('chief_id');
            
                $entityManager = $this->getDoctrine()->getManager();
                $em = $entityManager->getRepository('ListOfEmployeesBundle:Employees')->find($id);

                if (!$em) {
                    throw $this->createNotFoundException(
                        'No employees found for id '.$id
                    );
                }

                $em->setChiefId($chief_id);
                $entityManager->flush();
            
            return new Response('YES', Response::HTTP_OK);
        }
        else{return new Response('NO', Response::HTTP_OK);}

    }
//    
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
