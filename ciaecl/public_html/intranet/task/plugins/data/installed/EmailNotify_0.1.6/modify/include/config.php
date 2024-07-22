---[find]---
// === TASKFREAK CUSTOMIZATION ================================
---[replace]---
// === TASKFREAK CUSTOMIZATION ================================

// ~~~ EMAIL NOTIFICATION PLUGIN SETTINGS ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
define(PLG_EMAIL_VER, "0.1.6");
define(PLG_EMAIL_TITLE, "EmailNotify_".PLG_EMAIL_VER);
define(PLG_EMAIL_DIR, PRJ_ROOT_PATH."plugins/data/installed/".PLG_EMAIL_TITLE."/");
// sender identification, email address - default: taskfreak@yourdomain.com
define('PLG_EMAIL_FROM', "taskfreak@yourdomain.com"); 
// sender identification, name - default: TaskFreak! Management System
define('PLG_EMAIL_FROM_NAME', "TaskFreak! Management System"); 
// main recipient identification - default: taskfreak@yourdomain.com
define('PLG_EMAIL_TO', "taskfreak@yourdomain.com");
// recipients invisible to each other - if set to false PLG_EMAIL_TO is ignored
define('PLG_EMAIL_BCC', true);
// user who triggered the notification will receive the email
define('PLG_EMAIL_USER', true);
// only owner of the task will receive the email & the author if PLG_EMAIL_USER set to true
define('PLG_EMAIL_OWNER_ONLY', false);
// Swift sending options - for other settings edit Notify.php (SSL, TLS, Auth)
define('PLG_EMAIL_SWIFT', "sendmail");  // smtp, sendmail or phpmail
// Sendmail path - this is the default location on most linux systems
define('PLG_EMAIL_SENDMAIL', "/usr/sbin/sendmail -bs"); 
// SMTP server - required only if PLG_EMAIL_SWIFT is set to smtp
define('PLG_EMAIL_SERVER', "mail.yourdomain.com");
// SMTP server timeout - sometimes required for anti-spam delays
define('PLG_EMAIL_SERVER_TIMEOUT', 15);
// if your SMTP server requires authentification set PLG_EMAIL_SERVER_AUTH to true
define('PLG_EMAIL_SERVER_AUTH', false);
define('PLG_EMAIL_SERVER_USER', "name@yourdomain.com");
define('PLG_EMAIL_SERVER_PASS', "***");
// debug mode - will echo out all email info instead of sending
define('PLG_EMAIL_DEBUG', false);
// just to make sure u've read all the options - please set to true
define('PLG_EMAIL_ENABLED', false);
// ~~~ EMAIL NOTIFICATION PLUGIN SETTINGS ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
