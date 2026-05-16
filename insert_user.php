<?php
include "db.php";

$userId = $_POST['userId'];
$user_pw = $_POST['userPw'];
$user_name = $_POST['userName'];
$user_email = $_POST['userEmail'];

$checkSql = "SELECT COUNT(*) FROM `member` WHERE `user_id` = :userId";
$checkStmt = $pdo->prepare($checkSql);
$checkStmt->execute(['userId' => $userId]);

$count = $checkStmt->fetchColumn(); 

if ($count > 0) {
    echo "<script>
        alert('중복 아이디입니다. 다른 아이디를 입력해주세요.');
        history.back();
    </script>";
    exit;
}

$insertSql = "
    INSERT INTO `member` 
    (`user_id`, `user_pw`, `user_name`, `user_email`, `user_reg_datetime`) 
    VALUES (:userId, :userPw, :userName, :userEmail, NOW())
";
$insertStmt = $pdo->prepare($insertSql);
$insertStmt->execute([
    'userId' => $userId,
    'userPw' => $user_pw,
    'userName' => $user_name,
    'userEmail' => $user_email
]);

?>
<script>
    alert("성공적으로 회원가입이 완료되었습니다.");
    location.replace('./login.html'); 
</script>