<?php
class Model_State_Plane_Factory {
    
    /**
     * Контейнер для уникальных объектов
     *
     * @var array
     */
    private $uniqueInstances;
    
    /**
     * Создаёт экземпляр класса
     */
    public function __construct(

    ) {

        $this->uniqueInstances = array();

    }
    
    public function makeAction() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Model_State_Plane_Action(
                
            );
            $this->uniqueInstances[$instance_key]->setProducingTypes(array(
                $this->makePhrase()->getName(),
                $this->makeDetail()->getName()
            ));
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makeReference() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Model_State_Plane_Reference(
                
            );
            $this->uniqueInstances[$instance_key]->setProducingTypes(array(
                $this->makeDetail()->getName(),
                $this->makeProposition()->getName()
            ));
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makeInteraction() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Model_State_Plane_Interaction(
                
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makeCommand() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Model_State_Plane_Command(
                
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makeCommunication() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Model_State_Plane_Communication(
                
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makeDescription() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Model_State_Plane_Description(
                
            );
            $this->uniqueInstances[$instance_key]->setProducingTypes(array(
                $this->makePhrase(),
                $this->uniqueInstances[$instance_key]->getName()
            ));
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makeDetail() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Model_State_Plane_Detail(
                
            );
            $this->uniqueInstances[$instance_key]->setProducingTypes(array(
                $this->makePhrase()->getName(),
                $this->makeDescription()->getName()
            ));
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makeObject() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Model_State_Plane_Object(
                
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makePhrase() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Model_State_Plane_Phrase(
                
            );
            $this->uniqueInstances[$instance_key]->setProducingTypes(array(
                $this->makeWord()->getName()
            ));
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makeProposition() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Model_State_Plane_Proposition(
                
            );
            $this->uniqueInstances[$instance_key]->setProducingTypes(array(
                $this->makeAction()->getName()
            ));
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makeQuestion() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Model_State_Plane_Question(
                
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makeSubject() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Model_State_Plane_Subject(
                
            );
            $this->uniqueInstances[$instance_key]->setProducingTypes(array(
                $this->makePhrase()->getName()
            ));
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makeWord() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Model_State_Plane_Word(
                
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makeSign() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Model_State_Plane_Sign(
                
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    
}
