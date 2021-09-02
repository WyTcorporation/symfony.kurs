<?php
/**
 * Create by: Vladislav Gladyr
 * Site: lockit.com.ua
 * Email: wild.savedo@gmail.com
 * Date : 24.07.2021
 */

namespace AppBundle\Service;


use AppBundle\Entity\Product;

class SerializeProductService
{
    public function serialize(Product $product) {
        $arr = [
            'title'=> $product->getTitle(),
            'category'=> $product->getCategory(),
            'price'=> $product->getPrice()
        ];
        return $arr;
    }
}