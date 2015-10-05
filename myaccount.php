<?php include 'includes/head.php'?>
<div class="content">
	
	<?php if (login_check($mysqli) !== false) : ?>
		<p>Welcome <?php echo htmlentities($_SESSION['username']); ?> (<?php echo login_check($mysqli) ?>)</p>

		
		<p> Update username: </p>
		<form action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" 
		method="post" 
		name="username_update_form">
		<select name="uid" id="uid" style="visibility: hidden;">
				<?php echo '<option value="', $_SESSION['user_id'], '"></option>'?>
				
			</select>
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
		<select name="uid" id="uid" style="visibility: hidden;">
				<?php echo '<option value="', $_SESSION['user_id'], '"></option>'?>
				
			</select>
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
		<select name="uid" id="uid" style="visibility: hidden;">
				<?php echo '<option value="', $_SESSION['user_id'], '"></option>'?>
				
			</select>
			Current Password <input type="password" name="password" id="password"/><br>
            New Password: <input type="password"
			name="updatepassword" 
			id="updatepassword"/><br>
            Confirm New Password: <input type="password" 
			name="updateconfirmpwd" 
			id="updateconfirmpwd" /><br>
            <input type="button" 
			value="Reset Password" 
			onclick="return pw2formhash(this.form,this.form.uid,this.form.password,
			this.form.updatepassword,
			this.form.updateconfirmpwd);" /> 
		</form>
		<?php
        if (isset($_GET['error'])) {
            echo '<p class="error">Current password incorrect, please try again.</p>';
        }
        ?> 
		
        <?php else : ?>
		<p>
			<span class="error">You are not authorised to access this page.</span> Please <a href="login.php">login</a>.
		</p>
        <?php endif; ?>
		

</div>

<?php include 'includes/footer.php'?>