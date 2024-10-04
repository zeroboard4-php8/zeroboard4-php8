<?php 
if(ereg("://",$dir)) die();

if($is_admin || ($member['level']<=$setup['grant_html']) ||  $setup['use_html'] == 2) {
    $aTagGrant = true;
    $imgTagGrant = true;
} elseif($setup['use_html'] == 1) {
    $avoid = explode(',',str_replace(' ','',$setup['avoid_tag']));
    if(in_array('a',$avoid)) $aTagGrant = true;
    if(in_array('img',$avoid)) $imgTagGrant = true;
}

if($_SS['upload_number'] === '') $_SS['upload_number'] = 0;

// 플래쉬업로더에서 발생한 임시파일 삭제
function delete_UnUsedFiles($path,$hour)
{
  if(!is_dir($path)) return false;
  
  $ExpireTime  = time() - ($hour*3600); // 30분 이전에 생성된 파일들
  $directory = dir($path);

  while($entry = $directory->read()) :
    if ($entry != "." && $entry != "..") {
      if (is_dir($path.$entry)) getExpireTempFiles($path.$entry);
      elseif (filectime($path.$entry) < $ExpireTime){
        z_unlink($path.'/'.$entry);
      }
    }
  endwhile;
}
delete_UnUsedFiles('data/__DQ_Revolution_MultiUpload_TempDir__/',1);
?>
<table border="0" width="100%" cellspacing="0" cellpadding="0" style="table-layout:fixed">
<col width="<?=$_leftframe_width?>px"></col><col align="left"></col>
<tr>
  <td valign="top">
    <div width="<?=$_leftframe_width?>" align="right" style="height:100%;padding:23px 10px 0 0;line-height:180%;" class="han">
    <?=$_strSkin['file']?>
    </div>
  </td>
  <td>
    <div id="content">
        <ul id="swuThumbnails"></ul>
        <div id="swuCommentInputFrame">
            <div id="swuCommentTitle"><?=$_strSkin['swuCommentInsert']?></div>
            <div><textarea type="text" id="swu_descript" name="swu_descript" style="width:40em;height:6em"></textarea></div>
            <div align="center">
              <button id="swuDescriptConfirm"><?=$_strSkin['swuCommentConfirm']?></button>
              <button id="swuDescriptCancel"><?=$_strSkin['swuCommentCancel']?></button>
            </div>
        </div>
        <div id="swuInfoContain">
            <div id="swuBtnBrowse">
              <span id="spanButtonPlaceholder"></span>
            </div>
            <div>
            <div id="download_guide">
              <?php 
              if(!empty($_SS['upload_number'])) $_strSkin['up_size'] = str_replace('[count]','<font class=han2>'.$_SS['upload_number'].'</font>',$_strSkin['up_size']);
              else $_strSkin['up_size'] = $_strSkin['up_size_ul'];
              ?>
              <?=str_replace('[size]','<font class=han2>'.getFileSize($setup['max_upload_size']).'</font>',$_strSkin['up_size'])?>
              <?php if(empty($_SS['using_imageUpOnly'])) echo '<br />'.$_strSkin['download_guide']?>
            </div>
            </div>
            <div id="divFileProgressContainer">
              <fieldset class="flash" id="fsUploadProgress">
                <legend><?=$_strSkin['standby']?></legend>
                <div id="divStatus">0 file uploaded.</div>
              </fieldset>
            </div>
			<div>
			  <input type="checkbox" name="use_thumbimg"<?php if(get_StrValue($sitelink2,1)) echo " checked"?>><?=$_strSkin['use_thumbImgOnly']?>
			</div>            
        </div>
    </div>
  </td>
</tr></table>

<link href="<?=$_css_dir?>swfu.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=$dir?>/plug-ins/swfupload/swfupload.js"></script>
<script type="text/javascript" src="<?=$dir?>/plug-ins/swfupload/swfupload.queue.js"></script>
<script type="text/javascript" src="<?=$dir?>/plug-ins/swfupload/fileprogress.js"></script>
<script type="text/javascript" src="<?=$dir?>/plug-ins/swfupload/handlers.js"></script>
<script type="text/javascript" src="<?=$dir?>/dragsort.js"></script>
<script type="text/javascript">
  var swfu;
  var dragsort   = ToolMan.dragsort();
  var junkdrawer = ToolMan.junkdrawer();

  window.onload = function() {
    var settings = {
      flash_url : "<?=$dir?>/plug-ins/swfupload/swfupload.swf",
      upload_url: "<?=$dir?>/plug-ins/swfupload/upload.php?query=<?=session_id()?>",
      file_size_limit : "<?=getFileSize($setup['max_upload_size'])?>",
<?php if(!empty($_SS['using_imageUpOnly'])) { ?>
      file_types : "*.jpg;*.jpeg;*.gif;*.png;*.bmp",
      file_types_description : "Image Files",
<?php } else {?>
      file_types : "*.*",
      file_types_description : "All Files",
<?php } ?>
      file_upload_limit : 100,
      file_queue_limit : <?=$_SS['upload_number']?>,
      custom_settings : {
          progressTarget : "fsUploadProgress",
          cancelButtonId : "btnSwfuCancel"
      },
      debug: false,

      file_queued_handler : fileQueued,
      file_queue_error_handler : fileQueueError,
      file_dialog_complete_handler : fileDialogComplete,
      upload_start_handler : uploadStart,
      upload_progress_handler : uploadProgress,
      upload_error_handler : uploadError,
      upload_success_handler : uploadSuccess,
      upload_complete_handler : uploadComplete,
      queue_complete_handler : queueComplete,
      button_image_url : "<?=$dir?>/plug-ins/swfupload/images/XPButtonNoText_130x26.png",
	  button_text : '<?=$_strSkin['swuFileBrowse']?>',
      button_placeholder_id : "spanButtonPlaceholder",
      button_width: 130,
      button_height: 26,
      button_text_top_padding: 3,
      button_text_left_padding: 10,
      button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
      button_cursor: SWFUpload.CURSOR.HAND,
      button_text_align: 'center'
    };

    swfu = new SWFUpload(settings);

    swu.aTagGrant   = "<?=($aTagGrant ? 1 : 0)?>";
    swu.imgTagGrant = "<?=($imgTagGrant ? 1 : 0)?>";

    swu.addFiles();
    dragsort.makeListSortable(document.getElementById("swuThumbnails"));
  };

  document.getElementById('swuDescriptConfirm').onclick = function() {
    var src   = document.getElementById('swu_descript');
    var field = document.zbform.file_descript;
    swu.uploadFilesDescript[swu.commentPosition] = src.value;
    field.value = swu.uploadFilesDescript.join("||");
    document.getElementById('swuCommentInputFrame').style.display="none";
    return false;
  }

  document.getElementById('swuDescriptCancel').onclick = function() {
    var src   = document.getElementById('swu_descript');
    var field = document.zbform.file_descript;
    try
    {
      src.value = swu.uploadFilesDescript[swu.commentPosition].value;
      document.getElementById('swuCommentInputFrame').style.display="none";
    }
    catch (e)
    {
      document.getElementById('swuCommentInputFrame').style.display="none";
      return false;
    }
  }
</script>
