<?php
class Data_Type_Plane_Factory {
    
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
            $this->uniqueInstances[$instance_key] = new Data_Type_Plane_Action(
                
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makeAuthor() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Type_Plane_Author(
                
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }

    public function makeCommunication() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Type_Plane_Communication(
                
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makeComposition() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Type_Plane_Composition(
                
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makeDescription() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Type_Plane_Description(
                
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makeDetail() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Type_Plane_Detail(
                
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makeInteraction() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Type_Plane_Interaction(
                
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makeMessage() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Type_Plane_Message(
                
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makeObject() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Type_Plane_Object(
                
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makePhrase() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Type_Plane_Phrase(
                
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makeProposition() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Type_Plane_Proposition(
                
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makeReference() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Type_Plane_Reference(
                
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }

    public function makeSign() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Type_Plane_Sign(
                
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makeWord() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Type_Plane_Word(
                
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    

    
    
}
