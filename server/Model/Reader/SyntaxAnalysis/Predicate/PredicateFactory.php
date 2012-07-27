<?php
class Model_Reader_SyntaxAnalysis_Predicate_PredicateFactory {
    
    public function __construct() {
        
        ;
    
    }
    
    public function getMessagePredicate() {
        
        return new Model_Reader_SyntaxAnalysis_Predicate_MessagePredicate();
        
    }
    
    public function getPropositionPredicate() {
        
        return new Model_Reader_SyntaxAnalysis_Predicate_PropositionPredicate();
        
    }
    
    public function getSignedActionPredicate() {
        
        return new Model_Reader_SyntaxAnalysis_Predicate_SignedActionPredicate();
        
    }
    
    public function getCircumstancePredicate() {
        
        return new Model_Reader_SyntaxAnalysis_Predicate_CircumstancePredicate();
        
    }
    
    public function getSignedDetailPredicate() {
        
        return new Model_Reader_SyntaxAnalysis_Predicate_SignedDetailPredicate();
        
    }
    
    public function getSignedDescriptionPredicate() {
        
        return new Model_Reader_SyntaxAnalysis_Predicate_SignedDescriptionPredicate();
        
    }
    
    public function getInteractionPredicate() {
        
        return new Model_Reader_SyntaxAnalysis_Predicate_InteractionPredicate();
        
    }
    
    public function getReferencePredicate() {
        
        return new Model_Reader_SyntaxAnalysis_Predicate_ReferencePredicate();
        
    }
    
    public function getDescriptionPredicate() {
        
        return new Model_Reader_SyntaxAnalysis_Predicate_DescriptionPredicate();
        
    }
    
    
}