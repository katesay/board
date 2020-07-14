<?

const DEBUG = TRUE;

//데이터 베이스 연결하기
include "db_user.php";
include "db_info.php";
include "util.php";

$board = "threadboard";

// HTML에서 전달된 값 검사
// write.php 폼값 가져오기
//$id = isset($_GET['id']) ? $_GET['id'] : 0;
if (isset($_GET["id"]))  {
    $id = $_GET['id'];
} else {
    $id = 0;
}

//$name = $_POST['name'];
if (isset($_POST["name"]) && ($_POST["name"].length >  0))  {
    $name = $_POST['name'];
} else {
    $name = 'no_name';
}
$email = $_POST['email'];
$pass = $_POST['pass'];
$title = $_POST['title'];
$content = $_POST['content'];
$REMOTE_ADDR = $_SERVER['REMOTE_ADDR'];



$pdo = dbConnect($dsn, $user, $password, $dbName);


//Thread 값을 계산한다.
$query = "SELECT max(thread) FROM $board";

d("query = {$query}");
// 최대 게시물 쓰레드 값을  구한다.
	$stmt = $pdo->prepare($query);
	$stmt->execute();
    
    // 최대 쓰레드값으 결과를 얻었습니다.
	$max_thread = $stmt->fetchColumn();
	//$total_row = $result_count;
d("초대 스레드값 = {$max_thread}");

// 새글 쓰레드 값 생성
$max_thread = ceil($max_thread / 1000) * 1000 + 1000;

$query = "INSERT INTO $board (
    thread, 
    depth, 
    name, 
    pass, 
    email,
    title, 
    view, 
    wdate, 
    ip, 
    content) 
VALUES (
    $max_thread, 
    0, 
    '$_POST[name]', 
    '$_POST[pass]', 
    '$_POST[email]', 
    '$_POST[title]', 
    0,
    UNIX_TIMESTAMP(), 
    '$_SERVER[REMOTE_ADDR]', 
    '$_POST[content]')";

try {
    		
    // PDO에 쿼리 문장을 등록한다
    $stmt = $pdo->prepare($query);
    // SQL 문을 실행한다
    $stmt->execute();

} catch (Exception $e) {
    echo '<span class="error">오류가 있습니다. </span><br>';
    echo $e->getMessage();
    exit();
}

//데이터베이스와의 연결 종료
dbClose($pdo);

// 새 글 쓰기인 경우 리스트로..
//p ("<meta http-equiv='Refresh' content='1; URL=list.php'>");
?>
<center>
    <font size=2>정상적으로 저장되었습니다.</font>