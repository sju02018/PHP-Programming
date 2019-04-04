<?php
$connect = @mysql_connect("localhost","LWJ","1234"); // mysql 실행
$db_con = @mysql_select_db("LWJ_db", $connect); // 디비 연동

$sql = "select * from boardz where title like '%$_POST[search]%';"; // 쿼리문 작성
$result = @mysql_query($sql, $connect); // 쿼리 실행
?>


<!doctype html>


<html lang="en">
<head>
    <meta charset="UTF-8"> 

    <title>Boardz Demo</title>
    <meta name="description" content="Create Pinterest-like boards with pure CSS, in less than 1kB.">
    <meta name="author" content="Burak Karakan">
    <meta name="viewport" content="width=device-width; initial-scale = 1.0; maximum-scale=1.0; user-scalable=no" />
    <link rel="stylesheet" href="src/boardz.css?after">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/wingcss/0.1.8/wing.min.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <div class="seventyfive-percent  centered-block">
        <!-- Sample code block -->
        <div>    
            <hr class="seperator">

            <!-- Example header and explanation -->
            <div class="text-center">
                <h2>Beautiful <strong>Boardz</strong></h2>
                <div style="display: block; width: 50%; margin-right: auto; margin-left: auto; position: relative;">
                    <form class="example" method="post" action="board.php">
                        <input type="text" placeholder="Search.." name="search">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>

            <div class="boardz centered-block beautiful">
                <?php
               $total_num = 0; // 검색 결과 갯수
               while ($rows = @mysql_fetch_row($result)) {
                   $total_num++; // 검색 결과 갯수 count
               }

               if ($total_num > 3) {
                   $row = 3; // ul 개수는 총 개수가 3개 초과면 3개
                   if ($total_num%3 >0) { // 나누어 떨어지지 않으면 (li 개수)
                       $col = (int)($total_num/3) + 1; // 3의 몫 + 1
                   } else { // 나누어 떨어지면
                       $col = $total_num/3; // 3의 몫
                   }
               } else {
                   $row = $total_num; // ul 개수는 총개수
                   $col = 1; // li 개수는 1개
               }

               @mysql_data_seek($result, 0); // 데이터 읽어오는거 초기화

                for ($i=0; $i<$row; $i++) { // ul 개수
                    if($total_num%3 > 0 && $i+1>($total_num%3)) { // 나머지 있고(사각으로 딱 안맞아 떨어지면) 남은 갯수 초과로 열을 찍을 때
                        $col = floor($total_num/3); // 몇 개까지만 출력할건지
                    }
                    echo '<ul>';
                    for ($j=0; $j<$col; $j++){
                        $rows = @mysql_fetch_row($result);
                        echo '<li>';
                        if ($rows[2] != null) { // 제목이 존재하면
                            echo "<hl>$rows[2]<br/></hl>"; // 출력
                        }
                        if ($rows[3] != null) { // 설명이 존재하면
                            echo "$rows[3]<br/>"; // 출력
                        }
                        echo "<img src=$rows[1] alt='demo image'/>"; // 이미지 소스 출력
                        echo '</li>';
                    }
                    echo '</ul>';
                }

                @mysql_close();
                ?>
            </div>
        </div>

        <hr class="seperator">

    </div>
</body>
</html>