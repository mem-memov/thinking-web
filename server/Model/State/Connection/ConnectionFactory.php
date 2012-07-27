<?php
class Model_State_Connection_ConnectionFactory {
    
    public function makeConnection(
        Model_State_Identifier_Identifier $from,
        Model_State_Identifier_Identifier $to
    ) {
        
        return new Model_State_Connection_Connection(
            $from,
            $to   
        );
        
    }
    
}