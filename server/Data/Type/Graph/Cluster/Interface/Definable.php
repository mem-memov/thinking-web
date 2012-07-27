<?php
/**
 * Начальная точка кластера может быть найдена по конечным точкам
 * @see Data_Access_Graph_Cluster_Interface_OriginFinder 
 */
interface Data_Type_Graph_Cluster_Interface_Definable 
extends Data_Type_Graph_Cluster_Interface_Typed
{
    
    /** 
     * Возвращает тип начальной точки
     * @return string 
     */
    //public function getShortTypeName();
    
    /** 
     * Метод предоставляет сведения о конечных точках, которых достаточно для нахождения начальной точки
     * Каждая конечная точка характкризуется идентификаором и типом.
     * @return array [ 0:[type], 1:[id] ] 
     */
    public function getDefiningTargetTypesAndIds();
    
    /**
     * Метод необходим, чтобы перенести найденный начальный идентификатор в кластер 
     * @param string $id идентификатор
     */
    public function setId($id);
    
}
