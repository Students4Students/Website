function formhash(form, password) {
    // Create a new element input, this will be our hashed password field. 
    var p = document.createElement("input");
 
    // Add the new element to our form. 
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);
 
    // Make sure the plaintext password doesn't get sent. 
    password.value = "";
 
    // Finally submit the form. 
    form.submit();
}
 
function regformhash(form, uid, email, password, conf) {
     // Check each field has a value
    if (uid.value == ''         || 
          email.value == ''     || 
          password.value == ''  || 
          conf.value == '') {
 
        alert('You must provide all the requested details. Please try again');
        return false;
    }
 
 
    // Check that the password is sufficiently long (min 6 chars)
    // The check is duplicated below, but this is included to give more
    // specific guidance to the user
    if (password.value.length < 6) {
        alert('Passwords must be at least 6 characters long.  Please try again');
        form.password.focus();
        return false;
    }
 
    // At least one number, one lowercase and one uppercase letter 
    // At least six characters 
 
    var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/; 
    if (!re.test(password.value)) {
        alert('Passwords must contain at least one number, one lowercase and one uppercase letter.  Please try again');
        return false;
    }
 
    // Check password and confirmation are the same
    if (password.value != conf.value) {
        alert('Your password and confirmation do not match. Please try again');
        form.password.focus();
        return false;
    }
 
    // Create a new element input, this will be our hashed password field. 
    var p = document.createElement("input");
 
    // Add the new element to our form. 
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);
 
    // Make sure the plaintext password doesn't get sent. 
    password.value = "";
    conf.value = "";
 
    // Finally submit the form. 
    form.submit();
    return true;
}



function userformhash(form, uid, username) {
     // Check each field has a value
    if (username.value == '') {
 
        alert('Please enter a new username');
        return false;
    }
  
    // Finally submit the form. 
    form.submit();
    return true;
}

function emailformhash(form, uid, email) {
     // Check each field has a value
    if (email.value == ''){
 
        alert('You must provide all the requested details. Please try again');
        return false;
    }
 
    // Finally submit the form. 
    form.submit();
    return true;
}


function typeformhash(form, uid, type) {
     // Check each field has a value
    if (type.value == ''){
 
        alert('You must provide all the requested details. Please try again');
        return false;
    }
 
    // Finally submit the form. 
    form.submit();
    return true;
}


function pwformhash(form, uid, password, conf) {
     // Check each field has a value
    if (password.value == '' || conf.value == '') {
 
        alert('You must provide all the requested details. Please try again');
        return false;
    }
 
 
    // Check that the password is sufficiently long (min 6 chars)
    // The check is duplicated below, but this is included to give more
    // specific guidance to the user
    if (password.value.length < 6) {
        alert('Passwords must be at least 6 characters long.  Please try again');
        form.password.focus();
        return false;
    }
 
    // At least one number, one lowercase and one uppercase letter 
    // At least six characters 
 
    var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/; 
    if (!re.test(password.value)) {
        alert('Passwords must contain at least one number, one lowercase and one uppercase letter.  Please try again');
        return false;
    }
 
    // Check password and confirmation are the same
    if (password.value != conf.value) {
        alert('Your password and confirmation do not match. Please try again');
        form.password.focus();
        return false;
    }
 
    // Create a new element input, this will be our hashed password field. 
    var pupdate = document.createElement("input");
 
    // Add the new element to our form. 
    form.appendChild(pupdate);
    pupdate.name = "pupdate";
    pupdate.type = "hidden";
    pupdate.value = hex_sha512(password.value);
 
    // Make sure the plaintext password doesn't get sent. 
    password.value = "";
    conf.value = "";
 
    // Finally submit the form. 
    form.submit();
    return true;
}




function pw2formhash(form, uid, oldpassword, newpassword, conf) {
     // Check each field has a value
    if (newpassword.value == '' || conf.value == '' || oldpassword.value == '') {
 
        alert('You must provide all the requested details. Please try again');
        return false;
    }
	
	var oldp = document.createElement("input");
 
    // Add the new element to our form. 
    form.appendChild(oldp);
    oldp.name = "oldp";
    oldp.type = "hidden";
    oldp.value = hex_sha512(oldpassword.value);
 
    // Make sure the plaintext password doesn't get sent. 
    oldpassword.value = "";
	
	
	

    // Check that the password is sufficiently long (min 6 chars)
    // The check is duplicated below, but this is included to give more
    // specific guidance to the user
    if (newpassword.value.length < 6) {
        alert('Passwords must be at least 6 characters long.  Please try again');
        form.newpassword.focus();
        return false;
    }
 
    // At least one number, one lowercase and one uppercase letter 
    // At least six characters 
 
    var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/; 
    if (!re.test(newpassword.value)) {
        alert('Passwords must contain at least one number, one lowercase and one uppercase letter.  Please try again');
        return false;
    }
 
    // Check password and confirmation are the same
    if (newpassword.value != conf.value) {
        alert('Your password and confirmation do not match. Please try again');
        form.newpassword.focus();
        return false;
    }
 
    // Create a new element input, this will be our hashed password field. 
    var newp = document.createElement("input");
 
    // Add the new element to our form. 
    form.appendChild(newp);
    newp.name = "newp";
    newp.type = "hidden";
    newp.value = hex_sha512(newpassword.value);
 
    // Make sure the plaintext password doesn't get sent. 
    newpassword.value = "";
    conf.value = "";
 
    // Finally submit the form. 
    form.submit();
    return true;
}