<?php
/**
 * Можно проверить, содержит ли кластер достаточно данных о конечных точках, чтобы найти начальную 
 * @see Model_Graph_Structure_MessageCollection
 */
interface Data_Type_Graph_Cluster_Interface_Checkable {
    
    /** @return boolean */
    public function canBeDefinedByTargetIds();
    
}
