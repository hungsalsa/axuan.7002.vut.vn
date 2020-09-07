<?php
namespace frontend\common;
use Yii;
use yii\web\Session;
/**
 * summary
 */
class Cart
{
    /**
     * summary
     */
    public function addCart($id,$idVersion=null,$arrData,$number=1)
    {
    	$session = Yii::$app->session;
        /*Neu ton tai versions*/
        if ($idVersion > 0) {
            if (!isset($session['cart'])) {
                $arrData['versions']['amount_price_sale_1'] =  $number;
                $arrData['versions']['amount_price_2'] = $arrData['versions']['amount_price_3'] =0;
                $cart[$id.$idVersion] = [
                    'pro_id'=>$arrData['id'],
                    'pro_name'=>$arrData['pro_name'].'-'.$arrData['versions']['name'],
                    'slug'=>$arrData['slug'],
                    'slugCate'=>$arrData['slugCate'],
                    'date'=>$arrData['versions']['date'],
                    'image'=>$arrData['imageOne']['image'],
                    'amount'=>$number,
                    'idVersion'=>$idVersion,
                    'versions' => $arrData['versions']
                ];
            } else {
                $cart = $session['cart'];
                // pr($arrData['versions']['amount_price_sale_1']);
                // pr($arrData['versions']['amount_price_2']);
                if(array_key_exists($id.$idVersion,$cart)){
                // pr($cart);
                // dbg($arrData['versions']['amount_price_3']);
                    $arrData['versions']['amount_price_sale_1'] = $cart[$id.$idVersion]['versions']['amount_price_sale_1'] + $number;
                    $arrData['versions']['amount_price_2'] =  $cart[$id.$idVersion]['versions']['amount_price_2'];
                    $arrData['versions']['amount_price_3'] = $cart[$id.$idVersion]['versions']['amount_price_3'];

                    $cart[$id.$idVersion] = [
                        'pro_id'=>$arrData['id'],
                        'pro_name'=>$arrData['pro_name'].'-'.$arrData['versions']['name'],
                        'slug'=>$arrData['slug'],
                        'slugCate'=>$arrData['slugCate'],
                        'date'=>$arrData['versions']['date'],
                        'image'=>$arrData['imageOne']['image'],
                        'amount'=>$cart[$id.$idVersion]['amount'] + $number,
                        'idVersion'=>$idVersion,
                        'versions' => $arrData['versions']
                    ];
                }else{
                    $arrData['versions']['amount_price_sale_1'] = $number;
                    $arrData['versions']['amount_price_2'] = $arrData['versions']['amount_price_3'] = 0;
                    $cart[$id.$idVersion] = [
                        'pro_id'=>$arrData['id'],
                        'pro_name'=>$arrData['pro_name'].'-'.$arrData['versions']['name'],
                        'slug'=>$arrData['slug'],
                        'slugCate'=>$arrData['slugCate'],
                        'date'=>$arrData['versions']['date'],
                        'image'=>$arrData['imageOne']['image'],
                        'amount'=>$number,
                        'idVersion'=>$idVersion,
                        'versions' => $arrData['versions']
                    ];
                }
            }
        /*Neu ko ton tai versions*/
        }else{
            if (!isset($session['cart'])) {
            	$cart[$id] = [
            		'pro_id'=>$arrData['id'],
            		'pro_name'=>$arrData['pro_name'],
                    'slug'=>$arrData['slug'],
                    'slugCate'=>$arrData['slugCate'],
            		'price_sales'=>$arrData['price_sales'],
            		'price'=>$arrData['price'],
                    'start_sale'=>$arrData['start_sale'],
                    'end_sale'=>$arrData['end_sale'],
            		'image'=>$arrData['imageOne']['image'],
            		'amount'=>$number,
            		'idVersion'=>$idVersion,
            	];
            } else {
            	$cart = $session['cart'];
            	if(array_key_exists($id,$cart)){
            		$cart[$id] = [
            			'pro_id'=>$arrData['id'],
            			'pro_name'=>$arrData['pro_name'],
                        'slug'=>$arrData['slug'],
                        'slugCate'=>$arrData['slugCate'],
    	        		'price_sales'=>$arrData['price_sales'],
    	        		'price'=>$arrData['price'],
                        'start_sale'=>$arrData['start_sale'],
                        'end_sale'=>$arrData['end_sale'],
    	        		'image'=>$arrData['imageOne']['image'],
    	        		'amount'=>$cart[$id]['amount'] + $number,
    	        		'idVersion'=>$idVersion,
            		];
            	}else{
            		$cart[$id] = [
            			'pro_id'=>$arrData['id'],
            			'pro_name'=>$arrData['pro_name'],
                        'slug'=>$arrData['slug'],
                        'slugCate'=>$arrData['slugCate'],
    	        		'price_sales'=>$arrData['price_sales'],
    	        		'price'=>$arrData['price'],
                        'start_sale'=>$arrData['start_sale'],
                        'end_sale'=>$arrData['end_sale'],
    	        		'image'=>$arrData['imageOne']['image'],
    	        		'amount'=>$number,
    	        		'idVersion'=>$idVersion,
            		];
            	}
            }
        }
       /* $carts = usort($cart, function ($a, $b) {
    return $a['pro_id'] <=> $b['pro_id'];
});
        */
// dbg($cart);
        $session['cart'] = $cart;
    }

    public function delItemCart($id)
    {
    	$session = Yii::$app->session;
    	if(isset($session['cart'])){
    		$cart = $session['cart'];
    		// remove session
    		unset($cart[$id]);
	    	$session['cart'] = $cart;
    	}
    }

    public function updateCart($id,$amount,$price_attribute=null)
    {
        $session = Yii::$app->session;
        $cart = $session['cart'];
        // pr($cart);
        
        if(array_key_exists($id,$cart)){
            if ($price_attribute != null) {
                $cart[$id]['versions']['amount_'.$price_attribute] = $amount;
                // $cart[$id] = [
                //     'pro_name'=>$cart[$id]['pro_name'],
                //     'slug'=>$cart[$id]['slug'],
                //     'slugCate'=>$cart[$id]['slugCate'],
                //     'price_sales'=>$cart[$id]['price_sales'],
                //     'price'=>$cart[$id]['price'],
                //     'image'=>$cart[$id]['image'],
                // // 'manufacturer_id'=>$cart[$id]['manufacturer_id'],
                //     'amount'=>$amount,
                    

                //     'pro_id'=>$cart[$id]['id'],
                //     'pro_name'=>$cart[$id]['pro_name'].'-'.$cart[$id]['versions']['name'],
                //     'slug'=>$cart[$id]['slug'],
                //     'slugCate'=>$cart[$id]['slugCate'],
                //     'date'=>$cart[$id]['versions']['date'],
                //     'image'=>$cart[$id]['image'],
                //     'amount'=>$amount,
                //     'idVersion'=>$cart[$id]['idVersion'],
                //     'versions' => [
                //         'id' => $cart[$id]['versions']['id'],
                //         'date' => $cart[$id]['versions']['date'],
                //         'name' => $cart[$id]['versions']['name'],
                //         'id' => $cart[$id]['versions']['id'],
                //         'id' => $cart[$id]['versions']['id'],
                //     ]
                // ];
            } else {
                $cart[$id]['amount']=$amount;
                // $cart[$id] = [
                    // 'pro_name'=>$cart[$id]['pro_name'],
                    // 'slug'=>$cart[$id]['slug'],
                    // 'slugCate'=>$cart[$id]['slugCate'],
                    // 'price_sales'=>$cart[$id]['price_sales'],
                    // 'price'=>$cart[$id]['price'],
                    // 'image'=>$cart[$id]['image'],
                    // 'amount'=>$amount,

                /*    'pro_id'=>$$cart[$id]['id'],
                    'pro_name'=>$$cart[$id]['pro_name'],
                    'slug'=>$$cart[$id]['slug'],
                    'slugCate'=>$$cart[$id]['slugCate'],
                    'price_sales'=>$$cart[$id]['price_sales'],
                    'price'=>$$cart[$id]['price'],
                    'start_sale'=>$$cart[$id]['start_sale'],
                    'end_sale'=>$$cart[$id]['end_sale'],
                    'image'=>$$cart[$id]['image'],
                    'amount'=>$amount,
                    'idVersion'=>$cart[$id]['idVersion'],
                ];*/
                
            }
            $session['cart'] = $cart;
        }
    }
}