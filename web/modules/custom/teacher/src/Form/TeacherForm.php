<?php

    namespace Drupal\teacher\Form;
    use Drupal\Core\Form\FormBase;
    use Drupal\Core\Form\FormStateInterface;
    use Drupal\node\Entity\Node;


    class TeacherForm extends FormBase{
        /**
         * {@inheritdoc}
         */

        public function getFormId()
        {
            return 'create_teacher';
        }
        /**
         * {@inheritdoc}
         */
        public function buildForm(array $form, FormStateInterface $form_state)
        {
            $form['name'] = array(
                '#type'=>'textfield',
                '#title'=>t('Name'),
                '#default value' =>''
                
            );
            $form['job'] = array(
                '#type'=> 'textfield',
                '#title'=> t('job'),
                '#default value'=>''
            );
            $form['save'] = array(
                '#type'=> 'submit',
                '#value'=>' save teachers',
                '#button_type'=> 'primary',
            );
            return $form;
        }
        /**
         * {@inheritdoc}
         */

         public function submitForm(array &$form, FormStateInterface $form_state)
         {
            $data = \Drupal::config('teacher.settings');
            $info1 = $data->get('contentone');
            $info2 = $data->get('contenttwo');
            $postData = $form_state->getValues();

            

            if($info2==1){
                $node2 = Node::create([
                    'type' => 'contenttypetwo',
                    'title' => $postData['job'],
                    'field_nametwo' => $postData['name'],
                    'field_jobtwo' => $postData['job'],
                  ]

                    );
                    $node2->save();

            }
            if($info1==1){
                $node1 = Node::create([
                    'type' => 'contenttypeone',
                    'title' => $postData['job'],
                    'field_fieldname' => $postData['name'],
                    'field_jobone' => $postData['job'],
                  ]

                    );
                    $node1->save();                                                                                                         

            }

            
                
                \Drupal::messenger()->addMessage('data displayed on the node');

                \Drupal::messenger()->addMessage('second one is also created');   
         }
    }

