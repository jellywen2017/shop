<?php if(!class_exists("View", false)) exit("no direct access allowed");?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include $_view_obj->compile('backend/lib/meta.html'); ?>
<link rel="stylesheet" type="text/css" href="public/theme/backend/css/verydows.css" />
<link rel="stylesheet" type="text/css" href="public/theme/backend/css/main.css" />
<script type="text/javascript" src="public/script/jquery.js"></script>
<script type="text/javascript" src="public/theme/backend/js/verydows.js"></script>
<script type="text/javascript" src="public/theme/backend/js/list.js"></script>
<script type="text/javascript">
$(function(){searchRes(1);});

function searchRes(page_id){
  var dataset = {type: $('#type').val(), kw: $('#kw').val(), page:page_id, pernum:12};
  $.asynList("<?php echo url(array('m'=>$MOD, 'c'=>'user', 'a'=>'index', 'step'=>'search', ));?>", dataset, function(data){
    if(data.status == 'success'){
      juicer.register('format_date', function(v){return formatTimestamp(v, 'y-m-d<br />h:i:s');});
      $('#rows').append(juicer($('#table-tpl').html(), data));
      $('#rows tr').vdsRowHover();
      $('#rows tr:even').addClass('even');
      if(data.paging != null) $('#rows').append(juicer($('#paging-tpl').html(), data));
    }else{
      $('#rows').append("<div class='nors mt5'>未找到相关数据记录...</div>");	
    }     
  });
}

function pageturn(page_id){searchRes(page_id);}
</script>
</head>
<body>
<div class="content">
  <div class="loc"><h2><i class="icon"></i>用户列表</h2></div>
  <div class="box">
    <div class="doacts">
      <a class="ae btn" onclick="doslvent('<?php echo url(array('m'=>$MOD, 'c'=>'user', 'a'=>'view', ));?>', 'id')"><i class="user"></i><font>用户信息</font></a>
      <a class="ae btn" onclick="doslvent('<?php echo url(array('m'=>$MOD, 'c'=>'user', 'a'=>'view', 'step'=>'order', ));?>', 'id')"><i class="list"></i><font>订单记录</font></a>
      <a class="ae btn" onclick="doslvent('<?php echo url(array('m'=>$MOD, 'c'=>'goods_review', 'a'=>'index', ));?>', 'id', 'user_id')"><i class="cmt"></i><font>商品评价</font></a>
      <a class="ae btn" onclick="doslvent('<?php echo url(array('m'=>$MOD, 'c'=>'user', 'a'=>'view', 'step'=>'account', ));?>', 'id')"><i class="dols"></i><font>账户记录</font></a>
      <a class="ae btn" onclick="doslvent('<?php echo url(array('m'=>$MOD, 'c'=>'user', 'a'=>'view', 'step'=>'consignee', ));?>', 'id')"><i class="adr"></i><font>收件地址</font></a>
      <a class="ae btn" onclick="doslvent('<?php echo url(array('m'=>$MOD, 'c'=>'user', 'a'=>'delete', ));?>', 'id')"><i class="remove"></i><font>删除</font></a>
    </div>
    <div class="stools mt5">
      <select id="type" class="slt">
        <option value="0" selected="selected">用户名</option>
        <option value="1">邮箱</option>
      </select>
      <input type="text" class="w300 txt" id="kw" placeholder="输入用户名/邮箱" />
      <button type="button" class="sbtn btn" onclick="searchRes(1)">搜 索</button>
    </div>
    <div class="module mt5" id="rows"></div>
  </div>
</div>
<script type="text/template" id="table-tpl">
<table class="datalist">
  <tr>
    <th width="60" colspan="2">编号</th>
    <th class="ta-l">用户名</th>
    <th class="ta-l">邮箱</th>
    <th width="130">注册时间</th>
    <th width="130">最后登录时间</th>
    <th width="120">邮箱认证</th>
    <th width="120">用户状态</th>
  </tr>
  {@each list as v}
  <tr>
    <td width="20"><input name="id" type="checkbox" value="${v.user_id}" /></td>
    <td width="40">${v.user_id}</td>
    <td class="ta-l"><a class="blue" href="index.php?m=<?php echo htmlspecialchars($MOD, ENT_QUOTES, "UTF-8"); ?>&c=user&a=view&id=${v.user_id}">${v.username}</a></td>
    <td class="ta-l">${v.email}</td>
    <td class="c888">$${v.created_date|format_date}</td>
    <td class="c888">$${v.last_date|format_date}</td>
    <td>{@if v.email_status == 1}<i class="icon yes"></i>{@else}<i class="icon no"></i>{@/if}</td>
    <td>{@if v.status == 0}<font class="green">正常</font>{@else}<font class="red">限制</font>{@/if}</td>
  </tr>
  {@/each}
</table>
</script>
<?php include $_view_obj->compile('backend/lib/paging.html'); ?>
<script type="text/javascript" src="public/script/juicer.js"></script>
</body>
</html>