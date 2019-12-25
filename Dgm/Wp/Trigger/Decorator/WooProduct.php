<?php
namespace Dgm\Wp\Trigger\Decorator;
class WooProduct implements IInputDecorator {
    private static $isWooAvailable = null;
    
    public function decorate(array $args):array {
        if(!self::isWooInstalled()) {
            return $args;
        }
        foreach($args as $key=>$val) {
            if($val instanceof \WC_Product) {
                $args[$key] = $this->getPostDetails($val);
            }
        }
        return $args;
    }
    
    protected function getProductDetails(\WC_Product $product) {
        return [
            'product'=>$product,
            'name'=>$product->get_name(),
            'price'=>$product->get_price(),
            'sale_price'=>$product->get_sale_price(),
            'tax_class'=>$product->get_tax_class(),
            'stock_status'=>$product->get_stock_status()
            //todo: add more basic product info    
                
        ];
    }
    
    protected static function isWooInstalled():bool {
        if(is_null(self::$isWooAvailable)) {
            self::$isWooAvailable = class_exists('\WC_Product');
        }
        return self::$isWooAvailable;
    }
}
