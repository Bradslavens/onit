	<?= validation_errors(); ?>
	<?= form_open('categories/add'); ?>

		  <div class="form-group">
		    <label for="first_name">First Name</label>
		    <input name="first_name" type="text" class="form-control" id="first_name" placeholder="First Name">
		  </div>

		  <div class="form-group">
		    <label for="mi">MI</label>
		    <input name="mi" type="text" class="form-control" id="mi" placeholder="MI">
		  </div>

		  <div class="form-group">
		    <label for="last_name">Last Name</label>
		    <input name="last_name" type="text" class="form-control" id="last_name" placeholder="last Name">
		  </div>

		  <div class="form-group">
		    <label for="company">Company</label>
		    <input name="company" type="text" class="form-control" id="company" placeholder="Company">
		  </div>

		  <div class="form-group">
		    <label for="email">Email</label>
		    <input name="email" type="email" class="form-control" id="email" placeholder="jane.doe@example.com">
		  </div>

		  <input type="hidden" name= "user_id" value="<?= $user_id; ?>">
		  <button type="submit" class="btn btn-default">Add</button>

		</form>