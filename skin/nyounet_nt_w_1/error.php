<form>
<br><br>
<table border=0 cellspacing=0 cellpadding=0 width=250 height=30>
  <tr>
    <td align=center height=30>
      <table border=0 cellspacing=0 cellpadding=10 width=100% height=100%>
        <tr>
          <td width=100% height=100% class=normal align=center><?php echo $message;?></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<?php if(!$url) { ?><br><center><a href=# onclick=history.back() onfocus=blur()><img src=<?=$dir?>/btn_back.gif border=0 width=36 height=17></a><?php } else { ?><br><div align=center><a href=# onclick=location.href="<?php echo $url;?>" onfocus=blur()><img src=<?=$dir?>/btn_move.gif border=0 width=37 height=17></a><?php } ?><br><br></form>
<br><br>