<?php
class Service_Redis_DatasetWielder 
implements Service_Interface_DatasetWielder 
{
    
    private $redis;
    
    public function __construct(
        Service_Redis_Redis $redis
    ) {
        
        //$redis->FlushAll();
        
        $this->redis = $redis;
        
        
    }
    
    public function occupyKeys(
        $type,
        $number
    ) {
        
        if ($number < 1) {
            throw new Service_Redis_Exception('Неясно число резервируемых идентификаторов.');
        }

        $maxIndex = $this->redis->IncrBy(
            $type, 
            $number
        );
        
        $minIndex = $maxIndex - $number + 1;
        
        $ids = array();
        
        for ($i=$minIndex; $i<=$maxIndex; $i++) {
            $ids[] = (string)$i;
        }
        
        return $ids;

    }
  
    public function connect(
        $originType,
        $originId,
        $targetType,
        $targetId
    ) {

        $this->redis->sAdd(
                $this->composeConnectionKey($originType, $originId, $targetType), 
                $targetId
        );
        
    }
    
    public function findOriginId(
        $originType,
        array $targetTypes,
        array $targetIds
    ) {
 
        $targetIdCount = count($targetIds);
        $targetTypeCount = count($targetTypes);
        
        if ($targetIdCount !== $targetTypeCount) {
            throw new Service_Redis_Exception('Количество идентификаторос и типов не совпадает.');
        }
        
        if ($targetIdCount === 0) {
            throw new Service_Redis_Exception('Невозможно найти начало, когда нет концов.');
        }
        
        if ($targetIdCount == 1) {
            
            $key = $this->composeConnectionKey(
                        $targetTypes[0], 
                        $targetIds[0], 
                        $originType
            );
          
            $originIds = $this->redis->sMembers($key);

        }
        
        if ($targetIdCount > 1) {
        
            $keysToIntersect = array();
        
            foreach ($targetIds as $index => $targetId) {

                $keysToIntersect[] = $this->composeConnectionKey(
                                        $targetTypes[$index], 
                                        $targetId,
                                        $originType
                );

            }

            $originIds = $this->redis->sInter($keysToIntersect);
            
        }

        if (count($originIds) == 1) {
           
            return $originIds[0];
            
        } 
        
        if (count($originIds) > 1) {
           
            throw new Service_Redis_Exception('Обнаружено несколько исходных узлов вместо одного.');
            
        } 
        
        return false;
        
    }
    
    public function registerProgress(
        $originType,
        $originId,
        array $targetTypes,
        array $targetIds
    ) {
        
        $targetIdCount = count($targetIds);
        $targetTypeCount = count($targetTypes);
        
        if ($targetIdCount !== $targetTypeCount) {
            throw new Service_Redis_Exception('Количество идентификаторос и типов не совпадает.');
        }
        
        foreach ($targetIds as $index => $targetId) {

            $this->redis->RPush(
                $this->composeListKey($originType, $originId, $targetTypes[$index]),
                $targetId
            ); 
            
        }

    }

    public function getTargetIds(
        $originType,
        $originId,
        $targetType
    ) {
        
        $key = $this->composeConnectionKey($originType, $originId, $targetType);

        $targeIds = $this->redis->sMembers($key);

        return $targeIds;
        
    }
    
    public function getProgressTail(
        $originType,
        $originId,
        $targetType,
        $tailLength,
        $offset
    ) {
        
        $ids = array();

        $listKey = $this->composeListKey($origin, $example);

        $index = $this->redis->LLen($listKey) - $offset - 1;

        $limit = $index - $tailLength;

        if ($limit < 0) {
            $limit = 0;
        }
        
        for ($index; $index > $limit; $index--) {
            
            $ids[] = $this->redis->LIndex($listKey, $index);
            
        }
 
        return $ids;
        
    }
    
    private function composeListKey(
        $originType,
        $originId,
        $targetType
    ) {
        
        return $this->composeConnectionKey($originType, $originId, $targetType).'.list';
        
    }

    private function composeConnectionKey(
        $originType,
        $originId,
        $targetType
    ) {

        return $originType.'#'.$originId.':'.$targetType;
        
    }
      
}