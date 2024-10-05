
<?php //에러 메시지 파일입니다
  if(!$url)
  {
?>
<script type="text/javascript">
	alert("<?php echo $message;?>");
self.history.back();
</script>
<?php 
  }
  else
  {
?>
<script type="text/javascript">
	alert("<?php echo $message;?>");
self.location.href="<?php echo $url;?>";
</script>

<?php 
  }
?>

