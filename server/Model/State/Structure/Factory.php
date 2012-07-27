<?php
class Model_State_Structure_Factory {
    
    private $identifierFactory;
    private $connectionFactory;
    
    /**
     * Создаёт экземпляр класса
     */
    public function __construct(
        Model_State_Identifier_Factory $identifierFactory,
        Model_State_Connection_ConnectionFactory $connectionFactory
    ) {

        $this->identifierFactory = $identifierFactory;
        $this->connectionFactory = $connectionFactory;

    }
    
    public function makePropositionStructure() {
        
        $propositionId = $this->identifierFactory->makePropositionIdentifier();
        $actionId = $this->identifierFactory->makeActionIdentifier();
        $detailId = $this->identifierFactory->makeDetailIdentifier();
        $descriptionId = $this->identifierFactory->makeDescriptionIdentifier();
        $subDescriptionId = $this->identifierFactory->makeDescriptionIdentifier();
        
        $propositionStructure = $this->makeElement(
            $propositionId, 
            array(
                $this->makeElement(
                    $actionId,
                    array()
                ),
                $this->makeElement(
                    $detailId,
                    array(
                        $this->makeElement(
                            $descriptionId,
                            array(
                                $this->makeElement(
                                    $subDescriptionId,
                                    array()
                                )
                            )
                        )
                    )
                )
            )
        );
        
        $propositionStructure->setConnectionFactory($this->connectionFactory);
        
        return $propositionStructure;
 
    }
    
    public function makeHumanStructure() {
        
        $propositionId = $this->identifierFactory->makePropositionIdentifier();
        $actionId = $this->identifierFactory->makeActionIdentifier();
        $detailId = $this->identifierFactory->makeDetailIdentifier();
        $descriptionId = $this->identifierFactory->makeDescriptionIdentifier();
        $subDescriptionId = $this->identifierFactory->makeDescriptionIdentifier();
        $phraseId = $this->identifierFactory->makePhraseIdentifier();
        $wordId = $this->identifierFactory->makeWordIdentifier();
        
        $propositionStructure = $this->makeElement(
            $propositionId, 
            array(
                $this->makeElement(
                    $actionId,
                    array(
                        $this->makeElement(
                            $phraseId,
                            array(
                                $this->makeElement(
                                    $wordId,
                                    array()
                                )
                            )
                        )
                    )
                ),
                $this->makeElement(
                    $detailId,
                    array(
                        $this->makeElement(
                            $phraseId,
                            array(
                                $this->makeElement(
                                    $wordId,
                                    array()
                                )
                            )
                        ),
                        $this->makeElement(
                            $descriptionId,
                            array(
                                $this->makeElement(
                                    $phraseId,
                                    array(
                                        $this->makeElement(
                                            $wordId,
                                            array()
                                        )
                                    )
                                ),
                                $this->makeElement(
                                    $subDescriptionId,
                                    array(
                                        $this->makeElement(
                                            $phraseId,
                                            array(
                                                $this->makeElement(
                                                    $wordId,
                                                    array()
                                                )
                                            )
                                        )
                                    )
                                )
                            )
                        )
                    )
                )
            )
        );
        
        $propositionStructure->setConnectionFactory($this->connectionFactory);
        
        return $propositionStructure;
 
    }
    
    private function makeElement(
        Model_State_Identifier_Identifier $originExample, 
        array $targetExamples
    ) {
        
        return new Model_State_Structure_Element($originExample, $targetExamples);
        
    }
    
}