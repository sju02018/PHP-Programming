# TableBoard_Shop
게시판-Shop 의 TODO 완성하기!

## 기존 파일
```
 .
├── css - board_form.php와 index.php 에서 사용하는 stylesheet
│   └── ...
├── fonts - 폰트
│   └── ...
├── images - 아이콘 이미지
│   └── ...
├── vender - 외부 라이브러리
│   └── ...
├── js - board_form.php와 index.php 에서 사용하는 javascript
│   └── ...
├── function
│   └── insert.php - 게시글 작성 기능 구현
│   └── update.php - 게시글 수정 기능 구현
│   └── delete.php - 게시글 삭제 기능 구현
├── board_form.php - 게시글 작성/수정 시 사용하는 form이 포함된 php 파일
├── index.php - 게시글 조회 기능 구현
```

## MySQL 테이블 생성!
Note: 
- table 이름은 tableboard_shop 으로 생성
- 기본키는 num 으로, 그 외의 속성은 board_form.php 의 input 태그 name 에 표시된 속성 이름으로 생성
- 각 속성의 type 은 자유롭게 설정 (단, 입력되는 값의 타입과 일치해야 함)
    - ex) price -> int
    - ex) name -> char or varchar
    
===테이블 생성 시, 사용한 Query===
 - create table tableboard_shop (
num int not null auto_increment,
date datetime,
order_id int,
name char(100),
price char(20),
quantity int,
primary key(num)
);

설명: num은 primary key 값으로 각 레코드를 고유하게 식별하는데 사용되며, auto_increment로 자동으로 1씩 올라가도록 하였다.
    
## index.php 수정
- mysql_connect(), mysql_connect_db() 함수를 통해 기존에 생성되었던 tableboard_shop 테이블에 접근할 수 있도록 db를 연동한다.
    - select * from tableboard_shop 쿼리문을 통해 모든 레코드를 순차적으로 받아올 수 있도록 한다.
- while문을 사용하여 쿼리문을 통해 순차적으로 레코드를 받아온다.
    - 순차적으로 받은 레코드의 속성값들을 한 tr 태그속에 순서대로 기입해준다.
    - total은 int간의 연산을 통해 얻은 값이므로 적절히 $를 붙여 string으로 변환 시켜준다.

##board_form.php 수정
- index.php 파일에서 했던 것처럼, db연동을 한다.
    - 전 페이지(index.php)에서 get으로 넘겨준 변수 num(각 레코드의 primary key 값)을 사용하기 쉽게 $number 에 저장하였다. 
    - select * from tableboard_shop where num=$number; 구문을 사용하여 해당 레코드를 받아온다.
    - 이때, $bal 배열을 통해 하나의 레코드 정보를 담았는데 배열의 인덱스순으로 column에 정보를 기입해준다. (update/delete 일 때)
    - price의 경우 db에서 string 값이므로 substring 과 문자열 붙이기 연산을 통해 적절히 형태를 변환해준다.
    - insert인 경우 (add 버튼) 아무 정보도 기입해주지 않아도 된다.

## function
### insert.php 수정
- db 연동 실시 (mysql_connect(), mysql_connect_db()) 
- 전 페이지(board_form.php)에서 POST로 받은 값들(새로운 레코드의 속성값들)을 바탕으로 새 레코드 기입
    - insert into tableboard_shop(date, order_id, name, price, quantity) values ('$_POST[date]', $_POST[order_id], '$_POST[name]', '$real_price', $_POST[quantity]);
    - $real_price 는 가격을 받아온 값은 정수를 바탕으로 하고 있으므로 $를 붙이고 적절히 string 화
    - 해당 쿼리가 정상적으로 작동 안할 시 에러 메시지 출력

### update.php 수정
- db 연동 실시 (mysql_connect(), mysql_connect_db())
- 전 페이지(board_form.php)에서 POST로 받은 값들(변경할 레코드의 속성값들)을 바탕으로 값 변경
    - update tableboard_shop set date='$_POST[date]', order_id='$_POST[order_id]', name='$_POST[name]', price='$real_price', quantity='$_POST[quantity]' where num=$number;
    - $real_price 는 가격을 받아온 값은 정수를 바탕으로 하고 있으므로 $를 붙이고 적절히 string 화
    - 여기서 $number는 get으로 받아온 num값(레코드의 primary key값)
    - 해당 쿼리가 정상적으로 작동 안할 시 에러 메시지 출력

### delete.php 수정
- db 연동 실시 (mysql_connect(), mysql_connect_db())
- 전 페이지(board_form.php)에서 GET로 받은 num값(레코드의 primary key값)을 기준으로 해당 레코드 삭제
    - delete from tableboard_shop where num=$_GET[num];
    - 해당 쿼리가 정상적으로 작동 안할 시 에러 메시지 출력
