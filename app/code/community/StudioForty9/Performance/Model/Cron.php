<?php

class StudioForty9_Performance_Model_Cron
{
    public function refresh_invalidated_cache()
    {
        $types = Mage::app()->getCacheInstance()->getInvalidatedTypes();
        foreach($types as $type) {
            Mage::app()->getCacheInstance()->cleanType($type->getId());
        }
    }
}