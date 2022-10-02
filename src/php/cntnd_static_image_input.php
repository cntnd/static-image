?><?php
// cntnd_static_image_input
$cntnd_module = "cntnd_static_image";

// includes
cInclude('module', 'includes/class.cntnd_static_image.php');
cInclude('module', 'includes/script.cntnd_static_image.php');
cInclude('module', 'includes/style.cntnd_static_image.php');

// input/vars
$selectedDir = "CMS_VALUE[1]";
$selectedImage = "CMS_VALUE[2]";
$image_disabled = "";
if (empty($selectedDir)) {
    $image_disabled = "disabled";
}
$fancyboxGroup = "CMS_VALUE[3]";
$fancyboxThumb = (bool) "CMS_VALUE[4]";
$fancyboxPath = "CMS_VALUE[5]";
$fancybox = (bool) "CMS_VALUE[10]";
$class = "CMS_VALUE[20]";

// other vars
$uuid = rand();
$static_image = new Cntnd\StaticImage\CntndStaticImage($lang, $client);

?>
<div class="form-vertical">
    <?php
    if (empty($selectedDir)){
        echo '<div class="cntnd_alert cntnd_alert-primary">';
        echo mi18n("NO_FOLDER");
        echo '</div>';
    }
    ?>

    <div class="form-group">
        <label for="folder_<?= $uuid ?>"><?= mi18n("FOLDER") ?></label>
        <select name="CMS_VAR[1]" id="folder_<?= $uuid ?>" size="1">
            <option value="false"><?= mi18n("SELECT_CHOOSE") ?></option>
            <?php
            foreach ($static_image->folders() as $folder) {
                $selected = "";
                if ($selectedDir == $folder) {
                    $selected = 'selected="selected"';
                }
                echo '<option value="' . $folder . '" ' . $selected . '>' . $folder . '</option>';
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="image_<?= $uuid ?>"><?= mi18n("IMAGE") ?></label>
        <select name="CMS_VAR[2]" id="image_<?= $uuid ?>" size="1" <?= $image_disabled ?>>
            <option value="false"><?= mi18n("SELECT_CHOOSE") ?></option>
            <?php
            if (!empty($selectedDir)) {
                foreach ($static_image->images($selectedDir) as $image) {
                    $selected = "";
                    if ($selectedImage == $image) {
                        $selected = 'selected="selected"';
                    }
                    echo '<option value="' . $image . '" ' . $selected . '>' . $image . '</option>';
                }
            }
            ?>
        </select>
    </div>

    <fieldset>
        <legend>Fancybox</legend>

        <div class="form-check form-check-inline">
            <input id="fancybox_<?= $uuid ?>" class="form-check-input" type="checkbox" name="CMS_VAR[10]" value="true" <?php if($fancybox){ echo 'checked'; } ?> />
            <label for="fancybox_<?= $uuid ?>"><?= mi18n("FANCYBOX") ?></label>
        </div>

        <div class="form-group">
            <label for="fancybox_group_<?= $uuid ?>"><?= mi18n("FANCYBOX_GROUP") ?></label>
            <input id="fancybox_group_<?= $uuid ?>" name="CMS_VAR[3]" type="text" value="<?= $fancyboxGroup ?>" />
        </div>

        <div class="form-check form-check-inline">
            <input id="fancybox_<?= $uuid ?>" class="form-check-input" type="checkbox" name="CMS_VAR[4]" value="true" <?php if($fancyboxThumb){ echo 'checked'; } ?> />
            <label for="fancybox_<?= $uuid ?>"><?= mi18n("FANCYBOX_THUMB") ?></label>
        </div>

        <div class="form-group">
            <label for="fancybox_path_<?= $uuid ?>"><?= mi18n("FANCYBOX_PATH") ?></label>
            <input id="fancybox_path_<?= $uuid ?>" name="CMS_VAR[5]" type="text" value="<?= $fancyboxPath ?>" />
        </div>
    </fieldset>

    <fieldset>
        <legend><?= mi18n("ADDITIONAL_CLASS") ?></legend>

        <div class="form-group">
            <label for="additional_class_<?= $uuid ?>"><?= mi18n("CSS_CLASS") ?></label>
            <input id="additional_class_<?= $uuid ?>" name="CMS_VAR[20]" type="text" value="<?= $class ?>" />
        </div>
    </fieldset>
</div>
<?php
