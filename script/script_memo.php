
<script>
function check_submit()
{
 if(!document.write.subject.value) 
 {alert('제목을 입력하여 주세요');
  document.write.subject.focus();
  return false;
 }
 if(!document.write.memo.value)
 {
  alert('내용을입력하여주세요');
  document.write.memo.focus();
  return false;
 }
 return true;
}
</script>
