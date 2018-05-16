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
        for($i=1;$i<500;$i++){
        
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
                  
            //генерируем должности
            //ради шутки сделаем так:
            // 1 - царь
            // 2 - боярин
            // 3 - городовой
            // 4 - староста
            // 5 - холоп
            $position_id=5;
            if($i==1){$position_id=1;}
            elseif ($i>1 && $i<=21) {$position_id=2;}
            elseif ($i>21 && $i<=61) {$position_id=3;}
            elseif ($i>61 && $i<=121) {$position_id=4;}
            //запишем должность
            $employees->setPositionId($position_id);
            
            $employees->setDateOfEmployment(new \DateTime("now"));//Дата
            
            //Генерируем ЗП соответственно должности
            $money = 100;
            switch ($position_id) {
                case 1:
                    $money=1000000;
                    break;
                case 2:
                    $money=100000;
                    break;
                case 3:
                    $money=10000;
                    break;
                case 4:
                    $money=1000;
                    break;
            }
            //запишем ЗП
            $employees->setWages($money);//ЗП
              
            //генерируем начальника
            if($position_id==1){$chief_id=1;}//царь сам себе начальник
            elseif ($position_id==2) {$chief_id=1;}//бояре подчиняются одному царю
            elseif ($position_id==3) {$chief_id=rand(2,21);}//городовые боярам
            elseif ($position_id==4) {$chief_id=rand(22,61);}//старосты городовым
            elseif ($position_id==5) {$chief_id=rand(62,121);}//холопы старостам
                   
            $employees->setChiefId($chief_id);//запишем начальника
            
            $manager->persist($employees);//Результат этой рулетки запишем
            $manager->flush();//Закидываем работника в БД
            
            echo ($i+1)."\n";
        }
 
        echo "Done!";
    }
}