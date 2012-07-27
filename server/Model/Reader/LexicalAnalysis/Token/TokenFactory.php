<?php
class Model_Reader_LexicalAnalysis_Token_TokenFactory {
    
    public function __construct() {}
    
    public function makeAuthorToken($value) {
        
        return new Model_Reader_LexicalAnalysis_Token_AuthorToken($value);
        
    }
    
    public function makeActionToken($value) {
        
        return new Model_Reader_LexicalAnalysis_Token_ActionToken($value);
        
    }
    
    public function makeDetailToken($value) {
        
        return new Model_Reader_LexicalAnalysis_Token_DetailToken($value);
        
    }
    
    public function makeSignToken($value) {
        
        return new Model_Reader_LexicalAnalysis_Token_SignToken($value);
        
    }
    
    public function makeLeftBracketToken() {
        
        return new Model_Reader_LexicalAnalysis_Token_LeftBracketToken();
        
    }
    
    public function makeRightBracketToken() {
        
        return new Model_Reader_LexicalAnalysis_Token_RightBracketToken();
        
    }
    
    
    
}