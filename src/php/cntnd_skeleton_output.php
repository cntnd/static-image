<?php
// cntnd_SKELETON_output

// includes
cInclude('module', 'includes/class.cntnd_SKELETON.php');

// assert framework initialization
defined('CON_FRAMEWORK') || die('Illegal call: Missing framework initialization - request aborted.');

// editmode
$editmode = cRegistry::isBackendEditMode();

// input/vars
$truncate = (bool) "CMS_VALUE[1]";
$lines = (int) "CMS_VALUE[2]";
if (empty($lines)){
  $lines = 5;
}
$own_js = (bool) "CMS_VALUE[3]";
$selectedDir = "CMS_VALUE[4]";

// other vars
$text = "CMS_HTML[1]";
$SKELETON = new Cntnd\Skeleton\CntndSkeleton($lang, $client);

// module
if ($editmode){
	echo '<div class="content_box"><label class="content_type_label">'.mi18n("MODULE").'</label>';
}

$tpl = cSmartyFrontend::getInstance();
$tpl->assign('truncate', $truncate);
$tpl->assign('uuid', 'idart'.$idart);
$tpl->assign('text', $text);
$tpl->display('default.html');

if ($editmode){
  echo '</div>';
}
?>
