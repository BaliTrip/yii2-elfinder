<?php
/**
 * @var \yii\web\View $this
 * @var array $options

 */
use mihaildev\elfinder\Assets;
use yii\helpers\Json;


Assets::register($this);
Assets::addLangFile($options['lang'], $this);

if(!empty($options['noConflict']))
	Assets::noConflict($this);

unset($options['noConflict']);
$options['soundPath'] = Assets::getSoundPathUrl();


$this->registerJs("
  var FileBrowserDialogue = {
    init: function() {
      // Here goes your code for setting your custom things onLoad.
    },
    mySubmit: function (file, elf) {
      // pass selected file data to TinyMCE
      parent.tinymce.activeEditor.windowManager.getParams().oninsert(file, elf);
      // close popup window
      parent.tinymce.activeEditor.windowManager.close();
    }
  }
function ElFinderGetCommands(disabled){
    var Commands = elFinder.prototype._options.commands;
    if (jQuery.inArray('*', Commands) === 0) {
        Commands = Object.keys(elFinder.prototype.commands);
    }
    jQuery.each(disabled, function(i, cmd) {
        (idx = jQuery.inArray(cmd, Commands)) !== -1 && Commands.splice(idx,1);
    });
    return Commands;
}

    var winHashOld = '';
    function elFinderFullScreen(){

        var width = jQuery(window).width()-(jQuery('#elfinder').outerWidth(true) - jQuery('#elfinder').width());
        var height = jQuery(window).height()-(jQuery('#elfinder').outerHeight(true) - jQuery('#elfinder').height());

        var el = jQuery('#elfinder').elfinder('instance');

        var winhash = jQuery(window).width() + '|' + jQuery(window).height();


        if(winHashOld == winhash)
            return;

        winHashOld = winhash;

        el.resize(width, height);
    }

    var elf = jQuery('#elfinder').elfinder(".Json::encode($options).").elfinder('instance');

    jQuery(window).resize(elFinderFullScreen);

    elFinderFullScreen();
    "/*, \yii\web\View::POS_LOAD*/);


$this->registerCss("
html, body {
    height: 100%;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    position: relative;
    padding: 0; margin: 0;
}
");




?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>elFinder 2.0</title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div id="elfinder"></div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
