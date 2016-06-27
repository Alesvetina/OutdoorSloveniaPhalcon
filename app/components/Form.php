<?php
namespace Component;

class Form {

    private $handle = false;
    private $values = [];

    /**
     * Default form definitions
     * @var array
     */
    private $definitions = [
        'data' => [],
        'schema' => [
            'type' => 'object',
            'properties' => []
        ],
        'options' => [
            'form' => [
                'attributes' => [
                    'action' => '#',
                    'method' => 'post'
                ],
                'buttons' => [
                    'submit' => []
                ]
            ],
            'fields' => [],
            'hideInitValidationError' => true
        ]
    ];

    public function __construct(){}

    /**
     * Set the handle, that will be used for every field in the form {handle}[{field}]
     * @param $handle
     * @return $this
     */
    public function setHandle($handle){
        $this->handle = $handle;
        return $this;
    }

    /**
     * Set the action of the form
     * @param $action
     * @return $this
     */
    public function setAction($action){
        $this->definitions['options']['form']['attributes']['action'] = $action;
        return $this;
    }

    /**
     * Set the values for the fields
     * @param $values
     * @return $this
     */
    public function setValues($values){
        $this->values = $values;
        foreach ($this->values as $key => $value){
            $this->definitions['data'][$key] = $value;
        }
        return $this;
    }

    /**
     * Apply definitions over the default configuration
     * @param $params
     * @return $this
     */
    public function setDefinitions($params){
        foreach ($params as $key => $param){
            $this->addDefinitionParam($key,$param);
        }
        return $this;
    }

    /**
     * Append the field with the http referrer for redirection after submitting
     * @param $url
     * @return $this
     */
    public function setBackUrl($url){
        $this->addDefinitionParam('lyphaPreviousRequest',[
            'type' => 'hidden',
            'value' => $url,
            'name' => 'lyphaPreviousRequest'
        ]);
        return $this;
    }

    /**
     * Add a field to the form definition
     * @param $fieldName
     * @param $params
     */
    private function addDefinitionParam($fieldName,$params){
        $fieldSchema = ['type' => 'string'];
        $fieldOptions = [];
        if (isset($params['type'])){
            $fieldOptions['type'] =  $params['type'];
            $fieldType = $params['type'];
        } else {
            $fieldType = 'text';
        }
        if (isset($params['title'])){
            $fieldSchema['title'] = $params['title'];
        }
        if (isset($params['values'])){
            if (is_object($params['values'])){
                if (!isset($params['using'])){
                    $params['using'] = ['id','title'];
                }
                $params['values'] = $this->getValuesFromResultSet($params['values'],$params['using']);
            }
            $fieldSchema['enum'] = $this->getOptionValues($params['values']);
            $fieldOptions['optionLabels'] = $this->getOptionLabels($params['values']);
        }
        if ($fieldType == 'select'){
            $fieldOptions['emptySelectFirst'] = true;
            $fieldOptions['removeDefaultNone'] = true;
        }
        if ($fieldType == 'datetime'){
            $fieldSchema['format'] = 'datetime';
            $fieldOptions['dateFormat'] = 'YYYY-MM-DD HH:mm:ss';
            $fieldOptions['picker']['sideBySide'] = true;
        }
        if (isset($params['name'])){
            $fieldOptions['name'] = $params['name'];
        } else {
            if ($this->handle){
                $fieldOptions['name'] = $this->handle . '[' . $fieldName . ']';
            }
        }
        if (isset($params['required'])){
            $fieldSchema['required'] = $params['required'];
        }
        $this->definitions['schema']['properties'][$fieldName] = $fieldSchema;
        $this->definitions['options']['fields'][$fieldName] = $fieldOptions;

        // Set the value (from form definition or from provided model instance)
        $value = false;
        if (isset($params['value'])){
            $value = $params['value'];
        } elseif (isset($this->values[$fieldName])){
            $value = $this->values[$fieldName];
        }
        if ($value){
            $this->definitions['data'][$fieldName] = $value;
        }
    }

    /**
     * Returns json encoded definitions ready for Aplacajs form
     * @return string
     */
    public function getJson(){
        return json_encode($this->definitions,JSON_UNESCAPED_UNICODE);
    }

    /**
     * Parse phalcon resultset into a key->value array
     * @param $results
     * @param $using
     * @return array
     */
    private function getValuesFromResultSet($results,$using){
        $values = [];
        $keyName = $using[0];
        $valueName = $using[1];
        foreach ($results as $result){
            $values[$result->$keyName] = $result->$valueName;
        }
        return $values;
    }

    /**
     * Get array of select values
     * @param $options
     * @return array
     */
    private function getOptionValues($options){
        $values = [];
        foreach ($options as $k => $v){
            $values[] = $k;
        }
        return $values;
    }

    /**
     * Get array of select labels
     * @param $options
     * @return array
     */
    private function getOptionLabels($options){
        $values = [];
        foreach ($options as $k => $v){
            $values[] = $v;
        }
        return $values;
    }

}
