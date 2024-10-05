
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>

<tr align=center>	
<td valign=top bgcolor=white>
                 <table border=0 cellspacing=0 width=100% style=table-layout:fixed>
                    <tr>
                       <td height=10 nowrap style=padding-left:10px></td>
                    </tr>
                    <tr>
                       <td nowrap style=padding-left:10px bgcolor=#F5F5F5></td>
                    </tr>
		</table>
                 <table border=0 cellspacing=0 width=100% style=table-layout:fixed height=30 class=list>
                    <tr>
                       <td width=1 bgcolor=#FCFCFC></td>
                       <td width=80% nowrap style=padding-left:10px bgcolor=#FCFCFC class=list_eng>▣ 제목 : <?=$subject?></td>
                       <td width=20% align=right style=padding-right:10px class=list_eng bgcolor=#FCFCFC><b><font class=list_main style=font-size:7pt><?=number_format($hit)?></font></b> - 조회:추천 - <b><font class=list_main style=font-size:7pt><?=$vote?></font></b></td>
                       <td width=1 bgcolor=#FCFCFC></td>
                    </tr>
		</table>
                 <table border=0 cellspacing=0 width=100% style=table-layout:fixed height=1>
                    <tr>
                       <td nowrap style=padding-left:10px bgcolor=#F5F5F5></td>
                    </tr>
		</table>

		<table border=0 cellspacing=0 width=100% style=table-layout:fixed height=30 class=list>
		<col width=></col><col width=260></col>
		<tr>

                        <td width=1 bgcolor=#FCFCFC></td>
			<td nowrap style=padding-left:10px bgcolor=#FCFCFC class=list_eng>
				▣ 이름 : <?=$face_image?> <?=$name?></b>&nbsp;
				<?php 
					if($data['homepage']) {
				?><a href="<?=$data['homepage']?>" target=_blank><font class=thm7pt>( HOMEPAGE )</font></a><?php 
					}
				?>
			</td>
			<td bgcolor=#FCFCFC align=right style=padding-right:10px class=list_eng><b><font class=list_main style=font-size:7pt><?=$reg_date?></font></b> - 등록</td>
                        <td width=1 bgcolor=#FCFCFC></td>
		</tr>
                </table>
                 <table border=0 cellspacing=0 width=100% style=table-layout:fixed height=1>
                    <tr>
                       <td nowrap style=padding-left:10px bgcolor=#F5F5F5></td>
                    </tr>
		</table>
<?=$hide_download1_start?> 
                 <table border=0 cellspacing=0 width=100% style=table-layout:fixed height= class=list>
                    <tr>
                      <td width=50% nowrap style=padding-left:10px bgcolor=#FFFFFF class=list_eng>&nbsp;- 다운로드 : <font class=list_main style=font-size:7pt>&nbsp;&nbsp;<?=$a_file_link1?><?=$file_name1?> (<?=$file_size1?>)</a>, <?=$file_download1?>  :download</font><br><?=$upload_image1?></font></td> 
                    </tr>
		</table>
<?=$hide_download1_end?>

<?=$hide_download2_start?>
                 <table border=0 cellspacing=0 width=100% style=table-layout:fixed height= class=list>
                    <tr>
                       <td width=50% nowrap style=padding-left:10px bgcolor=#FFFFFF class=list_eng>&nbsp;- 스크린샷 : <font class=list_main style=font-size:7pt>&nbsp;&nbsp;<?=$a_file_link2?><?=$file_name2?> (<?=$file_size2?>)</a>, <?=$file_download2?> :download</font><br><?=$upload_image2?></font></td>
                    </tr>
		</table>
<?=$hide_download2_end?>

		<table border=0 cellspacing=0 cellpadding=10 width=100% style=padding:8px;word-break:break-all;>
		<tr>
			<td class=list_eng>
                                <br>
				<div align=left style=font-family:돋움,tahoma;font-size:9pt;color:#333333><?=$memo?></div>
		                <br><br><br>
				<div align=right style=font-family:tahoma;font-size:7pt;color:#666666><?=$ip?></div>
                                <br>
			</td>
		</tr>
		</table>
</td>
<td></td>

</tr>
</table>

<!-- 간단한 답글 시작하는 부분 -->
<?=$hide_comment_start?> 
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?> bgcolor=<?=$_color2?>>
<?=$hide_comment_end?>
