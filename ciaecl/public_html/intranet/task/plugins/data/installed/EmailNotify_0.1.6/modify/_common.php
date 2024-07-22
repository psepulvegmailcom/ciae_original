---[find]---
			// user is not logged in and tries to access private page
---[replace]---
			// user is not logged in and tries to access private page
			if ($_REQUEST['elogin']) { header("Location: login.php?".$_SERVER['QUERY_STRING']); exit; }