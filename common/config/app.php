<?php
return [
	'mailerb' => [

		'class' => 'yii\swiftmailer\Mailer',
		'useFileTransport'=>false,
		'transport' => [
			'class' => 'Swift_SmtpTransport',
			'host' => 'smtp.gmail.com',
			'username' => 'nguyensonqang240@gmail.com',
			'password' => '4Xu3wcUKldm8uD90tCMP',
			'port' => '465',
			'encryption' => 'ssl',
		]
	],
];
