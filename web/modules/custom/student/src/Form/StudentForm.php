<?php

namespace Drupal\student\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterFace;
use Drupal\node\Entity\Node;

/**
 * Class studentForm.
 */
class StudentForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getformId() {
    return 'create_student';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterFace $form_state) {

    $form['name'] = [
      '#type' => 'textfield',
      '#title' => t('Name'),
      '#default_value' => '',
    ];

    $form['lastname'] = [
      '#type' => 'textfield',
      '#title' => t('LastName'),
      '#default_value' => '',
    ];
    $form['save'] = [
      '#type' => 'submit',
      '#value' => 'save student',
      '#button_type' => 'primary',
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterFace $form_state) {

    $data = \Drupal::config('student.settings');
    $info = $data->get('published');


    $postData = $form_state->getValues();
    $node = Node::create([
      'type' => 'studentdata',
      'title' => $postData['name'],
      'field_name' => $postData['name'],
      'field_lastname' => $postData['lastname'],
    ]
      );
      if($info == 1){
        $node ->setPublished();
      }
      else{
        $node ->setUnpublished();
      }

    $node->save();
    \Drupal::messenger()->addMessage('data displayed on the node');

    // Echo "<pre>";
    // print_r($postData);
    // Echo "</pre>";
    // exit;.
  }

}
