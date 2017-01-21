<div class="create-profile">
    <div class="action clearfix">
    </div>
    <h2 class="clearfix">Login</h2>

    <?=validation_errors()?>
    <?=form_open('login')?>
    <ul>
    <li class="clearfix">
        <span class="textbox">
        <input type="text" name="username" onfocus="if(this.value=='Username') this.value='';" onblur="if(this.value=='') this.value='Username';" value="Username" size="50"/>
        </span>
    </li>

    <li class="clearfix">
        <span class="textbox">
        <input type="password" name="password" onfocus="if(this.value=='Decision Title') this.value='';" onblur="if(this.value=='') this.value='Decision Title';" value="Password" />
        </span>
    </li>

    <li><div><input type="submit" value="Login"/></div></li>

    </ul>
    </form>



</div>
