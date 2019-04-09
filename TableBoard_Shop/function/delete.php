<?php
/**
 * Created by PhpStorm.
 * User: kim2
 * Date: 2019-04-04
 * Time: 오전 9:39
 */

# TODO: MySQL DB에서, num에 해당하는 레코드 삭제하기!
# 참고 : 에러 메시지 출력 방법
$connect = @mysql_connect("localhost","LWJ","1234"); // mysql 실행
$db_con = @mysql_select_db("LWJ_db", $connect); // 디비 연동

// 해당 num을 primary key로 가진 레코드 삭제
$sql = "delete from tableboard_shop where num=$_GET[num];";
$result = @mysql_query($sql, $connect); // 쿼리 실행

if (!$result) { // 쿼리에 오류가 있으면
    echo "<script> alert('delete - error message') </script>"; // 에러 메시지 출력
} else {
    echo "<script> alert('delete - complete!') </script>"; // 없으면 정상 메시지 출력
}

@mysql_close(); // 디비 연결 끊음

?>

<script>
    location.replace('../index.php');
</script>
