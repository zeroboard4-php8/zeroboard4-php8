<table border=0 cellPadding=0 cellspacing=0 width=100%>
  <tr>
    <td height="1" bgcolor="#f7f7f7">
    </td>
  </tr>
  <tr>
    <td height="10"></td>
  </tr>
</table>
<table border=0 cellPadding=0 cellspacing=0 width=100%>
  <tr>
    <td width=70% valign="bottom"><img width=1 height=1>&nbsp;&nbsp;<?=$hide_cart_start?><input type=checkbox name=cart value="<?=$data['no']?>"><?=$hide_cart_end?><?=$face_image?><?=$name?>&nbsp;&nbsp;<span class=thm7><?php if($data['homepage']){?><a href="<?=$data['homepage']?>" target="_blank" onfocus='this.blur()'>HOME</a><?php } else { ?><?php } ?>&nbsp;&nbsp;<span class=thm7><?=$a_reply?>ANS</a>&nbsp;&nbsp;&nbsp;<?=$a_modify?>EDIT</a>&nbsp;&nbsp;&nbsp;<?=$a_delete?>DEL</a></td>
    <td align=right valign="bottom"><img width=1 height=1><span class=thm7><?=$reg_date?>&nbsp;&nbsp;&nbsp;</span></td>
  </tr>
</table>
<table border=0 cellPadding=5 cellspacing=0 width=100%>
  <tr>
    <td valign=top>
	<table cellpadding=0 cellspacing=0 border=0 width=100%>
  <tr height=1>
    <td rowspan=4 width=1></td>
    <td rowspan=3 width=1></td>
    <td rowspan=2 width=1></td>
    <td width=2></td>
    <td bgcolor=#f7f7f7></td>
    <td width=2></td>
    <td rowspan=2 width=1></td>
    <td rowspan=3 width=1></td>
    <td rowspan=4 width=1></td>
  </tr>
  <tr height=1>
    <td bgcolor=#f7f7f7></td>
    <td bgcolor=#f7f7f7></td>
    <td bgcolor=#f7f7f7></td>
  </tr>
  <tr height=1>
    <td bgcolor=#f7f7f7></td>
    <td colspan=3 bgcolor=#f7f7f7></td>
    <td bgcolor=#f7f7f7></td>
  </tr>
  <tr height=2>
    <td bgcolor=#f7f7f7></td>
    <td colspan=5 bgcolor=#f7f7f7></td>
    <td bgcolor=#f7f7f7></td>
  </tr>
</table>

<table cellpadding=0 cellspacing=0 border=0 width=100%>
  <tr >
    <td width=1 bgcolor=#f7f7f7></td>
    <td valign=top bgcolor=#f7f7f7>
      <table cellpadding=0 cellspacing=0 border=0 width=100%>
        <tr height=0><td></td>
<td></td>
<td></td>
</tr>
        <tr>
          <td width=0></td>
          <td style="padding:5 10 0 12;"><?=$memo?><br></td>
          <td width=0></td>
        </tr>
        <tr height=0>
	  <td></td>
	  <td bgcolor=#f7f7f7></td>
	  <td></td>
	</tr>
      </table>
    </td>
    <td width=1 bgcolor=#f7f7f7></td>
  </tr>
</table>
<table cellpadding=0 cellspacing=0 border=0 width=100%>
  <tr height=2>
    <td rowspan=4 width=1></td>
    <td width=1 bgcolor=#f7f7f7></td>
    <td width=1 bgcolor=#f7f7f7></td>
    <td width=2 bgcolor=#f7f7f7></td>
    <td bgcolor=#f7f7f7></td>
    <td width=2 bgcolor=#f7f7f7></td>
    <td width=1 bgcolor=#f7f7f7></td>
    <td width=1 bgcolor=#f7f7f7></td>
    <td rowspan=4 width=1></td>
  </tr>
  <tr height=1>
    <td rowspan=3></td>
    <td bgcolor=#f7f7f7></td>
    <td colspan=3 bgcolor=#f7f7f7></td>
    <td bgcolor=#f7f7f7></td>
    <td rowspan=3></td>
  </tr>
  <tr height=1>
    <td rowspan=2></td>
    <td bgcolor=#f7f7f7></td>
    <td bgcolor=#f7f7f7></td>
    <td bgcolor=#f7f7f7></td>
    <td rowspan=2></td>
</tr>
<tr height=1>
    <td></td>
    <td bgcolor=#f7f7f7></td>
    <td></td>
  </tr>
</table>
    </td>
  </tr>
  <tr>
    <td height="10"></td>
  </tr>
  <tr>
    <td width=100% align=right>
    </td>
  </tr>
</table>

<?php 
 include "include/get_reply.php";
?>
