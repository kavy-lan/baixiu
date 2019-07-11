<?php 
    include '../functions.php';
    checkLogin();

 ?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Comments &laquo; Admin</title>
  <?php include  'inc/css.php' ?>
  <script src="../assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>


  <div class="main">
  <?php include 'inc/nav.php' ?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>所有评论</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="page-action">
        <!-- show when multiple checked -->
        <div class="btn-batch" style="display: none">
          <button class="btn btn-info btn-sm">批量批准</button>
          <button class="btn btn-warning btn-sm">批量拒绝</button>
          <button class="btn btn-danger btn-sm">批量删除</button>
        </div>
        <ul class="pagination pagination-sm pull-right " id='commentsList'>
          
        </ul>
      </div>
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-center" width="40"><input type="checkbox"></th>
            <th>作者</th>
            <th>评论</th>
            <th>评论在</th>
            <th>提交于</th>
            <th>状态</th>
            <th class="text-center" width="100">操作</th>
          </tr>
        </thead>
        <tbody>
          <tr class="danger">
            <td class="text-center"><input type="checkbox"></td>
            <td>大大</td>
            <td>楼主好人，顶一个</td>
            <td>《Hello world》</td>
            <td>2016/10/07</td>
            <td>未批准</td>
            <td class="text-center">
              <a href="post-add.html" class="btn btn-info btn-xs">批准</a>
              <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
            </td>
          </tr>
          <tr>
            <td class="text-center"><input type="checkbox"></td>
            <td>大大</td>
            <td>楼主好人，顶一个</td>
            <td>《Hello world》</td>
            <td>2016/10/07</td>
            <td>已批准</td>
            <td class="text-center">
              <a href="post-add.html" class="btn btn-warning btn-xs">驳回</a>
              <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
            </td>
          </tr>
          <tr>
            <td class="text-center"><input type="checkbox"></td>
            <td>大大</td>
            <td>楼主好人，顶一个</td>
            <td>《Hello world》</td>
            <td>2016/10/07</td>
            <td>已批准</td>
            <td class="text-center">
              <a href="post-add.html" class="btn btn-warning btn-xs">驳回</a>
              <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

<?php include 'inc/aside.php' ?>

 <?php include 'inc/script.php' ?>
  <script>NProgress.done()</script>
  <script src="../assets/vendors/twbs-pagination/jquery.twbsPagination.min.js"></script>
  <script>
     $('#commentsList').twbsPagination({
        totalPages: 10,   // 总页数
        visiblePages: 7,  // 当前显示的页码数
        initiateStartPageClick:false, // 一开始渲染的时候，默认先不触发事件
        onPageClick: function (event, page) {
           // console.log("page:"+page);
           // 将当前单击的页码数传递给后台,让后台查询此页码下面的数据，返回给浏览器
           
          //  page1 = page;
          //  console.log(page1);
          //  render1(page1);
        }
    });

    $.ajax({
      type:'get',
      url:'int/commentsList.php',
      dataType:'json',
      success:function(res){
        console.log(res);
      }
    })
  </script>
</body>
</html>
