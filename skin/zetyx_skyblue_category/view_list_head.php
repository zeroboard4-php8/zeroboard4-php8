<table border=0 cellspacing=0 cellpadding=0 width=100%>
<tr><td width=1>
<form method=post name=list action=list_all.php>
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=id value=<?=$id?>>
<input type=hidden name=select_arrange value=<?=$select_arrange?>>
<input type=hidden name=desc value=<?=$desc?>>
<input type=hidden name=page_num value=<?=$page_num?>>
<input type=hidden name=selected>
<input type=hidden name=exec>
<input type=hidden name=keyword value="<?=$keyword?>">
<input type=hidden name=sn value="<?=$sn?>">
<input type=hidden name=ss value="<?=$ss?>">
<input type=hidden name=sc value="<?=$sc?>">
</td></tr><tr><td width=100%>

<table border=0 cellspacing=0 cellpadding=0 width=100%>
<tr align=center>
  <td>
    <table border=0 height=18 cellspacing=0 cellpadding=0 width=50 background=<?=$dir?>/images/lh_bg.gif>
       <tr><td align=center valign=top><img src=images/t.gif height=3 align=absmiddle></td></tr>
    </table>
  </td>
<?=$hide_category_start?>
  <td>
    <table border=0 height=18 cellspacing=0 cellpadding=0 width=50 background=<?=$dir?>/images/lh_bg.gif>
       <tr><td align=center valign=top><img src=images/t.gif height=3 align=absmiddle></td></tr>
    </table>  
  </td>
<?=$hide_category_end?>
  <td width=100%>
    <table border=0 height=18 cellspacing=0 cellpadding=0 width=100% background=<?=$dir?>/images/lh_bg.gif>
       <tr><td align=center valign=top><img src=<?=$dir?>/images/lh_subject.gif border=0></td></tr>
    </table>
  </td>
  <td>
    <table border=0 height=18 cellspacing=0 cellpadding=0 width=90 background=<?=$dir?>/images/lh_bg.gif>
       <tr><td align=center valign=top><img src=<?=$dir?>/images/lh_name.gif border=0></td></tr>
    </table>
  </td>
  <td>
    <table border=0 height=18 cellspacing=0 cellpadding=0 width=70 background=<?=$dir?>/images/lh_bg.gif>
       <tr><td align=center valign=top><img src=<?=$dir?>/images/lh_date.gif border=0></td></tr>
    </table>
  </td>
  <td>
    <table border=0 height=18 cellspacing=0 cellpadding=0 width=55 background=<?=$dir?>/images/lh_bg.gif>
       <tr><td align=center valign=top><img src=<?=$dir?>/images/lh_read.gif border=0></td></tr>
    </table>
  </td>
  <td>
    <table border=0 height=18 cellspacing=0 cellpadding=0 width=30 background=<?=$dir?>/images/lh_bg.gif>
       <tr><td align=center valign=top><img src=<?=$dir?>/images/lh_vote.gif border=0></td></tr>
    </table>
  </td>
</tr>
