<?php
	$memo = str_replace("<table border=0 cellspacing=0 cellpadding=0 width=100% style=\"table-layout:fixed;\"><col width=100%></col><tr><td valign=top>","<table border=0 cellspacing=0 cellpadding=0 width=100% style=\"table-layout:fixed;\"><col width=100%></col><tr><td class=\"xe_viewMemo\" id=\"view_mm\">",$memo);
	// 코멘트 개수의 [ ] 없애고
	$comment_num = str_replace("[","",$comment_num); 
	$comment_num = str_replace("]","",$comment_num); 
?>

<script type="text/javascript" language="JavaScript">
function pagePrint(Obj) { 
    var W = Obj.offsetWidth;        //screen.availWidth; 
    var H = Obj.offsetHeight;        //screen.availHeight; 
    var features = "menubar=no,toolbar=no,location=no,directories=no,status=no,scrollbars=yes,resizable=yes,width=" + W + ",height=" + H + ",left=0,top=0"; 
    var PrintPage = window.open("about:blank",Obj.id,features); 
    PrintPage.document.open(); 
    PrintPage.document.write("<html><head><title></title><style type='text/css'>body, tr, td, input, textarea { font-family:굴림; font-size:12px; }</style>\n</head>\n<body>" + Obj.innerHTML + "\n</body></html>"); 
    PrintPage.document.close(); 
    PrintPage.document.title = document.domain; 
    PrintPage.print(PrintPage.location.reload()); 
} 
</script>

<table class="xe_viewTb" width="<?=$width?>" cellSpacing="0" cellpadding="0">
<colgroup span="2"><col></col><col width="350px"></col></colgroup>
	<tr>
		<td class="xe_viewSj"><?=$subject?></td>
		<td class="xe_viewHit" align="right">조회수 : <span class="xe_viewDate"><?=number_format($hit)?>, <?=$date?></span>
			<?php if(($is_admin||$member['level']<=$setup['grant_delete']||$data['ismember']==$member['no']||!$data['ismember'])&&$no) {?>
			<a class="button" href="write.php?<?=$href?><?=$sort?>&no=<?=$no?>&mode=modify" title="수정"><span>수정</span></a>
			<?php }?>	<?php if(($is_admin||$member['level']<=$setup['grant_delete']||$member['level']==$setup['grant_write']||$data['ismember']==$member['no'])&&!$data['child']){?>
			<a class="button" href="delete.php?<?=$href?><?=$sort?>&no=<?=$no?>" title="삭제"><span>삭제</span></a>
			<?php }?>
		</td>
	</tr>

	<tr><td colspan="2" class="trLine"></td></tr>

	<tr>
		<td class="xe_viewName">
		<?=$face_image?> <?=$name?></b>
		<?php if($data['homepage']) {?><img src="<?=$dir?>/images/icon_homepage.gif" class="xe_member_homeIcon" title="홈페이지" alt="홈페이지" /><a href="<?=$data['homepage']?>" target="_blank" title="홈페이지 바로가기">홈페이지</a><?php }?></td>
		<td class="xe_member_home" align="right">
			<script type="text/javascript" src="<?=$dir?>/ui.base.js"></script>
			<script type="text/javascript" language="JavaScript">
			/*
			 * Slider 2006.09.06
			 * by NHN UII.Gony
			 */
			var Slider = Class({
				__const : function(id) {
					this.options = Class.extend({
						skinFormat : '<?=$dir?>/images/slider_%s.gif', // bg, unit
						minValue   : 0,
						maxValue   : 100,
						defValue   : 0, // default value
						step       : 1,
						maxPos     : 86, // position related to parent (px)
						initPos    : {x:1, y:12}, // initial position (minimun value)
						vertical   : false,
						onChange   : function(v){}
					}, arguments[1]);

					var e = this._element = $(id);
					var o = this.options;

					Element.setCSS(e, {
						position   : 'relative',
						background : 'no-repeat url('+o.skinFormat.replace('%s', 'bg')+') center center'
					});

					// auto resizing
					var im = $c('img');
					im.onload = function() {
						e.style.width  = this.width+'px';
						e.style.height = this.height+'px';
					}
					im.src = o.skinFormat.replace('%s', 'bg');

					// event binding
					this.onmousedown = this.ondown.bindForEvent(this);
					this.onmousemove = this.onmove.bindForEvent(this);
					this.onmouseup   = this.onup.bind(this);

					// positining draggable unit
					var u = this._unit_element = e.appendChild($c('img'));
					u.src =  o.skinFormat.replace('%s', 'unit');
					u.ondragstart = u.ondrag = function(){ return false }
					u.onmousedown = this.onmousedown;
					Element.setCSS(u, {
						position : 'absolute',
						cursor : 'pointer',
						top  : o.initPos.y+'px',
						left : o.initPos.x+'px'
					});
				},
				setValue : function(v) {
					var o = this.options; v = Math.min(Math.max(v,o.minValue),o.maxValue);
					var p = this._val2pos(v);

					if (this.options.vertical) {
						this._unit_element.style.top = p+'px';
					} else {
						this._unit_element.style.left = p+'px';
					}
					
					this.options.onChange(v);
				},
				ondown : function(e) {
					var u = this._unit_element;
					if (e.mouse.left) {
						this._moving = true;
						this._startPos = [parseInt(u.style.left), parseInt(u.style.top)];
						this._startXY  = [e.clientX, e.clientY];

						// register event
						Event.register(document, 'mouseup', this.onmouseup);
						Event.register(document, 'mousemove', this.onmousemove);
						Event.register(document, 'keypress', this.onmousemove);
						
						e.stop();
					}
				},
				onmove : function(e) {
					var newX, newY;
					var o = this.options;
					var u = this._unit_element;

					if (!this._moving || !e.mouse.left) return;
					newX = this._startPos[0] + e.clientX - this._startXY[0];
					newY = this._startPos[1] + e.clientY - this._startXY[1];

					if (o.vertical) {
						newY = Math.max(Math.min(newY,o.maxPos),o.initPos.y);
						u.style.top = newY + 'px';
					} else {
						newX = Math.max(Math.min(newX,o.maxPos),o.initPos.x);
						u.style.left = newX + 'px';
					}

					this.options.onChange(this._pos2val(o.vertical?newY:newX));
				},
				onup   : function() {
					this._moving = false;

					// unregister event
					Event.unregister(document, 'mouseup', this.onmousemove);
					Event.unregister(document, 'mousemove', this.onmousemove);
					Event.unregister(document, 'keypress', this.onmousemove);
				},
				_pos2val : function(p) {
					var o = this.options,s=o.step;
					var m = o.vertical?o.initPos.y:o.initPos.x;
					var v = (p-m)*(o.maxValue-o.minValue)/(o.maxPos-m);
					var q = Math.floor(v/s), r=v-q*s, v=q*s;

					return Math.round((v+o.minValue+((s/2)>r?0:s))*100)/100;
				},
				_val2pos : function(v) {
					var o = this.options,s=o.step;
					var m = o.vertical?o.initPos.y:o.initPos.x;
					var p = (v-o.minValue)*(o.maxPos-m)/(o.maxValue-o.minValue);
					var q = Math.floor(p/s), r=p-q*s, p=q*s;

					return Math.round((p+m+((s/2)>r?0:s))*100)/100;
				}
			});
			</script>
			  <div id="sl" title="폰트사이즈"></div>
			  <script type="text/javascript">
			   new Slider('sl', {
				minValue : 12, // 최소 폰트 사이즈
				maxValue : 36, // 최대 폰트 사이즈
				onChange : function(v) {
				 $('sval').value = v;
				 document.getElementById('view_mm').style.fontSize=v +'px'; // 폰트 사이즈
				 document.getElementById('view_mm').style.lineHeight=v+120 +'%'; // 폰트 사이즈에 맞춰서 줄간격도 변하도록
				}
			   });
			  </script>
			  <input type="hidden" id="sval" value="" />
		</td>
	</tr>
				
	<tr>
		<td colspan="2"><div id="viewMemo"><?=$memo?></div>
		<?php if($file_name1||$file_name2){?>
		<center>
		<div class="xeFile_div">첨부 : 
		<?=$hide_download1_start?><img src="<?=$dir?>/images/file.gif" class="xe_viewFile_icon" title="파일 1" alt="파일 1" /><?=$a_file_link1?><?=$file_name1?> (<?=$file_size1?>) (<?=$file_download1?>)</a><?=$hide_download1_end?>
		<?=$hide_download2_start?><img src="<?=$dir?>/images/file.gif" class="xe_viewFile_icon" title="파일 2" alt="파일 2" /><?=$a_file_link2?><?=$file_name2?> (<?=$file_size2?>) (<?=$file_download2?>)</a><?=$hide_download2_end?>		
		</div>
		<?php }?>

		<?php if($sitelink1||$sitelink2){?>
		<div class="xeFile_div">링크 : 
			<?=$hide_sitelink1_start?><img src="<?=$dir?>/images/iconLink.gif" class="xeLink_icon" title="링크1" alt="링크1" /> <?=$sitelink1?><?=$hide_sitelink1_end?>
			<?=$hide_sitelink2_start?><img src="<?=$dir?>/images/iconLink.gif" class="xeLink_icon" title="링크2" alt="링크2" /> <?=$sitelink2?><?=$hide_sitelink2_end?>
		</div>
		<?php }?>
		<b style="font-size:1px;display:block; overflow:hidden;height:1px; margin:15px"></b>

		</center></td>
		
	</tr>



	<tr class="xe_viewFile_tr">
		<td class="xe_viewFile">
			<img src="<?=$dir?>/images/iconReply.gif" style="width:12px; height:12px; vertical-align:middle; margin-top:-4px; margin-right:5px" title="댓글" alt="댓글" />댓글 : <span class="list_com_sp"><?php if($comment_num) {?><?=$comment_num?><?php }else{?>0<?php }?></span>
		</td>
		<td class="xeCom_btn">
			<span style="cursor:pointer" onclick="pagePrint(document.getElementById('viewMemo'));"><a class="button" href="#" onclick="pagePrint(document.getElementById('viewMemo')); return false;" title="인쇄"><span>인쇄</span></a></span>
			<?php if(!eregi($setup['no']."_".$no,$_SESSION['zb_vote'])) {// 추천 버튼?>
			<a class="button" href="vote.php?<?=$href?><?=$sort?>&no=<?=$no?>" title="추천"><span>추천</span></a>
			<?php }?>
			<?php if($is_admin||$member['level']<=$setup['grant_list']) {// 목록 버튼?>
			<a class="button" href="zboard.php?id=<?=$id?>&page=<?=$page?>&category=<?=$category?>&sn=<?=$sn?>&ss=<?=$ss?>&sc=<?=$sc?>&keyword=<?=$keyword?>&prev_no=<?=$no?>&sn1=<?=$sn1?>&divpage=<?=$divpage?>" title="목록"><span>목록</span></a>
			<?php }?>
			<?php if(($is_admin||$member['level']<=$setup['grant_reply'])&&$no&&$data['headnum']>-2000000000) {// 답글 버튼?>
			<a class="button" href="write.php?<?=$href?><?=$sort?>&no=<?=$no?>&mode=reply&sn1=<?=$sn1?>" title="답글"><span>답글</span></a>
			<?php }?>
			<?php if($is_admin||$member['level']<=$setup['grant_write']) {// 새글 버튼?>
			<a class="button" href="write.php?<?=$href?><?=$sort?>&no=<?=$no?>&mode=write&sn1=<?=$sn1?>" title="새글"><span>새글</span></a>
			<?php }?>
		</td>
	</tr>
</table>

<b style="width:<?=$width?>; font-size:1px;display:block; overflow:hidden;height:1px; margin:5px"></b>

<?=$hide_comment_start?>
<table class="xeComment_tb" width="<?=$width?>" cellSpacing="0" cellpadding="0" border="0">
	<tr>
	<td style="vertical-align:top">
