<?php

class StudioForty9_Performance_Model_Observer extends Varien_Event_Observer
{
    public function cmsPageRender($observer)
    {
        $request = $observer->getControllerAction()->getRequest();
        if($request->getParam('refresh_fpc')){
            $fpc = Mage::getSingleton('fpc/fpc');
            $page = $observer->getPage();
            $tags = array(sha1('cms_' . $page->getId()),
                sha1('cms_' . $page->getIdentifier()));
            $fpc->clean($tags, Zend_Cache::CLEANING_MODE_MATCHING_ANY_TAG);
        }
    }

    public function catalogControllerCategoryInitAfter($observer)
    {
        $request = $observer->getControllerAction()->getRequest();
        if($request->getParam('refresh_fpc')){
            $fpc = Mage::getSingleton('fpc/fpc');
            $category = $observer->getCategory();
            $fpc->clean(sha1('category_' . $category->getId()));
        }
    }

    public function catalogControllerProductView($observer)
    {
        $request = Mage::app()->getRequest();
        if($request->getParam('refresh_fpc')){
            $fpc = Mage::getSingleton('fpc/fpc');
            $product = $observer->getProduct();
            $fpc->clean(sha1('product_' . $product->getId()));
        }
    }
}