<form>
<br><br>

<table border=0 cellspacing=1 cellpadding=3 width=250 bgcolor=#E7E7E7>
  <tr>
      <td bgcolor=#FFFFFF height=25 class=thm7pt>
           &nbsp;&nbsp; <font color=#C00000>E</font>rror~!!
      </td>
  </tr>
  <tr>
      <td bgcolor=#FFFFFF height=2></td>
  </tr>
</table>

<table border=0 cellspacing=0 cellpadding=0 width=250>
  <tr>
      <td bgcolor=#FFFFFF height=2></td>
  </tr>
</table>

<table border=0 width=250 height=30>
  <tr class=list0>
     <td align=center height=50 class=list_main><?php echo $message;?></td>
  </tr>
</table>

<?php  if(!$url)  {?>  <br>

<table border=0 cellspacing=0 cellpadding=0 width=250>
  <tr>
    <td align=center>
        <a href=# onclick=history.back() onfocus=blur()><font class=list_han><b>뒤로가기</b></font></a>
<?php  }  else  {?> <br>
        <a href=# onclick=location.href="<?php echo $url;?>" onfocus=blur()><font class=list_han>페이지이동</font></a>
<?php  }?>
    </td>
  </tr>
</form>
</table>
<br>