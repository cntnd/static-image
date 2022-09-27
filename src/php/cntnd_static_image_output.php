<?php
// cntnd_static_image_output

// includes
cInclude('module', 'includes/class.cntnd_static_image.php');

// assert framework initialization
defined('CON_FRAMEWORK') || die('Illegal call: Missing framework initialization - request aborted.');

// editmode
$editmode = cRegistry::isBackendEditMode();

// input/vars
$selectedDir = "CMS_VALUE[1]";
$selectedImage = "CMS_VALUE[2]";
$fancyboxGroup = "CMS_VALUE[3]";
$fancyboxThumb = (bool) "CMS_VALUE[4]";
$fancyboxPath = "CMS_VALUE[5]";
$fancybox = (bool) "CMS_VALUE[10]";
$class = "CMS_VALUE[20]";

// other vars
$static_image = new Cntnd\StaticImage\CntndStaticImage($lang, $client);

// module
if ($editmode){
	echo '<div class="content_box"><label class="content_type_label">'.mi18n("MODULE").'</label>';
}

if (!empty($selectedDir) && !empty($selectedImage)) {
    $tpl = cSmartyFrontend::getInstance();
    $tpl->assign('image', $static_image->image($selectedImage, $selectedDir));
    $tpl->assign('fancybox', $fancybox);
    $tpl->assign('fancyboxGroup', $fancyboxGroup);
    $tpl->assign('additionalClass', $class);
    $tpl->display('default.html');
}

if ($editmode){
  echo '</div>';
}
?>
