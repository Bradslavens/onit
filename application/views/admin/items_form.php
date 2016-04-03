	<?= validation_errors(); ?>
	<?= form_open('items/add'); ?>
	<?php var_dump($categories); ?>

		  <div class="form-group">
		    <label for="name">Item Name</label>
		    <input name="name" type="text" class="form-control" id="name" placeholder="Item Name">
		  </div>

		  <div class="form-group">
		    <label for="subject">Subject (for emails)</label>
		    <input name="subject" type="text" class="form-control" id="subject" placeholder="Subject (for emails)">
		  </div>

		  <div class="form-group">
		    <label for="description">Description (this will be the body for emails)</label>
		    <textarea name="description" id="description" class="form-control"></textarea>
		  </div>

		  <div class="form-group">
		    <label for="category">Category</label>
		    <select name="category" id="category" class="form-control">
		    	<?php foreach ($categories as $value): ?>
		    		<option value="<?= $value['id']; ?>" ><?= $value['name']; ?></option>
		    	<?php endforeach ?>
		    </select>
		  </div>

		  <input type="hidden" name= "user_id" value="<?= $user_id; ?>">
		  <button type="submit" class="btn btn-default">Add</button>

		</form>