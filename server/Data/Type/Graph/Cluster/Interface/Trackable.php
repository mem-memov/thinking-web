<?php
/**
 * Возможно отслеживать (хранить и восстанавливать состояние) по типу и идентификатору 
 * Методы интерфейса необходимы для составления уникальных ключей базы данных.
 */
interface Data_Type_Graph_Cluster_Interface_Trackable 
extends Data_Type_Graph_Cluster_Interface_Typed
{
    
    /**
     * Возвращает идентификатор (слово или число)
     * @return string 
     */
    public function getId();
    
    /**
     * Возвращает тип
     * @return string 
     */
    //public function getShortTypeName();
    
}
