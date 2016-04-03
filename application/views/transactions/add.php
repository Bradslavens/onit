<div id="add_transaction" class="container">

	<h2><?php echo validation_errors(); ?></h2>

	<?php echo form_open('transaction/add'); ?>
  
	    <div class="form-group">
	      <label for="name">Name (aka address)</label>
	      <input type="text" class="form-control" name="name" id="name" placeholder="Transaction Name">
	    </div>
	    <button type="submit" class="btn btn-default">Submit</button>
	 </form>

	 
</div> <!-- container -->