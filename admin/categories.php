<?php 
  include '../functions.php';
  checkLogin();

 ?>


<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Categories &laquo; Admin</title>
 <?php include  'inc/css.php' ?>
  <script src="../assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  

  <div class="main">
   <?php  include 'inc/nav.php' ?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>分类目录</h1>
      </div>
      <!-- 有错误信息时展示 -->
       <div class="alert alert-danger" style="display:none">
        
      </div> 
      <div class="row">
        <div class="col-md-4">
          <form autocomplete="off" id='myForm'>
            <h2>添加新分类目录</h2>
            <div class="form-group"> 
              <label for="name">名称</label>
              <input id="name" class="form-control" name="name" type="text" placeholder="分类名称">
            </div>
            <div class="form-group">
              <label for="slug">别名</label>
              <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
              <p class="help-block">https://zce.me/category/<strong>slug</strong></p>
            </div>
            <div class="form-group">
              <input class="btn btn-primary" type="button" value="添加" id='update'>
            </div>
          </form>
        </div>
        <div class="col-md-8">
          <div class="page-action">
            <!-- show when multiple checked -->
            <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-center" width="40"><input type="checkbox"></th>
                <th>名称</th>
                <th>Slug</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>
            <tbody>
             
              
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <?php include 'inc/aside.php' ?>

 <?php include 'inc/script.php' ?>
  <script>NProgress.done()</script>
  <script  type="text/template" id=categoriesTmp>
  {{each data as val key}}
     <tr>
        <td class="text-center"><input type="checkbox" value="{{val.id}}"></td>
        <td>{{val.name}}</td>
        <td>{{val.slug}}</td>
        <td class="text-center">
          <a href="javascript:;" class="btn btn-info btn-xs edit" data-id="{{val.id}}" >编辑</a>
          <a href="javascript:;" class="btn btn-danger btn-xs delete" data-id="{{val.id}}" >删除</a>
        </td>
    </tr>
  {{/each}}
  
  </script>
  <script type="text/template" id="categoriesEditTmp">
    <h2>编辑分类目录</h2>
            <input type="hidden" name="id" value="{{data[0].id}}">
            <div class="form-group"> 
              <label for="name">名称</label>
              <input id="name" class="form-control" name="name" type="text" placeholder="分类名称" value="{{data[0].name}}">
            </div>
            <div class="form-group">
              <label for="slug">别名</label>
              <input id="slug" class="form-control" name="slug" type="text" placeholder="slug" value="{{data[0].slug}}">
              <p class="help-block">https://zce.me/category/<strong>slug</strong></p>
            </div>
            <div class="form-group">
              <input class="btn btn-primary" type="button" value="完成编辑" id='editComplete'>
            </div>
  
  </script>
</body>
<script>
//一开始就要从后台获取数据并且渲染页面
  render();
  function render(){
    $.ajax({
    type:'get',
    url:'./int/categoriesList.php',
    dataType:'json',
    success:function(res){
      // console.log(res['data']);
      var htmlStr=template('categoriesTmp',res);
      $('tbody').html(htmlStr);
    }
  })
  }
  //为更新按钮添加点击事件，并且渲染在页面上
  $('#update').on('click',function(){
    var data=$('#myForm').serialize();
    console.log(data)
    
    $.ajax({
      type:'post',
      url:'./int/categoriesList.php',
      data:data,
      dataType:'json',
      success:function(res){
        if(res&& res.code==200){
          render();
         
          $('.alert-danger').fadeIn().delay(2000).fadeOut().html('<strong>'+res.msg+'</strong>')
        }else{
          $('.alert-danger').fadeIn().delay(2000).fadeOut().html('<strong>'+res.msg+'</strong>')
        }
      }
    })
  })
  //为删除按钮添加点击事件，删除后重新渲染页面
  $('tbody').on('click','.delete',function(){
    var id=$(this).attr('data-id');
    console.log(id);
    $.ajax({
      type:"get",
      url:"int/categoriesDel.php",
      data:{
        id:id
      },
      dataType:'json',
      success:function(res){
        if(res&&res.code==100){
            render();
             $('.alert-danger').fadeIn().delay(2000).fadeOut().html('<strong>'+res.msg+'</strong>')
        }else{
           $('.alert-danger').fadeIn().delay(2000).fadeOut().html('<strong>'+res.msg+'</strong>')
        }
      }
    })
  })
   //为编辑按钮添加点击事件，并把当前需要编辑的项的内容渲染出来
  $('tbody').on('click','.edit',function(){
    
    var id=$(this).attr('data-id');
    $.ajax({
      type:'get',
      url:'int/categoriesEdit.php',
      data:{
        id:id
      },
      dataType:'json',
      success:function(res){
        if(res&&res.code==300){
          
           var htmlStr=template('categoriesEditTmp',res)
            $('#myForm').html(htmlStr);
            
        }
      }
    })
  })
  //编辑后点击完成按钮
  $('#myForm').on('click','#editComplete',function(){
    var data=$('#myForm').serialize();
    
    $.ajax({
      type:'post',
      url:'int/categoriesEdit.php',
      data:data,
      dataType:'json',
      success:function(res){
        if(res&&res.code==400){
            render();
             $('.alert-danger').fadeIn().delay(2000).fadeOut().html('<strong>'+res.msg+'</strong>')
        }else{
           $('.alert-danger').fadeIn().delay(2000).fadeOut().html('<strong>'+res.msg+'</strong>')
        }

      }

    })
  })
</script>
</html>
