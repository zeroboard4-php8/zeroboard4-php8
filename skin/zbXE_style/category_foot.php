</select>
<img src="<?=$dir?>/images/go_category.gif" style="width:24px; height:20px; vertical-align:middle; cursor:pointer; margin-top:-3px" onClick="jumptolink(document.form1.select1)" onmouseover="this.src='<?=$dir?>/images/go_category_on.gif'" onmouseout="this.src='<?=$dir?>/images/go_category.gif'" title="Go" alt="Go" />
<script type="text/javascript">
function jumptolink(what){
var selectedopt=what.options[what.selectedIndex]
if (document.getElementById && selectedopt.getAttribute("target")=="_self")
location.href(selectedopt.value)
else
location.href="zboard.php?category="+selectedopt.value+"&id=<?=$id?>&page=<?=$page?>&page_num=<?=$page_num?>&sn=on&ss=on&sc=on&select_arrange=headnum&desc=asc"
}
</script>
</form>
