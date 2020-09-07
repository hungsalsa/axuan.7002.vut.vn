<?php use yii\helpers\Html; ?>
<h1>Cảm ơn Anh/Chị <?= $data['fullname'] ?> đã đăng ký thông tin từ : <?= $data['hostInfo'] ?></h1>
<table style="width: 80%; border: 1px dotted; border-collapse: collapse;">
 <thead>
		<tr>
			<th colspan="2" style="color: blue; font-size: 20px; padding: 10px;">Chúng tôi sẽ thông tin mới nhất tới Quý Anh/Chị</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<th colspan="2" style="color: blue; font-size: 17px; padding: 10px;">Thông tin chi tiết Anh/Chị</th>
		</tr>
		<tr>
			<td style="border: 1px dotted;">Tên đầy đủ</td>
			<td style="border: 1px dotted;"><?= $data['fullname'] ?></td>
		</tr>
		<tr>
			<td style="border: 1px dotted;">Số điện thoại</td>
			<td style="border: 1px dotted;"><?= $data['phone'] ?></td>
		</tr>
		<tr>
			<td style="border: 1px dotted;">Email</td>
			<td style="border: 1px dotted;"><?= $data['email'] ?></td>
		</tr>
		<tr>
			<td style="border: 1px dotted;">URL</td>
			<td style="border: 1px dotted;"><?= Html::a($data['url'],$data['url']); ?> </td>
		</tr>
		
		<tr>
			<td style="border: 1px dotted;">Ghi chú của Anh/Chị</td>
			<td style="border: 1px dotted;"><?= $data['note'] ?></td>
		</tr>
		
	</tbody>
</table>