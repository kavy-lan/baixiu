<?php 
  /**
   * 开启session的验证
   */
  // session_start();
  // if(!isset($_SESSION['userInfo'])){
  //   header('location:./login.php');// 如果没有登陆的话，得先跳转到登陆页面
  // }

  include '../functions.php';
  checkLogin();
 ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Users &laquo; Admin</title>
  <?php include './inc/css.php' ?>
  <?php include './inc/script.php' ?>
</head>
<body>
  <script>NProgress.start()</script>
  <div class="main">
   <?php include './inc/nav.php' ?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>用户</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <div class="alert alert-danger" style="display:none">
        <strong>错误！</strong>发生XXX错误
      </div>
      <div class="row">
        <div class="col-md-4">
          <form id="myForm">
            <h2>添加新用户</h2>
            <div class="form-group">
              <label for="email">邮箱</label>
              <input id="email" class="form-control" name="email" type="email" placeholder="邮箱">
            </div>
            <div class="form-group">
              <label for="slug">别名</label>
              <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
              <p class="help-block">https://zce.me/author/<strong>slug</strong></p>
            </div>
            <div class="form-group">
              <label for="nickname">昵称</label>
              <input id="nickname" class="form-control" name="nickname" type="text" placeholder="昵称">
            </div>
            <div class="form-group">
              <label for="password">密码</label>
              <input id="password" class="form-control" name="password" type="text" placeholder="密码">
            </div>
            <div class="form-group">
              <!-- <button class="btn btn-primary" type="submit">添加</button> -->
             <input type="button" class="btn btn-primary" id="btnAdd" value="添 加">
            </div>
          </form>
        </div>
        <div class="col-md-8">
          <div class="page-action">
            <!-- show when multiple checked -->
            <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none" id='delAll'>批量删除</a>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
               <tr>
                <th class="text-center" width="40"><input type="checkbox" id="sleAll"></th>
                <th class="text-center" width="80">头像</th>
                <th>邮箱</th>
                <th>别名</th>
                <th>昵称</th>
                <th>状态</th>
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

  <?php include './inc/aside.php' ?>
  <script>NProgress.done()</script>
</body>
</html>
<!-- 这是右侧用户数据渲染的模板 -->
<script type="text/template" id="userListTmp">
  {{each data as val key}}
     <tr>
        <td class="text-center"><input type="checkbox" class='Chk'  value="{{val.id}}" ></td>
        <td class="text-center"><img class="avatar" src="{{val.avatar}}"></td>
        <td>{{val.email}}</td>
        <td>{{val.slug}}</td>
        <td>{{val.nickname}}</td>
        {{if val.status=='activated' }}
          <td>激活</td>
        {{else if val.status=='unactivated'}}
          <td>未激活</td>
        {{else if val.status=='forbidden'}}
          <td>禁止</td>
        {{else}}
          <td>废弃</td>
        {{/if}}
        <td class="text-center">
          <button class="btn btn-default btn-xs btnEdit" data-id="{{val.id}}">编辑</button>
          <a href="javascript:;" data-id="{{val.id}}" class="btn btn-danger btn-xs" id="btnDel">删除</a>
        </td>
      </tr>
  {{/each}}
</script>
<script  type="text/template" id="userAddTmp">
  <h2>添加新用户</h2>
            <div class="form-group">
              <label for="email">邮箱</label>
              <input id="email" class="form-control" name="email" type="email" placeholder="邮箱">
            </div>
            <div class="form-group">
              <label for="slug">别名</label>
              <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
              <p class="help-block">https://zce.me/author/<strong>slug</strong></p>
            </div>
            <div class="form-group">
              <label for="nickname">昵称</label>
              <input id="nickname" class="form-control" name="nickname" type="text" placeholder="昵称">
            </div>
            <div class="form-group">
              <label for="password">密码</label>
              <input id="password" class="form-control" name="password" type="text" placeholder="密码">
            </div>
            <div class="form-group">
              <!-- <button class="btn btn-primary" type="submit">添加</button> -->
             <input type="button" class="btn btn-primary" id="btnAdd" value="添 加">
            </div>

</script>

<!-- 这是编辑时的模板 -->
<script type="text/template"  id='userEdiTmp'>

            <h2>编辑用户</h2>
             <input type="hidden" name="id" value="{{data[0].id}}">
            <div class="form-group">
              <label for="email">邮箱</label>
              <input id="email" class="form-control" name="email" type="email" placeholder="邮箱" value='{{data[0].email}}'>
            </div>
            <div class="form-group">
              <label for="slug">别名</label>
              <input id="slug" class="form-control" name="slug" type="text" placeholder="slug" value='{{data[0].slug}}'>
              <p class="help-block">https://zce.me/author/<strong>slug</strong></p>
            </div>
            <div class="form-group">
              <label for="nickname">昵称</label>
              <input id="nickname" class="form-control" name="nickname" type="text" placeholder="昵称" value='{{data[0].nickname}}'>
            </div>
            
            <div class="form-group">
              <!-- <button class="btn btn-primary" type="submit">添加</button> -->
             <input type="button" class="btn btn-primary" id="btnEdit" value="修 改">
            </div>
</script>

<script type="text/javascript">

  // 这是一开始页面跳转过来的时候的渲染
  render();
  function render(){
     $.ajax({
      type:'get',
      url:'./int/usersList.php',
      dataType:'json',
      success:function(res){
        console.log(res);
        console.log(typeof res);
        if(res&&res.code==10000){
          // 准备模板字符串
          var htmlStr = template('userListTmp',res);

          $('tbody').html(htmlStr); // 渲染页面
        }
      }
    })
  }

  // 添加的操作
  $('#btnAdd').on('click',function () {

    // 获取页面中的数据
     var data = $('#myForm').serialize();//此方法会将form标签中所有具有name属性的input标签的值一并获取到,拼接成键值对象的字符串
     // email=aa@aa.com&slug=aaa&nickname=aaa
    $.ajax({
      type:'post',
      url:'./int/userAdd.php',
      data: data,
      dataType:'json',
      success:function(res){
        if(res&&res.code==10000){
          render();
        }
      }
    })
  })

  // 删除操作                               
  // $('#btnDel').on('click',function () {
  //   alert(123);  这种方式注册事件不起作用,因为模板中的相当于是动态创建出来的标签,得使用委托的方式来注册事件
  // })
 
  // 一定要通过委托的方式来注册事件,也就是给父级元素注册事件
  $('tbody').on('click',"#btnDel",function () {
    // alert(123);
    $.ajax({
      type:'get',
      url:'./int/userDel.php',
      data:{
        id: $(this).attr('data-id')  // attr  prop 
      },
      dataType:'json',
      success:function(res){
        if(res&&res.code==10000){
          // 重新渲染页面
          render();
         
        }
      }
    })
  })

  // 编辑用户之页面渲染
  //给编辑按钮注册事件发送ajax请求
  $('tbody').on('click','.btnEdit',function(){

        var id=$(this).attr('data-id');
        $.ajax({
          type:'get',
          url:'./int/userEdit.php',
          dataType:'json',
          data:{
            id:id
          },
          success:function(res){
            if(res.code==10){
              // console.log(res.data[0]);
               var htmlStr=template('userEdiTmp',res);
                $('#myForm').html(htmlStr);
     
            }
          }

        })
   
       

  })

  //给修改按钮添加点击事件
  $('#myForm').on('click','#btnEdit',function(){
   var data=$('#myForm').serialize();

   $.ajax({
     type:'post',
     url:'./int/userEdit.php',
     data:data,
     dataType:'json',
     success:function(res){
       if(res&&res.code=='10'){
        //  更新完毕以后重新渲染页面
         render();
         //清空输入框里面的内容
          $('#myForm input').val('');
          // 编辑完成以后转换为原本的添加页面
          var htmlStr=template('userAddTmp',{});
          $('#myForm').html(htmlStr);

       }
     }
   })
  })

  //当有两个以上被选择时，删除全部按钮出现,并且全选框被勾上
  $('tbody').on('click','.Chk',function(){
    var num=$('.Chk:checked').size();
    
    if(num>=2){
      $('#delAll').show();
    }else{
       $('#delAll').hide();
    }
    var all=$('.Chk').size();
    
    if(num==all){
      $('#sleAll').prop('checked',true)
    }else{
      $('#sleAll').prop('checked',false)
    }
  })
  //勾选全选框时，单选框全部被选上
  $('#sleAll').on('click',function(){
      flag=$(this).prop('checked');
      $('.Chk').prop('checked',flag)
      if(flag){
         $('#delAll').show();
      }else{
         $('#delAll').hide();
      }
  })
  //点击删除全部按钮的时候，发送ajax请求
  $('#delAll').on('click',function(){
    var ids=[];
    $('.Chk:checked').each(function(index,ele){
      ids.push($(this).val());
    })
    $.ajax({
      type:'post',
      url:'./int/userDel.php',
      data:{
        ids:ids
      },
      dataType:'json',
      success:function(res){
        if(res&&res.code==10){
         
          render();
        }
      }
    })
  })

</script>
