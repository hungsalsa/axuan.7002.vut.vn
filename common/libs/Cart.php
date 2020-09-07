<?php
namespace common\libs;
use frontend\models\Product;
use yii\web\Session;
use Yii;
// use yii\web\NotFoundHttpException;
/**
 * summary
 */
class Cart
{
    /**
     * summary
     */
    public function addCart($id,$num = 1)
    {

    	$session = Yii::$app->session;
        $product = new Product();
        $dataProduct = $product->getProductById($id);
        if(!isset($session['cart'])){
        	$cart[$id] = [
        		'pro_name'=>$dataProduct['pro_name'],
                'price_sales'=>$dataProduct['price_sales'],
                'price'=>$dataProduct['price'],
                'image'=>$dataProduct['image'],
                'manufacturer_id'=>$dataProduct['manufacturer_id'],
        		'slug'=>$dataProduct['slug'],
        		'pro_sl'=>$num,
        	];
        }else{
        	$cart = $session['cart'];
        	if(array_key_exists($id,$cart)){
        		$cart[$id] = [
        			'pro_name'=>$dataProduct['pro_name'],
                    'price_sales'=>$dataProduct['price_sales'],
                    'price'=>$dataProduct['price'],
                    'image'=>$dataProduct['image'],
                    'manufacturer_id'=>$dataProduct['manufacturer_id'],
                    'slug'=>$dataProduct['slug'],
	        		'pro_sl'=>(int)$cart[$id]['pro_sl'] + $num,
        		];
        	}else{
        		$cart[$id] = [
        			'pro_name'=>$dataProduct['pro_name'],
                    'price_sales'=>$dataProduct['price_sales'],
                    'price'=>$dataProduct['price'],
                    'image'=>$dataProduct['image'],
                    'manufacturer_id'=>$dataProduct['manufacturer_id'],
                    'slug'=>$dataProduct['slug'],
                    'pro_sl'=>$num,
            		];
        	}
        }

        $session['cart'] = $cart;
    }


    public function updateCart($id,$num)
    {
        $session = Yii::$app->session;
        if(isset($session['cart'])){
            $cart = $session['cart'];
            if(array_key_exists($id,$cart)){
                if(!$num){
                     unset($cart[$id]);
                }else {
                    $cart[$id] = [
                        'pro_name' => $cart[$id]['pro_name'],
                        'price_sales'=>$cart[$id]['price_sales'],
                        'price'=>$cart[$id]['price'],
                        'image'=>$cart[$id]['image'],
                        'manufacturer_id'=>$cart[$id]['manufacturer_id'],
                        'slug'=>$cart[$id]['slug'],
                        'pro_sl'=>$num,
                    ];
                }
            }
            $session['cart'] = $cart;
        }
    }

}