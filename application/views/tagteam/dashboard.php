<?=validation_errors(); ?>

<h2>Dashboard</h2>

<div class="create-profile">
<?php if ($this->session->flashdata('tagteam_message')) {
	echo "<h3>" . $this->session->flashdata('tagteam_message') . "</h3>";
} ?>
	<?=form_open('beta/tagteamInvite'); ?>
        <ul>
        	<li>
            	Add an e-mail to the invite queue. You can then let the user log in with their e-mail address and password 'choicr123' to set up their account.
            </li>
        	<li>
              	<input type="text" onfocus="if(this.value=='Email address') this.value='';" onblur="if(this.value=='') this.value='Email address';" name="email" />
			</li>      
            <li>
              <input type="submit" class="submit-btn" />
            </li> 
        </ul>
    </form>
</div>