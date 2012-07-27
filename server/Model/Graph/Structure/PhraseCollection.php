<?php
class Model_Graph_Structure_PhraseCollection
implements Model_Graph_Structure_Interface_CreatingFromWords
{
    
    private $phraseAccess;
    private $compositionAccess;
    private $wordAccess;
    
    public function __construct(
        Data_Access_Graph_Cluster_Phrase $phraseAccess,
        Data_Access_Graph_Cluster_Composition $compositionAccess,
        Data_Access_Graph_Cluster_Word $wordAccess
    ) {
        
        $this->phraseAccess = $phraseAccess;
        $this->compositionAccess = $compositionAccess;
        $this->wordAccess = $wordAccess;

    }
    
    private function make(
        Data_Type_Graph_Cluster_Phrase $phrase,
        array $compositions,
        array $words
    ) {
        
        return new Model_Graph_Structure_Phrase(
            $phrase,
            $compositions,
            $words
        );
        
    }
    
    public function createUsingWords(array $words) {
        
        $wordClusters = array();
        $compositionClusters = array();

        foreach ($words as $index => $word) {
            
            $this->wordAccess instanceof Data_Access_Graph_Cluster_Interface_Creating;
            $wordClusters[$index] = $this->wordAccess->create();
            $wordClusters[$index] instanceof Data_Type_Graph_Cluster_Word;
            $wordClusters[$index]->setId($word);
            
            
            $this->compositionAccess instanceof Data_Access_Graph_Cluster_Interface_Creating;
            $compositionClusters[$index] = $this->compositionAccess->create();
            $compositionClusters[$index] instanceof Data_Type_Graph_Cluster_Composition;
            $compositionClusters[$index]->setWord($wordClusters[$index]);
            $compositionClusters[$index]->setNumber($index + 1);

        }
        
        $this->phraseAccess instanceof Data_Access_Graph_Cluster_Interface_Creating;
        $phrase = $this->phraseAccess->create();
        $phrase instanceof Data_Type_Graph_Cluster_Phrase;
        foreach ($compositionClusters as $compositionCluster) {
            $compositionCluster instanceof Data_Type_Graph_Cluster_Composition;
            $phrase->addComposition($compositionCluster);
            $compositionCluster->setPhrase($phrase);
        }

        return $this->make($phrase, $compositionClusters, $words);
        
    }
    
    public function checkExistence(
        Data_Type_Graph_Cluster_Phrase $phrase
    ) {
        
        $phrase instanceof Data_Type_Graph_Cluster_Interface_TypedArrayProvider;
        $typedArray = $action->getTypedArray();
var_dump($typedArray);
/*
        $originType = $action->getShortTypeName();
        list($targetTypes, $targetIds) = $action->getDefiningTargetTypesAndIds();
        $originId = $this->datasetWielder->findOriginId($originType, $targetTypes, $targetIds);
        
        if ($originId == false) {
            return false;
        } else  {
            return true;
        }
*/
    }
    
    
}