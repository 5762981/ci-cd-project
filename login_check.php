<?php
include "db.php";
		
$id = $_POST['loginId'];
$pw = $_POST['loginPw'];

$sql = "SELECT * FROM `member` WHERE `user_id` = :id AND `user_pw` = :pw";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id, 'pw' => $pw]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    echo "<script>
            alert('성공적으로 로그인하였습니다.');
            location.replace('admin_users.php');
          </script>";
} else {
    echo "<script>
            alert('아이디 또는 비밀번호가 일치하지 않습니다.');
            history.back();
          </script>";
}
?>