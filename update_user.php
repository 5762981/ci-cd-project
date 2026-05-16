<?php
include "db.php";

$originalId = $_POST['originalUserId'];
$newId = $_POST['newUserId'];
$name = $_POST['userName'];
$email = $_POST['userEmail'];
$pw = $_POST['userPw'];

if ($originalId !== $newId) {
    $checkSql = "SELECT COUNT(*) FROM `member` WHERE `user_id` = :newId";
    $checkStmt = $pdo->prepare($checkSql);
    $checkStmt->execute(['newId' => $newId]);
    
    if ($checkStmt->fetchColumn() > 0) {
        echo "<script>
            alert('중복 아이디입니다. 다른 아이디를 입력해주세요.');
            history.back();
        </script>";
        exit;
    }
}

$sql = "
    UPDATE `member` 
    SET `user_id` = :newId, `user_name` = :name, `user_email` = :email, `user_pw` = :pw 
    WHERE `user_id` = :originalId
";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'newId' => $newId,
    'name' => $name,
    'email' => $email,
    'pw' => $pw,
    'originalId' => $originalId
]);

?>
<script>
    alert("성공적으로 회원 정보가 수정되었습니다.");
    location.replace('./admin_users.php'); 
</script>