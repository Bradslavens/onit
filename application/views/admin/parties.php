			  	<tr>
			  		<th>
			  			ID
			  		</th>
			  		<th>
			  			Party Type
			  		</th>
			  		<th>
			  			Edit
			  		</th>
			  		<th>
			  			Del
			  		</th>
			  		<th>
			  		</th>
			  	</tr>
			  	<?php foreach ($parties as $party): ?> 
			  	<tr>
					<!-- Enter form to add transaction name  -->
					<?php echo validation_errors(); ?>
					<?php $action = site_url('admin/index/'.strtolower($title).'/update_item'); ?>
					<?php echo form_open($action); ?>
				  		<td class="id"><?php echo $party['id']; ?></td>
				  		<td><input style="display:none;" name="name" type="text" class="show_form" value="<?php echo $party['name']; ?>"><span class="show_form"><?php echo $party['name']; ?></span></td>
				  		<td><a class="edit" href="#">Edit</a></td>
				  		<td><a class="del" href="#">Del</a></td>
				  		<td>
			  				<input type="hidden" name= "id" value = "<?php echo $party['id']; ?>"/>

			  				<input type= "submit" class = "show_form" style = "display: none;" value="Update">
				  		</td>
			  		</form>
			  	</tr>
			  	<?php endforeach; ?>