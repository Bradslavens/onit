<ul>

	<?php foreach ($contacts as $value): ?>
		<li> <strong>First Name</strong> <?= $value['first_name'];  ?> <strong>Last Name</strong> <?= $value['last_name']; ?> <span>Email</span> <?= $value['email']; ?>  </li>
	<?php endforeach ?>

</ul>