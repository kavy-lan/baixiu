<?php 
  include '../functions.php';
  checkLogin();

 ?>


<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Add new post &laquo; Admin</title>
 <?php   include 'inc/css.php' ?>
  <script src="../assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>


  <div class="main">
  <?php  include  'inc/nav.php' ?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>写文章</h1>
      </div>
      <!-- 有错误信息时展示 -->
        <div class="alert alert-danger" style="display:none">
        <!-- <strong>错误！</strong>发生XXX错误 -->
      </div>  
      <form class="row">
        <input type="hidden" name="feature" class='hidden'>
        <div class="col-md-9">
          <div class="form-group">
            <label for="title">标题</label>
            <input id="title" class="form-control input-lg" name="title" type="text" placeholder="文章标题">
          </div>
          <div class="form-group">
            <label for="content">标题</label>
            <textarea id="content"  name="content" cols="30" rows="10" placeholder="内容"></textarea>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="slug">别名</label>
            <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
            <p class="help-block">https://zce.me/post/<strong>slug</strong></p>
          </div>
          <div class="form-group">
            <label for="feature">特色图像</label>
            <!-- show when image chose -->
            <img class="help-block thumbnail" style="display: none">
            <input id="feature" class="form-control" name="feature" type="file">
          </div>
          <div class="form-group">
            <label for="category">所属分类</label>
            <select id="category" class="form-control" name="category_id">
             
            </select>
          </div>
          <div class="form-group">
            <label for="created">发布时间</label>
            <input id="created" class="form-control" name="created" type="datetime-local">
          </div>
          <div class="form-group">
            <label for="status">状态</label>
            <select id="status" class="form-control" name="status">
              <option value="drafted">草稿</option>
              <option value="published">已发布</option>
            </select>
          </div>
          <div class="form-group">
            <input class="btn btn-primary" type="button" value="保存" id="save">
          </div>
        </div>
      </form>
    </div>
  </div>

 <?php include 'inc/aside.php' ?>

  <?php include 'inc/script.php' ?>
  <script>NProgress.done()</script>
  <script src="../UEditor/ueditor/ueditor.config.js"></script>
  <script src="../UEditor/ueditor/ueditor.all.min.js"></script>
  
  <script type="text/template" id='nameTmp'>
    {{each data as val key}}
     <option value="{{val.id}}" >{{val.name}}</option>
    {{/each}}        
  </script>
</body>
<script>
  //开启富文本编辑器
  var ue = UE.getEditor('content');
  //发送请求渲染页面
  $.ajax({
    type:'get',
    url:'int/post-addInt.php',
    dataType:'json',
    success:function(res){
      // console.log(res.data);
      if(res&&res.code==100){
          var htmlStr=template('nameTmp',res);
          $('#category').html(htmlStr);
      }
    }
  })
  $('#feature').on('change',function(){
    var data= new FormData();
    // console.log(this.files[0])
    data.append('feature',this.files[0]);
    $.ajax({
      type:'post',
      url:'int/post-addInt.php',
      data:data,
      contentType:false,
      dataType:'json',
      processData:false,
      success:function(res){
        if(res&&res.code==200){
          
          $('.alert-danger').fadeIn().delay().fadeOut().html( '<strong>'+res.msg+'</strong>')
          $('.thumbnail').show().attr('src',res.data);
          $('.hidden').val(res.data);
        }else{
          $('.alert-danger').fadeIn().delay().fadeOut().html( '<strong>'+res.msg+'</strong>')
        }
      }
    })
  })
  //将所有数据保存到数据库
  $('#save').on('click',function(){
      var data=$('.row').serialize();
      $.ajax({
        type:'post',
        url:'int/post-addInt.php',
        data:data,
        dataType:'json',
        success:function(res){
            if(res&&res.code==300){
          
          $('.alert-danger').fadeIn().delay(2000).fadeOut().html( '<strong>'+res.msg+'</strong>');
          window.location.href='./posts.php';
         
        }else{
          $('.alert-danger').fadeIn().delay(2000).fadeOut().html( '<strong>'+res.msg+'</strong>')
        }
        }
      })
  })

  $('')
  
</script>
</html>
