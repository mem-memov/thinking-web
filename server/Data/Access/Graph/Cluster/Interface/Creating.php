<?php
/**
 * Могут создавать пустые кластеры 
 */
interface Data_Access_Graph_Cluster_Interface_Creating {
    
    /**
     * Создаёт кластер определённого типа
     * 
     * @return Data_Type_Graph_Cluster_Abstract
     */
    public function create();
    
}
