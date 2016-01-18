 <script type="text/javascript">
        window._wpemojiSettings = {
            "baseUrl": "http:\/\/s.w.org\/images\/core\/emoji\/72x72\/",
            "ext": ".png",
            "source": {
                "concatemoji": "http:\/\/ninetheme.com\/themes\/signature\/wp-includes\/js\/wp-emoji-release.min.js?ver=4.3.2"
            }
        };
        ! function(a, b, c) {
            function d(a) {
                var c = b.createElement("canvas"),
                    d = c.getContext && c.getContext("2d");
                return d && d.fillText ? (d.textBaseline = "top", d.font = "600 32px Arial", "flag" === a ? (d.fillText(String.fromCharCode(55356, 56812, 55356, 56807), 0, 0), c.toDataURL().length > 3e3) : (d.fillText(String.fromCharCode(55357, 56835), 0, 0), 0 !== d.getImageData(16, 16, 1, 1).data[0])) : !1
            }

            function e(a) {
                var c = b.createElement("script");
                c.src = a, c.type = "text/javascript", b.getElementsByTagName("head")[0].appendChild(c)
            }
            var f, g;
            c.supports = {
                simple: d("simple"),
                flag: d("flag")
            }, c.DOMReady = !1, c.readyCallback = function() {
                c.DOMReady = !0
            }, c.supports.simple && c.supports.flag || (g = function() {
                c.readyCallback()
            }, b.addEventListener ? (b.addEventListener("DOMContentLoaded", g, !1), a.addEventListener("load", g, !1)) : (a.attachEvent("onload", g), b.attachEvent("onreadystatechange", function() {
                "complete" === b.readyState && c.readyCallback()
            })), f = c.source || {}, f.concatemoji ? e(f.concatemoji) : f.wpemoji && f.twemoji && (e(f.twemoji), e(f.wpemoji)))
        }(window, document, window._wpemojiSettings);
    </script>
    <style type="text/css">
        img.wp-smiley,
        img.emoji {
            display: inline !important;
            border: none !important;
            box-shadow: none !important;
            height: 1em !important;
            width: 1em !important;
            margin: 0 .07em !important;
            vertical-align: -0.1em !important;
            background: none !important;
            padding: 0 !important;
        }
    </style>
    <link rel='stylesheet' id='contact-form-7-css' href='http://ninetheme.com/themes/signature/wp-content/plugins/contact-form-7/includes/css/styles.css?ver=4.3.1' type='text/css' media='all' />
    <link rel='stylesheet' id='ninetheme_signature_cssbootstrap-css' href='http://ninetheme.com/themes/signature/wp-content/themes/signature/css/main.min.css?ver=1.0' type='text/css' media='all' />
    <link rel='stylesheet' id='ninetheme_signature_awesome-css' href='http://ninetheme.com/themes/signature/wp-content/themes/signature/css/custom.css?ver=1.0' type='text/css' media='all' />
    <link rel='stylesheet' id='ninetheme_signature_wordpress-style-css' href='http://ninetheme.com/themes/signature/wp-content/themes/signature/css/wordpress.css?ver=1.0' type='text/css' media='all' />
    <link rel='stylesheet' id='ninetheme_signature_flexslidercss-css' href='http://ninetheme.com/themes/signature/wp-content/themes/signature/css/flexslider.css?ver=1.0' type='text/css' media='all' />
    <link rel='stylesheet' id='ninetheme_signature_fonts-load-css' href='//fonts.googleapis.com/css?family=Open%2BSans%7CLato%7CRoboto%3A700%2C300%2C600%2C400%2C500&#038;ver=1.0.0' type='text/css' media='all' />
    <link rel='stylesheet' id='style-css' href='http://ninetheme.com/themes/signature/wp-content/themes/signature/style.css?ver=4.3.2' type='text/css' media='all' />
    <link rel='stylesheet' id='js_composer_front-css' href='//ninetheme.com/themes/signature/wp-content/uploads/js_composer/js_composer_front_custom.css?ver=4.8.1' type='text/css' media='all' />
    <script type='text/javascript' src='http://ninetheme.com/themes/signature/wp-includes/js/jquery/jquery.js?ver=1.11.3'></script>
    <script type='text/javascript' src='http://ninetheme.com/themes/signature/wp-includes/js/jquery/jquery-migrate.min.js?ver=1.2.1'></script>
    <link rel="EditURI" type="application/rsd+xml" title="RSD" href="http://ninetheme.com/themes/signature/xmlrpc.php?rsd" />
    <link rel="wlwmanifest" type="application/wlwmanifest+xml" href="http://ninetheme.com/themes/signature/wp-includes/wlwmanifest.xml" />
    <meta name="generator" content="WordPress 4.3.2" />
    <link rel='canonical' href='http://ninetheme.com/themes/signature/' />
    <link rel='shortlink' href='http://ninetheme.com/themes/signature/' />
<?php
/*
  Version: 2.0.2
http:// .com
*/

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Prevent the user visiting the logged in page if he/she is already logged in
if(isUserLoggedIn()) { header("Location: account.php"); die(); }

//Forms posted
if(!empty($_POST))
{
	$errors = array();
	$username = sanitize(trim($_POST["username"]));
	$password = trim($_POST["password"]);
	
	//Perform some validation
	//Feel free to edit / change as required
	if($username == "")
	{
		$errors[] = lang("ACCOUNT_SPECIFY_USERNAME");
	}
	if($password == "")
	{
		$errors[] = lang("ACCOUNT_SPECIFY_PASSWORD");
	}

	if(count($errors) == 0)
	{
		//A security note here, never tell the user which credential was incorrect
		if(!usernameExists($username))
		{
			$errors[] = lang("ACCOUNT_USER_OR_PASS_INVALID");
		}
		else
		{
			$userdetails = fetchUserDetails($username);
			//See if the user's account is activated
			if($userdetails["active"]==0)
			{
				$errors[] = lang("ACCOUNT_INACTIVE");
			}
			else
			{
				//Hash the password and use the salt from the database to compare the password.
				$entered_pass = generateHash($password,$userdetails["password"]);
				
				if($entered_pass != $userdetails["password"])
				{
					//Again, we know the password is at fault here, but lets not give away the combination incase of someone bruteforcing
					$errors[] = lang("ACCOUNT_USER_OR_PASS_INVALID");
				}
				else
				{
					//Passwords match! we're good to go'
					
					//Construct a new logged in user object
					//Transfer some db data to the session object
					$loggedInUser = new loggedInUser();
					$loggedInUser->email = $userdetails["email"];
					$loggedInUser->user_id = $userdetails["id"];
					$loggedInUser->hash_pw = $userdetails["password"];
					$loggedInUser->title = $userdetails["title"];
					$loggedInUser->displayname = $userdetails["display_name"];
					$loggedInUser->username = $userdetails["user_name"];
					
					//Update last sign in
					$loggedInUser->updateLastSignIn();
					$_SESSION[" User"] = $loggedInUser;
					
					//Redirect to user account page
					header("Location: account.php");
					die();
				}
			}
		}
	}
}

require_once("models/header.php");

echo "
<body>
<div id='wrapper'>
<div id='top'><div id='logo'></div></div>
<div id='content'>
<h1> </h1>
<h2>Login</h2>
<div id='left-nav'>";

include("left-nav.php");

echo "
</div>
<div id='main'>";

echo resultBlock($errors,$successes);

echo "
<div id='regbox'>
<form name='login' class='wpcf7-form' action='".$_SERVER['PHP_SELF']."' method='post'>
<p>

<span class='wpcf7-form-control-wrap text'><input type='text' 
size='40' class='wpcf7-form-control wpcf7-text wpcf7-validates-as-required c-12' aria-invalid='false' placeholder='Username' aria-required='true' name='username' /></span>
</p>
<p>
<label>Password:</label>
<input type='password' name='password' />
</p>
<p>
<label>&nbsp;</label>
<input type='submit' value='Login' class='submit' />
</p>
</form>
</div>
</div>
<div id='bottom'></div>
</div>
</body>
</html>";

?>
