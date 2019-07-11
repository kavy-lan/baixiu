<?php 
  include '../functions.php';
  checkLogin();

 ?>


<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Posts &laquo; Admin</title>
 <?php  include 'inc/css.php' ?>

</head>
<body>


  <div class="main">
 <?php include 'inc/nav.php' ?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>所有文章</h1>
        <a href="post-add.html" class="btn btn-primary btn-xs">写文章</a>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="page-action">
        <!-- show when multiple checked -->
        <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
        <form class="form-inline">
          <select name="" class="form-control input-sm">
            <option value="">所有分类</option>
            <option value="">未分类</option>
          </select>
          <select name="" class="form-control input-sm">
            <option value="">所有状态</option>
            <option value="">草稿</option>
            <option value="">已发布</option>
          </select>
          <button class="btn btn-default btn-sm">筛选</button>
        </form>
        <ul class="pagination pagination-sm pull-right">
          <li><a href="#">上一页</a></li>
          <li><a href="#">1</a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">下一页</a></li>
        </ul>
      </div>
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-center" width="40"><input type="checkbox"></th>
            <th>标题</th>
            <th>作者</th>
            <th>分类</th>
            <th class="text-center">发表时间</th>
            <th class="text-center">状态</th>
            <th class="text-center" width="100">操作</th>
          </tr>
        </thead>
        <tbody>
         
        
        </tbody>
      </table>
    </div>
  </div>

<?php include 'inc/aside.php' ?>

<?php include 'inc/script.php' ?>
 
  <script src="../assets/vendors/twbs-pagination/jquery.twbsPagination.min.js"></script>
  <script type="text/template" id="postsList">
  {{each data as val key}}
     <tr>
        <td class="text-center"><input type="checkbox"></td>
        <td>{{val.title}}</td>
        <td>{{val.slug}}</td>
        <td>{{val.name}}</td>
       
        <td class="text-center">{{val.created}}</td>
         {{if val.status=='published'}}
            <td class="text-center">已发布</td>
        {{else if val.status=='drafted'}}
            <td class="text-center">草稿</td>
        {{else if val.status=='trashed'}}
            <td class="text-center">废弃</td>
        {{/if}}
        <td class="text-center">
          <a href="javascript:;" class="btn btn-default btn-xs ">编辑</a>
          <a href="javascript:;" class="btn btn-danger btn-xs postDel" data-id="{{val.id}}" >删除</a>
        </td>
      </tr>
      {{/each}}
  </script>
</body>
<script>
  var page1=1;
  $.ajax({
    type:'get',
    url:'int/postsList.php',
    dataType:'json',
    success:function(res){
      if(res && res.code==200){
         pageCount = res.pageCount;
        var htmlStr=template('postsList',res);
        $('tbody').html(htmlStr);
        pageList();
        console.log(res);
      }
    }
  })
    function pageList(){
    // 2. 分页
   $('.pagination').twbsPagination({
        totalPages: pageCount,   // 总页数
        visiblePages: 7,  // 当前显示的页码数
        initiateStartPageClick:false, // 一开始渲染的时候，默认先不触发事件
        onPageClick: function (event, page) {
           // console.log("page:"+page);
           // 将当前单击的页码数传递给后台,让后台查询此页码下面的数据，返回给浏览器
           
           page1 = page;
           console.log(page1);
           render1(page1);
        }
    });
  }
    function render1(page){
     $.ajax({
        type:'get',
        url:'./int/postsList.php',
        data:{
          page:page
        },
        dataType:'json',
        success:function (res) {
          // 1. 准备模板字符串
          var htmlStr = template('postsList',res);
          // 2. 重新渲染页面
          $('tbody').html(htmlStr);
        }
       })
  }

  //点击删除按钮，实现删除该文章，并且重新渲染当前页面吧
$('tbody').on('click','.postDel',function(){
  var id=$(this).attr('data-id');
 
      $.ajax({
        type:'get',
        url:'int/postDelInt.php',
        data:{
          id:id
        },
        dataType:'json',
        success:function(res){
         if(res&&res.code==200){
          //  console.log(res);
          //重新渲染当前的页面，注意此处要用page1，因为最新的页面数已经赋值给page1
           render1(page1);
         }
        }
      })
})
  
</script>
</html>
