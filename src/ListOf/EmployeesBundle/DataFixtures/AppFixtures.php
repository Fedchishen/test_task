<?php
//Генератор фейковой базы работников (Employees)
namespace ListOf\EmployeesBundle\DataFixtures;

use ListOf\EmployeesBundle\Entity\Employees;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;



class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i=0;$i<100;$i++){
        
            $employees = new Employees();
            
            //Массивы с именами и окончаниями фамилий 
            //для генерации "красивой" фейковой базы работников
            $fake_names=array("Иван","Петр","Сидор","Федор","Борис",
                              "Глеб","Антон","Роман","Александр","Михаил");
            $fake_end=array("ов","енко","овский","адзе","ян","штейн");
            
            //Генерируем работника со случайными фамилией, именем и отчеством
            $employees->setFirstName($fake_names[rand(0, count($fake_names) - 1)]);
            $employees->setMiddleName($fake_names[rand(0, count($fake_names) - 1)]."ович");
            $employees->setSurname($fake_names[rand(0, count($fake_names) - 1)].$fake_end[rand(0, count($fake_end) - 1)]);
                  
            //id должности из таблицы должностей
            $employees->setPositionId(rand(0, 4));
            $employees->setDateOfEmployment(new \DateTime("now"));//Дата
            $employees->setWages(rand(30000, 60000));//ЗП
              
            //генерируем начальника... Конечно получится, как на пляже:
            //первого просим посмотреть за тапочками,
            //второго за первым и т.д.
            //... Но будет интересно))
            while(true){
                $k=rand(1, 100);
                if($k!=$employees->getId()){$employees->setChiefId($k);break; }
            }
            
            $manager->persist($employees);//Результат этой рулетки запишем
            $manager->flush();//Закидываем работника в БД
            
            echo ($i+1)."\n";
        }
 
        echo "Done!";
    }
}