<?php

namespace Drupal\teacher\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormState;
use Drupal\Core\Form\FormStateInterface;


class TeacherConfigForm extends ConfigFormBase{

    /**
     * settings Variable.
     */

     Const CONFIGNAME = "teacher.settings";

    /**
     * {@inheritdoc}
     */

    public function getFormId(){
        return "teacher_config_form_settings";

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
        $data = \Drupal::config('teacher.settings');
        $info1 = $data->get('contentone');
        $info2 = $data->get('contenttwo');


        $config = $this->config(static::CONFIGNAME);
        $form['contentone'] = array(
            '#type'=> 'checkbox',
            '#title'=> 'contentone',

        ); 
        $form['contenttwo'] = array(
            '#type'=> 'checkbox',
            '#title'=> 'contenttwo',

        ); 
        $form['contentone']['#default_value'] = $info1;
        $form['contenttwo']['#default_value'] = $info2;
        return Parent::buildForm($form, $form_state);
    }
    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $config = $this->config(static::CONFIGNAME);
        $config->set("contentone", $form_state->getValue('contentone'));
        $config->set("contenttwo", $form_state->getValue('contenttwo'));
        $config->save();
    }
    
}