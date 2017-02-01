<?php
/**
 * Created by PhpStorm.
 * User: risky
 * Date: 2017/1/31
 * Time: 21:30
 */
namespace designMode\builder;
/**
 * 建造者模式
* 将一个复杂对象的构造与它的表示分离,是同样的构建过程可以创建不同的表示;
 * 目的是为了消除其他对象复杂的创建过程  就是说 将造轮子的过程在客户端隐藏
**
 * 产品,包含产品类型、价钱、颜色属性
*/
class Product
{
    public $_type  = null;
    public $_price = null;
    public $_color = null;

    public function setType($type)
    {
        echo 'set the type of the product,';
        $this->_type = $type;
    }

    public function setPrice($price)
    {
        echo 'set the price of the product,';
        $this->_price = $price;
    }

    public function setColor($color)
    {
        echo 'set the color of the product,';
        $this->_color = $color;
    }
}



//使用builder模式
/**
 * builder类
*/
class ProductBuilder
{
    public $_config = null;
    public $_object = null;

    public function ProductBuilder($config)
    {
        $this->_object = new Product();
        $this->_config = $config;
    }

    public function build()
    {
        echo '<br />Using builder pattern:<br />';
        $this->_object->setType($this->_config['type']);
        $this->_object->setPrice($this->_config['price']);
        $this->_object->setColor($this->_config['color']);
    }

    public function getProduct()
    {
        return $this->_object;
    }
}
/**
 * client
 * 客户端
 */
class Client {
    /**
     * Main program.
     */
    public static function main($config) {

        $objBuilder = new ProductBuilder($config);
        $objBuilder->build();
        $objProduct = $objBuilder->getProduct();
        return $objProduct;
    }
}
$config = array(
    'type'  => 'shirt',
    'price' => 100,
    'color' => 'red',
);

//不使用builder模式
/*$product = new Product();
$product->setType($config['type']);
$product->setPrice($config['price']);
$product->setColor($config['color']);*/

$product=Client::main($config);
    var_dump($product);
