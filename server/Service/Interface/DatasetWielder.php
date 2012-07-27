<?php
interface Service_Interface_DatasetWielder {
    
    /**
     * Резервирует интервал целых чисел и возвращает первое
     * @return string[] т.к. в качестве идентификаторов используются слова и числа
     */
    public function occupyKeys(
        $type,
        $number
    );
    
    /**
     * Устанавливает однонаправленную связь 
     */
    public function connect(
        $originType,
        $originId,
        $targetType,
        $targetId
    );
    
    /**
     * Находит исходный идентификатор, пользуясь двунаправленностью связей.
     */
    public function findOriginId(
        $originType,
        array $targetTypes,
        array $targetIds
    );
    
    /**
     * Добавляет конечные идентификаторы к последовательности. 
     */
    public function registerProgress(
        $originType,
        $originId,
        array $targetTypes,
        array $targetIds
    );
    
    /**
     * Получает концы одинакового типа для одного начального идентификатора.
     */
    public function getTargetIds(
        $originType,
        $originId,
        $targetType
    );
    
    /**
     * Извлекает несколько идентификаоров из последовательности. 
     */
    public function getProgressTail(
        $originType,
        $originId,
        $targetType,
        $tailLength,
        $offset
    );
    
    
}