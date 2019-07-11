<?php 
  /**
   * 在这里要开启一个验证,只有登陆了的用户才可以进到这个页面来访问
   * 如果没有登陆的话,得先跳转到登陆页面
   */
  // session_start();// 先开启session
  // if(!isset($_SESSION['userInfo'])){
  //   // 跳转到登陆页面
  //   header('location:./login.php');
  // }

  include '../functions.php';
   checkLogin();   // 调用函数检测是否登陆
 ?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Dashboard &laquo; Admin</title>
  <?php include './inc/css.php' ?>
  <?php include './inc/script.php' ?>
</head>
<body>
  <script>NProgress.start()</script>
  <div class="main">

    <!-- 引入顶部的导航文件 -->
    <?php include './inc/nav.php' ?>
    <div class="container-fluid">
      <div class="jumbotron text-center">
        <h1>One Belt, One Road</h1>
        <p>Thoughts, stories and ideas.</p>
        <p><a class="btn btn-primary btn-lg" href="post-add.html" role="button">写文章</a></p>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">站点内容统计：</h3>
            </div>
            <ul class="list-group">
              <li class="list-group-item"><strong>10</strong>篇文章（<strong>2</strong>篇草稿）</li>
              <li class="list-group-item"><strong>6</strong>个分类</li>
              <li class="list-group-item"><strong>5</strong>条评论（<strong>1</strong>条待审核）</li>
            </ul>
          </div>
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-4"></div>
      </div>
    </div>
  </div>
  
  <!-- 引入侧边栏的文件 -->
  <?php include './inc/aside.php' ?>

 
  <script>NProgress.done()</script>
</body>
</html>
