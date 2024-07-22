---[find]---
			Tzn::redirect('index.php');
---[replace]---
			if ($_REQUEST['elogin']) { header("Location: index.php?".$_SERVER['QUERY_STRING']); exit; }
			Tzn::redirect('index.php');
---[find]---
	<form action="login.php" method="post">
---[replace]---
	<form action="login.php<?php if ($_REQUEST['elogin']) echo "?".$_SERVER['QUERY_STRING']; ?>" method="post">