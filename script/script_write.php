<script language="javascript">
 function unlock()
 {
  check_attack.check.value=0;
 }

 function check_submit()
 {
  if(document.check_attack.check.value==1)
  {
   alert('글쓰기 버튼을 여러번 누르시면 안됩니다');
   return false;
  }
<?php if($setup['use_category']) { ?>
  var myindex=document.write.category[1].selectedIndex;
  if (myindex<1)
  {
   alert('카테고리를 선택하여 주십시요');
   return false;
  }
<?php } ?>


<?php if(!$member['no']) { ?>

  if(!document.write.password.value)
  {
   alert('암호를 입력하여 주세요.\n\n암호를 입력하셔야 수정/삭제를 할수 있습니다');
   document.write.password.focus();
   return false;
  }

  if(!document.write.name.value)
  {
   alert('이름을 입력하여 주세요.');
   document.write.name.focus();
   return false;
  }

<?php } ?>

  if(!document.write.subject.value)
  {
   alert('제목을 입력하여 주세요.');
   document.write.subject.focus();
   return false;
  }

  if(!document.write.memo.value)
  {
   alert('내용을 입력하여 주세요.');
   document.write.memo.focus();
   return false;
  }

  document.check_attack.check.value=1;
  show_waiting();
  hideImageBox();

  return true;
 }

 var imageBoxHandler;
 function showImageBox(id) {
  imageBoxHandler= window.open("image_box.php?id="+id,"imageBox","width=600,height=540,resizable=yes,scrollbars=yes,toolbars=no");
 }

 function hideImageBox() {
  if(imageBoxHandler) {
   if(imageBoxHandler != 'undefined') {
    if(imageBoxHandler.closed==false) imageBoxHandler.close();
   }
  }
 }

 function view_preview() {
	document.write.action = "view_preview.php";
	document.write.target = "_blank";
	document.write.submit();
	document.write.action = "write_ok.php";
	document.write.target = "_self";
 }

 function check_use_html(obj) {
 	var c_n;
	if(!obj.checked) {
		obj.value=1;
	} else {
		c_n = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
		if(c_n) {
			obj.value=1;
		} else {
			obj.value=2;
		}
	}
 }

 function show_waiting() {
  var _x = document.body.clientWidth/2 + document.body.scrollLeft - 145;
  var _y = document.body.clientHeight/2 + document.body.scrollTop - 44;
  zb_waiting.style.posLeft=_x;
  zb_waiting.style.posTop=_y;
  zb_waiting.style.visibility='visible';
 }

 function hide_waiting() {
  zb_waiting.style.visibility='hidden';
  check_attack.check.value=0;
 }

</script>
<form name=check_attack><input type=hidden name=check value=0></form>
<div id='zb_waiting' style='position:absolute; left:0; right:0; top:0; bottom:0; margin:auto; width:292; height: 91; z-index:1; visibility: hidden'>
<table border=0 width=98% cellspacing=1 cellpadding=0 bgcolor=black>
<form name=waiting_form>
<tr bgcolor=white>
	<td>
	<table border=0 cellspacing=0 cellpadding=0 width=100%>
	<tr>
		<td><img src=images/waiting_left.gif border=0></td>
		<td><img src=images/waiting_top.gif border=0><br><img src=images/waiting_text.gif></td>
	</tr>
	</table>
	</td>
</tr>
</form>
</table>
</div>
