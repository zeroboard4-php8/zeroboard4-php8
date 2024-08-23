<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
  <tr>
    <td width=100%>
      <table width=100% border=0 cellspacing=0 cellpadding=0>
        <tr>
          <td height=9 <?php if(!$setup['use_category']) echo"align=right";?> valign=bottom class=tahoma>
            <?=$a_login?><img src=<?=$dir?>/box.gif border=0 width=13 height=5 alt=login></a>
            <?=$a_member_join?><img src=<?=$dir?>/box.gif border=0 width=13 height=5 alt=join_us></a>
            <?=$a_member_modify?><img src=<?=$dir?>/box.gif border=0 width=13 height=5 alt=my_info></a>
            <?=$a_member_memo?><img src=<?=$dir?>/box.gif border=0 width=13 height=5 alt=memobox></a>
            <?=$a_logout?><img src=<?=$dir?>/box.gif border=0 width=13 height=5 alt=logout></a>
            <?=$a_setup?><img src=<?=$dir?>/box.gif border=0 width=13 height=5 alt=admin></a>
          </td>
<?=$hide_category_start?>
          <td height=9 align=right class=tahoma>
            <?=$a_category?>
          </td>
<?=$hide_category_end?>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td width=100% height=1></td>
  </tr>    
  <tr>
    <td width=100% valign=top>
      <table width=100% border=0 cellspacing=0 cellpadding=0>
