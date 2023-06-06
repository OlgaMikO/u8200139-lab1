<?php

include 'vendor/autoload.php';

use App\Employee;
use App\Department;


 try{
     $emp1 = new Employee(-1, "John", 5.3, new DateTime());

 } catch (Exception $e) {
     echo $e->getMessage();
 }

try {
    $emp2 = new Employee(1, "ffgndf", -5, new DateTime());
} catch (Exception $e) {
    echo $e->getMessage();
}


try {
    $emp3 = new Employee(1, "Ольга", 5, new DateTime('2019-06-30'));
    echo $emp3 -> get_work_experience() . "<br/>";
} catch (Exception $e) {
    echo $e->getMessage();
}



$departments = array();

 for($j = 0; $j < 5; $j++){
     $employees = array();
     for ($i = 0; $i < 5; $i++){
         try {
             $employees[] = new Employee(1, "Ольга", rand(10000, 1000000) / rand(1, 10), new DateTime('2019-06-30'));
         } catch (Exception $e) {
             echo $e->getMessage();
         }
     }

     $departments[] = new Department($employees, "dep" . $j);
 }

function cmp_function(Department $a, Department $b) : bool
{
    if($a -> get_summary_salary() == $b -> get_summary_salary()){
        return count($a -> get_employees()) > count($b -> get_employees());
    }
    return $a -> get_summary_salary() > $b -> get_summary_salary();
}



 foreach ($departments as $dep)
 {
     echo $dep->get_name() . " : " . $dep->get_summary_salary() . "<br/>";
 }


 usort($departments, 'cmp_function');

foreach ($departments as $dep)
{
    echo $dep->get_name() . " : " . $dep->get_summary_salary() . "<br/>";
}



echo ($departments[0] -> get_name()). "<br/>";

echo ($departments[4] -> get_name()). "<br/>";

