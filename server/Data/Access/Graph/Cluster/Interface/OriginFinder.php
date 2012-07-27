<?php
/**
 * Находит начальную точку кластера по конечным
 * @see Data_Type_Graph_Cluster_Interface_Definable 
 */
interface Data_Access_Graph_Cluster_Interface_OriginFinder {
    
    /**
     * Находит идентификатор начальной точки и вносит его в кластер 
     */
    public function defineUsingTargets(
        Data_Type_Graph_Cluster_Interface_Definable $cluster
    );
    
}
