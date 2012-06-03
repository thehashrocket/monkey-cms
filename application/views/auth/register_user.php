<div id="content" class="row">
    <div class="twelve columns">
    <div class='mainInfo'>

	<h1>Create User</h1>
	<p>Please enter the users information below.</p>
	
	<div id="infoMessage"><?php echo $message;?></div>
	
    <?php echo form_open("auth/register",'class="nice"');?>
      <p>First Name:<br />
      <?php echo form_input($first_name,'','class="input-text"');?>
      </p>
      
      <p>Last Name:<br />
      <?php echo form_input($last_name,'','class="input-text"');?>
      </p>
      
      <p>Company Name:<br />
      <?php echo form_input($company,'','class="input-text"');?>
      </p>
      
      <p>Email:<br />
      <?php echo form_input($email,'','class="input-text"');?>
      </p>
      
      <p>Phone:<br />
      <?php echo form_input($phone1);?>-<?php echo form_input($phone2);?>-<?php echo form_input($phone3);?>
      </p>
      
      <p>Password:<br />
      <?php echo form_input($password,'','class="input-text"');?>
      </p>
      
      <p>Confirm Password:<br />
      <?php echo form_input($password_confirm,'','class="input-text"');?>
      </p>
      
      
      <p><?php echo form_submit('submit', 'Create User');?></p>

      
    <?php echo form_close();?>

</div>
      </div>
    </div>