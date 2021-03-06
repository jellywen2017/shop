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
$(function(){searchRes(1)});

function searchRes(page_id){
  var dataset = {status: $('#status').val(), email: $('#email').val()};
  
  $.asynList("<?php echo url(array('m'=>$MOD, 'c'=>'email_subscription', 'a'=>'index', 'step'=>'search', ));?>", dataset, function(data){
    if(data.status == 'success'){
      juicer.register('format_date', function(v){return formatTimestamp(v, 'y-m-d');});
      juicer.register('status_text', function(v){return statusMap(v)});
      $('#rows').append(juicer($('#table-tpl').html(), data));
      $('#rows tr').vdsRowHover();
      $('#rows tr:even').addClass('even');
      if(data.paging != null) $('#rows').append(juicer($('#paging-tpl').html(), data));
    }else{
      $('#rows').append("<div class='nors mt5'>未找到相关数据记录...</div>");
    }
  });
}

function statusMap(status){
  var color = 'caaa';
  switch(status){
    case '0': color = 'red'; break;
    case '1': color = 'c666'; break;
    case '2': color = 'c999'; break;
  }
  var text = $('#status option[value="'+status+'"]').text();
  if(text == '') return '<font class="'+color+'">Unknown</font>'; else return '<font class="'+color+'">'+text+'</font>';
}

function pageturn(page_id){searchRes(page_id);}
</script>
</head>
<body>
<div class="content">
  <div class="loc"><h2><i class="icon"></i>订阅列表</h2></div>
  <div class="box">
    <div class="doacts">
      <a class="ae btn" onclick="domulent('<?php echo url(array('m'=>$MOD, 'c'=>'email_subscription', 'a'=>'status', 'status'=>'1', ));?>')"><i class="accept"></i><font>确认</font></a>
      <a class="ae btn" onclick="domulent('<?php echo url(array('m'=>$MOD, 'c'=>'email_subscription', 'a'=>'status', 'status'=>'2', ));?>')"><i class="forbid"></i><font>退订</font></a>
      <a class="ae btn" onclick="domulent('<?php echo url(array('m'=>$MOD, 'c'=>'email_subscription', 'a'=>'delete', ));?>')"><i class="remove"></i><font>删除</font></a>
    </div>
    <div class="stools mt5">
      <select id="status" class="slt">
        <option value="" selected="selected">全部状态</option>
        <?php $_foreach_v_counter = 0; $_foreach_v_total = count($status_map);?><?php foreach( $status_map as $k => $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
        <option value="<?php echo htmlspecialchars($k, ENT_QUOTES, "UTF-8"); ?>"><?php echo htmlspecialchars($v, ENT_QUOTES, "UTF-8"); ?></option>
        <?php endforeach; ?>
      </select>
      <input type="text" class="w300 txt" id="email" placeholder="输入邮箱地址" />
      <button type="button" class="sbtn btn" onclick="searchRes(1)">搜 索</button>
    </div>
    <div class="module mt5" id="rows"></div>
  </div>
</div>
<script type="text/template" id="table-tpl">
<form method="post" id="mulentform">
  <table class="datalist">
    <tr>
      <th width="60" colspan="2">编号</th>
      <th class="ta-l">邮箱地址</th>
      <th width="100">加入日期</th>
      <th width="140">状态</th>
    </tr>
    {@each list as v}
    <tr>
      <td width="20"><input name="id[]" type="checkbox" value="${v.id}" /></td>
      <td width="40">${v.id}</td>
      <td class="ta-l">${v.email}</td>
      <td class="c888">$${v.created_date|format_date}</td>
      <td class="red">$${v.status|status_text}</td>
    </tr>
    {@/each}
  </table>
</form>
</script>
<?php include $_view_obj->compile('backend/lib/paging.html'); ?>
<script type="text/javascript" src="public/script/juicer.js"></script>
</body>
</html>