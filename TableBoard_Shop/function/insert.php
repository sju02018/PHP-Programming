<?php
/**
 * Created by PhpStorm.
 * User: kim2
 * Date: 2019-04-04
 * Time: 오전 9:39
 */

# TODO: MySQL DB에서, POST로 받아온 내용 입력하기!
# 참고 : 에러 메시지 출력 방법
$connect = @mysql_connect("localhost","LWJ","1234"); // mysql 실행
$db_con = @mysql_select_db("LWJ_db", $connect); // 디비 연동

$real_price = '$'.$_POST[price]; // 앞에 $ 문자열 붙이기
// POST로 받아온 값을 바탕으로 db 값 삽입하기
$sql = "insert into tableboard_shop(date, order_id, name, price, quantity) values ('$_POST[date]', $_POST[order_id], '$_POST[name]', '$real_price', $_POST[quantity]);"; // 쿼리문 작성
$result = @mysql_query($sql, $connect); // 쿼리 실행

if (!$result) { // 쿼리에 오류가 있으면
    echo "<script> alert('insert - error message') </script>"; // 에러 메시지 출력
} else {
    echo "<script> alert('insert - complete!') </script>"; // 없으면 정상 메시지 출력
}

@mysql_close(); // 디비 연결 끊음

?>

<script>
    location.replace('../index.php');
</script>
