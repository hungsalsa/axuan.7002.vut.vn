<?php
use yii\web\HttpException;

function getUser(){
	if (($user = Yii::$app->user->identity) !== null) {
		return $user;
	}

	// throw new \yii\web\HttpException(403, 'Bạn không có quyền vào đây khi chưa đăng nhập');
}
function dbg($array) {
    echo '<pre>';
    print_r($array);
    echo '</pre>';die();
}

function pr($array) {
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

/**
 * Debug function with die() after
 * dd($var);
 */
// function dd() {
//     for ($i = 0; $i < func_num_args(); $i++) {
//         d(func_get_arg($i));
//     }
//     die();
// }