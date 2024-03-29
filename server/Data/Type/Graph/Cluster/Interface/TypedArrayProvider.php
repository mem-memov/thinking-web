<?php
/**
 * Получает список всех вложенных кластеров с группировкой по типам 
 * Представляет дерево в плоском виде. Используется для проверки существования.
 * Слова не поддерживают это интерфейс, т.к. они расположены на нижнем уровне
 */
interface Data_Type_Graph_Cluster_Interface_TypedArrayProvider {
    
    public function getTypedArray();
    
}
