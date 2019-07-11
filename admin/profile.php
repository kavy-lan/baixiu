<?php 
  include '../functions.php';
  checkLogin();
  // print_r($_SESSION['userInfo']);
  $id=$_SESSION['userInfo']['id'];
  echo $id;


 ?>




<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Dashboard &laquo; Admin</title>
 <?php include  './inc/css.php' ?>
  <script src="../assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>


  <div class="main">
 <?php include './inc/nav.php' ?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>我的个人资料</h1>
      </div>
      <!-- 有错误信息时展示 -->
       <div class="alert alert-danger" style="display:none ">
        <strong> 错误！</strong> 
      </div> 
      <form class="form-horizontal">
        <div class="form-group">
        <input type="hidden" name="id" value='<?php echo $id ?>'>
          <label class="col-sm-3 control-label">头像</label>
          <div class="col-sm-6">
            <label class="form-image">
              <input id="avatar" type="file" >
              <input type="file" value="提交">       
              <img src="../assets/img/default.png">
              <i class="mask fa fa-upload"></i>
            </label>
          </div>
        </div>
        <div class="form-group">
          <label for="email" class="col-sm-3 control-label">邮箱</label>
          <div class="col-sm-6">
            <input id="email" class="form-control" name="email" type="type" value="w@zce.me" placeholder="邮箱" readonly>
            <p class="help-block">登录邮箱不允许修改</p>
          </div>
        </div>
        <div class="form-group">
          <label for="slug" class="col-sm-3 control-label">别名</label>
          <div class="col-sm-6">
            <input id="slug" class="form-control" name="slug" type="type" value="zce" placeholder="slug">
            <p class="help-block">https://zce.me/author/<strong>zce</strong></p>
          </div>
        </div>
        <div class="form-group">
          <label for="nickname" class="col-sm-3 control-label">昵称</label>
          <div class="col-sm-6">
            <input id="nickname" class="form-control" name="nickname" type="type" value="汪磊" placeholder="昵称">
            <p class="help-block">限制在 2-16 个字符</p>
          </div>
        </div>
        <div class="form-group">
          <label for="bio" class="col-sm-3 control-label">简介</label>
          <div class="col-sm-6">
            <textarea id="bio" name="bio" class="form-control" placeholder="Bio" cols="30" rows="6">MAKE IT BETTER!</textarea>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-6">
            <input type="button" class="btn btn-primary" value='更新'>
            <a class="btn btn-link" href="password-reset.html">修改密码</a>
          </div>
        </div>
      </form>
    </div>
  </div>

  <?php include './inc/aside.php' ?>

 <?php   include './inc/script.php' ?>

</body>
</html>
<script>
//发送请求获取数据库数据进行渲染数据
var id=$('input[type=hidden]').val();

  $.ajax({
    type:'get',
    url:'./int/profileInt.php',
    data:{
      id:id
    },
    dataType:'json',
    success:function(res){
      // console.log(res.data[0].avatar)
      if(res&&res.code=='100')
      $('.form-image img').attr('src',res.data[0].avatar);
       $('#email').val(res.data[0].email);
      $('#slug').val(res.data[0].slug);
      $('#nickname').val(res.data[0].nickname);
      $('#bio').val(res.data[0].bio);
    }
  })

  //创建change事件，当input发生改变的时候执行
  $('#avatar').on('change',function(){
    //创建异步对象
     var xhr=new XMLHttpRequest;
    //  FormData对象，可以把所有表单元素的name与value组成一个queryString，提交到后台。只需要把 form 表单作为参数传入 FormData 构造函数即可：
     var data=new  FormData();
    //  console.log(this.files[0])
    // console.log(data);
    // 将上传的文件信息放到formdata里面
     data.append('avatar',this.files[0]);
     //设置请求行
     xhr.open('post','./int/profileInt.php');
     //设置请求体
     xhr.send(data);

     xhr.onreadystatechange=function(){
       if(xhr.status==200&& xhr.readyState==4){
         //因为传回来的数据是字符串类型的，需要转为对象类型
         var res=JSON.parse(xhr.responseText);
         $('.form-image img').attr('src',res.data);
       }
     }

  
  })

  //点击更新按钮时创建事件
  $('.btn-primary').on('click',function(){
    var data=$('.form-horizontal').serialize();
    console.log(data)
    
    $.ajax({
      type:'post',
      url:'int/profileInt.php',
      data:data,
      dataType:'json',
      success:function(res){
        if(res&&res.code==20){
           $('.alert-danger').fadeIn().delay(2000).fadeOut().html('<strong>'+res.msg+'</strong>')
        }

      }
    })
  })
 

</script>