


<h1>Transaction Details</h1>
<h2><?= $transaction->id; ?> <?= $transaction->name; ?></h2>

<?php 
 	// remove id from array and name from $transaction array
	unset($transaction->id);
	unset($transaction->name);
	unset($transaction->user_id);
	unset($transaction->status);
?>

<?= validation_errors(); ?>
<?= form_open('transaction_details/update'); ?>
<ul>
	<?php foreach ($transaction as $key => $value): ?>
		<li><strong><?php echo $key; ?></strong><input type="text" name="<?= $key; ?>" value="<?php echo $value; ?>"></li>
	<?php endforeach ?>
</ul>
<input type = "submit" value="update">
</form>