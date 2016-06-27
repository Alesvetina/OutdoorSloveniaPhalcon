<?php
/**
 * Created by PhpStorm.
 * User: anze
 * Date: 18. 03. 2016
 * Time: 07:32
 */

namespace Component;

use Component\Form;

class View extends \Phalcon\Mvc\View {

    protected $_forms = [];

    public function addForm($formId, Form $form){
        $this->_forms[$formId] = $form;
    }

    public function outputForm($formId){
        return '<div class="siform" id="siform-'.$formId.'"></div>';
    }

    public function outputJs(){
        $output = '';
        if (sizeof($this->_forms) > 0){
            $output = '<script type="text/javascript">';
            foreach ($this->_forms as $formId => $form){
                $output .= '$("#siform-'.$formId.'").alpaca('.$form->getJson().')';
            }
            $output .= '</script>';
        }
        return $output;
    }

}