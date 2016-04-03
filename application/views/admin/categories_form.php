	<?= validation_errors(); ?>
	<?= form_open('categories/add'); ?>

		  <div class="form-group">
		    <label for="name">Category Name</label>
		    <input name="name" type="text" class="form-control" id="name" placeholder="Category Name">
		  </div>

		  <div class="form-group">
		    <label for="description">Short Description</label>
		    <input name="description" type="text" class="form-control" id="description" placeholder="Short Description">
		  </div>

		  <input type="hidden" name= "user_id" value="<?= $user_id; ?>">
		  <button type="submit" class="btn btn-default">Add</button>

		</form>