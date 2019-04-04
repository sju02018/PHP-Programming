# boardz
게시판 검색 기능 완성하기

## 기존 파일
```
 .
├── css
│   └── style.css
├── src
│   └── boardz.css
├── board.html
```

## 추가 및 수정된 파일
```
 .
├── css
│   └── style.css
├── src
│   └── boardz.css
├── board.php (수정)
[만약 추가한 파일이 있으면, 내용 추가! 없으면 이 문구 삭제!]
```

## board.php (수정)
첫 부분에 @mysql_connect 와 @mysql_select_db 함수 두 개를 이용해서 로컬 데이터베이스에 접근 하였다.
sql문을 다음과 같이 작성하였다.

select * from boardz where title like '%$_POST[search]%'

(boardz 테이블에서 title 속성값이 $_POST[search]와 유사한 것들을 전부 추출해낸다. 이때, search는 같은 페이지(board.php)에서 검색창에 입력한 값이다.)

해당 쿼리문을 @mysql_query()함수를 통해 질의하고 결과를 바탕으로 @mysql_fetch_row() 함수로 배열값으로 받아올 수 있다.

이때, 반복문을 사용하면 반복문이 한 번 돌 때마다, 검색결과에서 다음 레코드값을 받아온다.

검색결과를 화면에 출력해주는 알고리즘을 유도한 과정은 다음과 같다.

우선 검색결과가 1개일 때부터 7개까지 ul li 구조가 어떻게 되는지 살펴보았다.

1개일 때, 결과1

2개일 때, 결과1 결과2

3개일 때, 결과1 결과2 결과3

4개일 때, 결과1 결과2 결과3
         
           결과4

5개일 때, 결과1 결과2 결과3
               
           결과4 결과5
6개일 때, 결과1 결과2 결과3
               
           결과4 결과5 결과6
           
7개일 때, 결과1 결과2 결과3
               
           결과4 결과5 결과6
           
           결과7
       
최대 열 갯수는 3개이고 행은 무한대로 늘어날 수 있다.

본 코드에서는 이중 for문을 이용해서 $row 를 한 열에 대한 외부루프, $col을 한 열에서 얼마나 많은 행을 생성할지에 대한 내부루프로 설정하였다.
    
결과를 바탕으로 유추해 봤을 때, 크게 결과개수가 3개보다 많을 때, 적을 때로 구분된다.
3개보다 적을 때(한 줄만 나올 때)는 ul개수(열개수)는 결과개수, 각 ul별 li 개수는 1개가 된다.

3개보다 많을 때는 조금 더 생각할 필요가 있다.
기본 알고리즘은 검색결과 개수와 관계없이 항상 사각형의 형태로 사진을 출력한다. 예를 들어, 결과 개수가 7개여도 총 9번의 이미지 출력을 한다는 말이다.

여기서 두 가지 경우로 나뉘는데, 결과개수가 3으로 나누어떨어지면 원래 알고리즘대로 처리하면 된다. 3으로 나누어 떨어지지않으면 
외부루프 $row 값을 이용해 $row+1 값이 결과개수를 3으로 나눈 나머지보다 클 때부터 3으로 나눈 몫만큼만 이미지를 출력해주면 된다.
이를 내부루프에 들어가기 전에 if 조건을 통해서 설정해주었다.

이후 형식에 맞게 제목, 설명, 이미지를 출력해주면 된다.