<?php if ($data):  foreach ($data['position'] as $key => $value): ?>
	<option value="<?= $key ?>"><?= $value ?></option>
	<?php endforeach  ?>**
	<?php foreach ($data['LinkCat'] as $keyc => $valuec): ?>
		<option value="<?= $keyc ?>"><?= $valuec ?></option>
	<?php endforeach ?>
	<?php if (isset($data['hienthi'])): ?>hienthi<?php foreach ($data['hienthi'] as $ht => $hienthi): ?>
		<option value="<?= $ht ?>"><?= $hienthi ?></option>
	<?php endforeach;endif ?>
	<?php if (isset($data['page_show'])):  foreach ($data['page_show'] as $ht => $page_show): ?>
		<option value="<?= $ht ?>"><?= $page_show ?></option>
	<?php endforeach;endif ?>
<?php endif ?>