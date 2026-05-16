<?php
include "db.php";

$userId = $_POST['userId'];
$sql = "SELECT * FROM `member` WHERE `user_id` = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $userId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "<script>alert('존재하지 않는 회원입니다.'); history.back();</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <title>회원 정보 수정</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <main class="page">
    <section class="card">
      <h1>회원 수정</h1>
      <p class="desc">회원 정보를 수정합니다.</p>

      <form action="update_user.php" method="post" id="editForm">
        <input type="hidden" name="originalUserId" value="<?php echo $user['user_id']; ?>">
        
        <div class="form-group">
          <label for="newUserId">아이디</label>
          <input type="text" id="newUserId" name="newUserId" value="<?php echo $user['user_id']; ?>" required>
        </div>

        <div class="form-group">
          <label for="userName">이름</label>
          <input type="text" id="userName" name="userName" value="<?php echo $user['user_name']; ?>" required>
        </div>

        <div class="form-group">
          <label for="userEmail">이메일</label>
          <input type="email" id="userEmail" name="userEmail" value="<?php echo $user['user_email']; ?>" required>
        </div>

        <div class="form-group">
          <label for="userPw">비밀번호</label>
          <input type="password" id="userPw" name="userPw" value="<?php echo $user['user_pw']; ?>" required>
        </div>

        <div class="form-group">
          <label for="userPwCheck">비밀번호 확인</label>
          <input type="password" id="userPwCheck" name="userPwCheck" placeholder="비밀번호를 한 번 더 입력하세요" required>
        </div>

        <button class="btn" type="submit">수정하기</button>
      </form>
    </section>
  </main>

  <script>
    document.getElementById('editForm').addEventListener('submit', function(event) {
      const pw = document.getElementById('userPw').value;
      const pwCheck = document.getElementById('userPwCheck').value;

      if (pw !== pwCheck) {
        alert("비밀번호가 일치하지 않습니다. 다시 확인해주세요.");
        event.preventDefault();
      }
    });
  </script>
</body>
</html>