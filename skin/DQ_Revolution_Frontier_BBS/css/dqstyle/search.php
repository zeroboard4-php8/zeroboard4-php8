  <div id="search_btTools">
    <div id="search_btArrow"><img src="<?=$_css_dir?>/search_ar1.gif" onclick="soTools_togle(event)" id="imgSearch_toggle" /></div>
    <div id="search_input"><input id="search_intext" type="text" name="keyword" value="<?php if($su!="on") echo $keyword?>" size="13"></div>
    <div><img src="<?=$_css_dir?>/search_sep.gif" /></div>
    <div><input type="image" src="<?=$_css_dir?>search_go.gif"></div>
    <div><img src="<?=$_css_dir?>search_x.gif" onclick="location.href='zboard.php?id=<?=$id?>'" style="cursor:pointer"></div>
  </div>
  <div id="search_options_tool">
    <img src="<?=$_css_dir?>name_<?=$sn?>.gif" border="0" name="sn" onClick="soTools_onoff('sn')" />
    <img src="<?=$_css_dir?>subject_<?=$ss?>.gif" border="0" name="ss" onClick="soTools_onoff('ss')" />
    <img src="<?=$_css_dir?>content_<?=$sc?>.gif" border="0" name="sc" onClick="soTools_onoff('sc')" />
  </div>
  <script type="text/javascript">
    if(dq_getCookie('dqRevolution_searchOption') == 'show') soTools_togle();
  </script>
