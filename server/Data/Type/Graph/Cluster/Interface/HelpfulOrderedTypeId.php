<?php
interface Data_Type_Graph_Cluster_Interface_HelpfulOrderedTypeId 
extends Data_Type_Graph_Cluster_Interface_OrderedTypeId
{
    
    public function canProvideNextNumber();
    public function provideNextNumber();
    
}