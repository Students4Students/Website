<?php include '/includes/head.php'?>

<div class="content">
        <?php if (login_check($mysqli) == "admin") : ?>
		<p>Welcome <?php echo htmlentities($_SESSION['username']); ?> (<?php echo login_check($mysqli) ?>)</p>
		Number of users: <?php echo get_number_of_users($mysqli)?><br>
		
		<p><a href="register.php">Add a new user</a></p>
		
		
		<p> Update username: </p>
		<form action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" 
		method="post" 
		name="username_update_form">
			User to update: <select name="uid" id="uid">
				<?php for ($i = 1; $i <= get_number_of_users($mysqli); $i++) {
					$username = get_username($mysqli, $i);
					echo '<option value="', $i, '">', $username,'</option>';
				}?>
				
			</select><br>
            Username: <input type='text' 
			name='usernameupdate' 
			id='usernameupdate' />
            <input type="button" 
			value="Update Username" 
			onclick="return userformhash(this.form,this.form.uid,
			this.form.usernameupdate);" /> 
		</form>
		
		<p> Update email:</p>
		<form action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" 
		method="post" 
		name="email_update_form">
		User to update: <select name="uid" id="uid">
				<?php for ($i = 1; $i <= get_number_of_users($mysqli); $i++) {
					$username = get_username($mysqli, $i);
					echo '<option value="', $i, '">', $username,'</option>';
				}?>
				
			</select><br>
            Email: <input type="text" name="emailupdate" id="emailupdate" />
            <input type="button" 
			value="Update Email" 
			onclick="return emailformhash(this.form,this.form.uid,
			this.form.emailupdate);" /> 
		</form>
		
		<p> Reset password:</p>
		<form action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" 
		method="post" 
		name="password_update_form">
		User to update: <select name="uid" id="uid">
				<?php for ($i = 1; $i <= get_number_of_users($mysqli); $i++) {
					$username = get_username($mysqli, $i);
					echo '<option value="', $i, '">', $username,'</option>';
				}?>
				
			</select><br>
            Password: <input type="password"
			name="updatepassword" 
			id="updatepassword"/><br>
            Confirm password: <input type="password" 
			name="updateconfirmpwd" 
			id="updateconfirmpwd" /><br>
            <input type="button" 
			value="Reset Password" 
			onclick="return pwformhash(this.form,this.form.uid,
			this.form.updatepassword,
			this.form.updateconfirmpwd);" /> 
		</form>
		
		<p> Update permissions:</p>
		<form action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" 
		method="post" 
		name="email_update_form">
		User to update: <select name="uid" id="uid">
				<?php for ($i = 1; $i <= get_number_of_users($mysqli); $i++) {
					$username = get_username($mysqli, $i);
					echo '<option value="', $i, '">', $username,'</option>';
				}?>
				
			</select><br>
            Permission <select name="type" id="type">
			<option value="tutor">Tutor</option>
			<option value="admin">Admin</option>
			<option value="blog">Blog</option>
			</select>
            <input type="button" 
			value="Update" 
			onclick="return typeformhash(this.form,this.form.uid,
			this.form.type);" /> 
		</form>
		
        <?php else : ?>
		<p>
			<span class="error">You are not authorised to access this page.</span> Please <a href="login.php">login</a>.
		</p>
        <?php endif; ?>
		
		</div>
<?php include '/includes/footer.php'?>