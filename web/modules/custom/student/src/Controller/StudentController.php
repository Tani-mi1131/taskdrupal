<?php
    namespace Drupal\student\Controller;
    use Drupal\Core\Controller\ControllerBase;

    class StudentController extends ControllerBase{
        public function createstudent(){
            $form = \Drupal::formBuilder()->getForm('Drupal\student\Form\StudentForm');
            $renderForm = \Drupal::service('renderer')->render($form);

            return [
                '#type'=>'markup',
                '#markup'=>$renderForm,
                
            ];

        }
    }