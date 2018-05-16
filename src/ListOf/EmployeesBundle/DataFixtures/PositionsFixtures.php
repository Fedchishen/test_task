<?php
//Генератор фейковой базы работников (Employees)
namespace ListOf\EmployeesBundle\DataFixtures;

use ListOf\EmployeesBundle\Entity\Positions;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;


//накидаем должностей
class PositionsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i=0;$i<5;$i++){
        
            $pos = new Positions();
            
            //Массив с должностями 
            $fake_positions = array("Царь", "Боярин", "Городовой", "Староста", "Холоп");
            
            $pos->setPositionName($fake_positions[$i]);
            $pos->setPositionRank($i+1);     
            
            //Закидываем в БД
            $manager->persist($pos);
            $manager->flush();
            
            echo ($i+1)."\n";
        }
 
        echo "Done!";
    }
}