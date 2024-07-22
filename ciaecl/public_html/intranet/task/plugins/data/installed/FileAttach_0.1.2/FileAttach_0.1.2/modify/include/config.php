---[find]---
// === TASKFREAK CUSTOMIZATION ================================
---[replace]---
// === TASKFREAK CUSTOMIZATION ================================

// === FILE ATTACHMENT PLUGIN SETTINGS ========================
define(PLG_FILE_VER, "0.1.2");
define(PLG_FILE_TITLE, "FileAttach_".PLG_FILE_VER);
define(PLG_FILE_DIR, PRJ_ROOT_PATH."plugins/data/installed/".PLG_FILE_TITLE);
// your files store, write permissions required
define('FRK_ATTACHMENT_FOLDER', PRJ_ROOT_PATH.'files/'); 
// allow - only listed attachments can be uploaded, disallow - allow all except listed
define('FRK_ATTACHMENT_EXCLUSION', 'disallow');
// list of attachments to be included or excluded
define('FRK_ATTACHMENT_LIST', 'aspx,tmp,lnk');
// show notification message about the attachment settings
define('FRK_ATTACHMENT_NOTIFY', true);
// === FILE ATTACHMENT PLUGIN SETTINGS ========================