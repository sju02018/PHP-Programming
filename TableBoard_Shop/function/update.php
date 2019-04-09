<?php
/**
 * Created by PhpStorm.
 * User: kim2
 * Date: 2019-04-04
 * Time: 오전 9:39
 */

# TODO: MySQL DB에서, num에 해당하는 레코드를 POST로 받아온 내용으로 수정하기!
# 참고 : 에러 메시지 출력 방법
$number = $_GET[num]; // get 매개변수 가져오기
$connect = @mysql_connect("localhost","LWJ","1234"); // mysql 실행
$db_con = @mysql_select_db("LWJ_db", $connect); // 디비 연동

$real_price = '$'.$_POST[price]; // 앞에 $ 문자열 붙이기

// POST로 받아온 값을 바탕으로 db 값 변경하기
$sql = "update tableboard_shop set date='$_POST[date]', order_id='$_POST[order_id]', name='$_POST[name]', price='$real_price', quantity='$_POST[quantity]' where num=$number;"; // 쿼리문 작성
$result = @mysql_query($sql, $connect); // 쿼리 실행

if (!$result) { // 쿼리에 오류가 있으면
    echo "<script> alert('update - error message') </script>"; // 에러 메시지 출력
} else {
    echo "<script> alert('update - complete!') </script>"; // 없으면 정상 메시지 출력
}



@mysql_close();
?>

<script>
    location.replace('../index.php');
</script>
