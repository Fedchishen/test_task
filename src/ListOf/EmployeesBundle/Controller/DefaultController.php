<?php

namespace ListOf\EmployeesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use ListOf\EmployeesBundle\Entity\Employees;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ManagerRegistry;

class DefaultController extends Controller
{
    /**
     * @Route("/list")
     */
    public function indexAction()
    {

        return $this->render('@ListOfEmployees/Default/index.html.twig');
    }
    
    
    
    //Создание фейковой базы работников в колве 50тыс записей
        /**
     * @Route("/list/fakedb")
     */
    public function fakeDbAction()
    {
    
    $em = $this->get('doctrine')->getManager();


    
    for($i=0;$i<10;$i++){
        
        $employees = new Employees();
        
        $employees->setFirstName("Иван".$i);
        $employees->setMiddleName("Иванович".$i);
        $employees->setSurname("Иванов".$i);
        $employees->setPositionId(rand(0, 4));
        $employees->setDateOfEmployment(new \DateTime("now"));
        $employees->setWages(rand(30000, 60000));
              
        while(true){
            $k=rand(0, 49999);
            if($k!=$employees->getId()){$employees->setChiefId($k);break; }
        }
        
        $em->persist($employees);
        $em->flush();
    }
   
        
        echo "База создана";

        return $this->render('@ListOfEmployees/Default/index.html.twig');
    }
}
