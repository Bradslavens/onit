<div id="contacts" class="container">
	<div class="panel panel-default">
	  <!-- Default panel contents -->
	  <div class="panel-heading">Transaction Contacts</div>

	  <!-- Table -->
	  <table class="table">
	      <tr>
	        <td colspan="7">
	          <a id = "add_item" href="#">+Contacts</a>
	          <div id = "contact" >

				<!-- Enter form to add transaction name  -->
				<?php echo validation_errors(); ?>

				<?php echo form_open('tran/contacts/add'); ?>

					<!-- NAME AND EMAIL  -->
					<div class="form-group">
					    <label  for="first_name">First Name</label>
					    <input autocomplete="off" id="first_name" name="first_name" type="text" class="form-control" id="first_name" placeholder="First Name">
					</div>
					<div id="search_item_results">
					</div>

					<div class="form-group">
					    <label  for="mi">MI</label>
					    <input autocomplete="off" id="mi" name="mi" type="text" class="form-control" id="mi" placeholder="MI">
					</div>

					<div class="form-group">
					    <label for="last_name">Last Name</label>
					    <input name="last_name" type="text" class="form-control" id="last_name" placeholder="Last Name">
					</div>

					<div class="form-group">
					    <label  for="company">Company</label>
					    <input autocomplete="off" id="company" name="company" type="text" class="form-control" id="company" placeholder="Company">
					</div>

					<div class="form-group">
					    <label for="email">Email address</label>
					    <input name="email" type="email" class="form-control" id="email" placeholder="Email">
					</div>

	                <div class="form-group">
	                  <label for="party">Select this contacts role: </label>
	                  <select name="party" class="form-control">
	                    <?php foreach ($contact_types as $party): ?> 
	                      <option value ="<?php echo $party['id'];?>"><?php echo $party['name']; ?></option>  
	                    <?php endforeach; ?>
	                  </select>
	                </div>

						<!-- SUBMIT 	 -->
				    <button type="submit" class="btn btn-default">Submit</button>

				    <a class="btn btn-default" href="add_reminders">Next</a>
			    </form>	
	          	
	          </div>
	        </td>
	      </tr>
	  	
	  </table>
	</div>
</div>