<?php

namespace Drupal\student\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormState;
use Drupal\Core\Form\FormStateInterface;


class StudentConfigForm extends ConfigFormBase{

    /**
     * settings Variable.
     */

     Const CONFIGNAME = "student.settings";

    /**
     * {@inheritdoc}
     */

    public function getFormId(){
        return "student_config_form_settings";

    }
    /**
     * {@inheritdoc}
     */

    protected function getEditableConfigNames(){
        return [
            static::CONFIGNAME,
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state){
        $data = \Drupal::config('student.settings');
        $info = $data->get('published');

        $config = $this->config(static::CONFIGNAME);
        $form['published'] = array(
            '#type'=> 'checkbox',
            '#title'=> 'published',

        ); 
        $form['published']['#default_value'] = $info;
        return Parent::buildForm($form, $form_state);
    }
    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $config = $this->config(static::CONFIGNAME);
        $config->set("published", $form_state->getValue('published'));
        $config->save();
    }
    
}