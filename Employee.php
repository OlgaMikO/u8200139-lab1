<?php

namespace App;

use DateTime;
use Exception;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Translation\MessageSelector;

class Employee
{
    private int $id;
    private string $name;
    private float $salary;
    private DateTime $date;


    /**
     * @throws Exception
     */
    public function __construct(int $id, string $name, float $salary, DateTime $date)
    {
        $errors = $this->validation($id, $name, $salary, $date);
        if($errors != null){
            $error = "";
            foreach ($errors as $row) {
                $error = $error . $row . "<br>";
            }

            throw new Exception($error);
        }
        else{
            $this->id = $id;
            $this->name = $name;
            $this->salary = $salary;
            $this->date = $date;
        }
        
    }

    public function get_salary() : float
    {
        return $this->salary;
    }
    
    
    public function get_work_experience() : int
    {
        return date_diff(new DateTime(), $this->date)->y;
    }


    private function validation($id, $name, $salary, $date): array
    {
        $validator = Validation::createValidator();

        $constraint = new Assert\Collection([    
            'id' => new Assert\PositiveOrZero(),   	
            'name' => [
                new Assert\Length(['max' => 50]),
                new Assert\NotBlank(),
            ],
            'salary' => new Assert\Positive(),
            'date' => [
                new Assert\NotBlank(),
                new Assert\Type(['type' => 'DateTime'])
            ]
        ]);

        $form = [
            'id' => $id,
            'name' => $name,
            'salary' => $salary,
            'date' => $date
        ];
        $violations = $validator->validate($form, $constraint);

        $errors = [];
        if (0 !== count($violations)) {
            foreach ($violations as $violation) {
                $errors[] = $violation->getPropertyPath() . ' : ' . $violation->getMessage();
            }
        }
        return $errors;
    }

}
