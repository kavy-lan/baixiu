<?php  
  /**
   * 登陆实现的思路：
   * 1. 判断请求的方式是不是post
   * 2. 获取发送过来的email和password
   * 3. 查询数据库中有没有当前的email账号
   * 4. 如果账号存在并且密码也正确则跳转到index.php页面
   * 5. 如果账号不存在，则提示用户用户不存在
   */
  
  // 1. 判断请求的方式是不是post请求
  if($_SERVER['REQUEST_METHOD']=='POST'){

    // 2. 获取过来的账号
    $email = $_POST['email'];

    // echo $email;

    // 3. 获取提交过来的密码
    $pass = $_POST['password'];

    // 下面需要判断用户名和密码是否正确
    // 4. 先连接数据库
    $conn = mysqli_connect('127.0.0.1','root','root','baixiu');

    // 5. 判断是否成功
    if(!$conn){
      $msg = '数据库连接失败...';
    }else {
      // 6. 查询email是否存在   如果查询成功,则结果集中只有一条数据
      // 注意sql语句当中,字符串类型一定要加引号
     $result = mysqli_query($conn, "select * from users where email = '$email'");

   
     // 7. 判断是否成功
     if(mysqli_num_rows($result)==0){
      $msg = '用户名不存在';
     }else {
      $row = mysqli_fetch_assoc($result);  // 查询结果集中的数据,调用一次查询一次
      // print_r($row);
      // Array
      // (
      //     [id] => 1
      //     [slug] => admin
      //     [email] => admin@baixiu.com
      //     [password] => 123456
      //     [nickname] => 管理员
      //     [avatar] => /static/uploads/avatar.jpg
      //     [bio] => 
      //     [status] => activated
      // )
        if($row['password']==$pass){
          // 如果成立 说明密码是正确的   要设置session
          session_start();// 先开启session
          $_SESSION['userInfo'] = $row; // 将查询到的这个数据存在session里面,将生成的唯一的SESSIONID跟随响应头一并返回给浏览器
          header('location:./index.php');
        }else {
          $msg = '密码错误...';
        }
        // exit;
     }
    }

  }
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Sign in &laquo; Admin</title>
  <link rel="stylesheet" href="../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
  <div class="login">
    <form class="login-wrap" action="<?php echo $_SERVER['PHP_SELF']?>" method='post' autocomplete='off'>
      <img class="avatar" src="../assets/img/default.png">
      <!-- 有错误信息时展示 -->
      <?php if(isset($msg)){ ?>
        <div class="alert alert-danger">
          <strong><?php echo $msg ?></strong> 
        </div>
      <?php } ?>
      <div class="form-group">
        <label for="email" class="sr-only">邮箱</label>
        <input id="email" type="email" name="email" class="form-control" placeholder="邮箱" autofocus value="kahone@123.com">
      </div>

      <div class="form-group">
        <label for="password" class="sr-only">密码</label>
        <input id="password" type="password" name="password" class="form-control" placeholder="密码" value="wanglei">
      </div>
      <input class="btn btn-primary btn-block" type="submit" value="登  陆">
    </form>
  </div>
</body>
</html>
