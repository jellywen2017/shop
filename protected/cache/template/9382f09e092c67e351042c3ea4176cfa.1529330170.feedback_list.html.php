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
//搜索反馈
function searchRes(page_id){
  var dataset = {type:$('#type').val(), status:$('#status').val()};
  $.asynList("<?php echo url(array('m'=>$MOD, 'c'=>'feedback', 'a'=>'index', 'step'=>'search', ));?>", dataset, function(data){
    if(data.status == 'success'){
      $('#rows').append(juicer($('#table-tpl').html(), data));
      $('#rows tr').vdsRowHover();
      $('#rows tr:even').addClass('even');
      if(data.paging != null)$('#rows').append(juicer($('#paging-tpl').html(), data));
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
  <div class="loc"><h2><i class="icon"></i>咨询反馈</h2></div>
  <div class="box">
    <div class="doacts">
      <a class="ae btn" onclick="doslvent('<?php echo url(array('m'=>$MOD, 'c'=>'feedback', 'a'=>'view', ));?>')"><i class="view"></i><font>查看详细</font></a>
      <a class="ae btn" onclick="domulent('<?php echo url(array('m'=>$MOD, 'c'=>'feedback', 'a'=>'delete', ));?>')"><i class="remove"></i><font>删除</font></a>
    </div>
    <div class="stools mt5">
      <select id="type" class="slt">
        <option value="" selected="selected">全部类型</option>
        <?php $_foreach_v_counter = 0; $_foreach_v_total = count($type_map);?><?php foreach( $type_map as $k => $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
        <option value="<?php echo htmlspecialchars($k, ENT_QUOTES, "UTF-8"); ?>"><?php echo htmlspecialchars($v, ENT_QUOTES, "UTF-8"); ?></option>
        <?php endforeach; ?>
      </select>
      <select id="status" class="slt">
        <option value="" selected="selected">全部状态</option>
        <?php $_foreach_v_counter = 0; $_foreach_v_total = count($status_map);?><?php foreach( $status_map as $k => $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
        <option value="<?php echo htmlspecialchars($k, ENT_QUOTES, "UTF-8"); ?>"><?php echo htmlspecialchars($v, ENT_QUOTES, "UTF-8"); ?></option>
        <?php endforeach; ?>
      </select>
      <button class="cbtn btn" type="button" onclick="searchRes(1)">筛选</button>
    </div>
    <div class="module mt5" id="rows"></div>
  </div>
</div>
<script type="text/template" id="table-tpl">
<form method="post" id="mulentform">
  <table class="datalist">
    <tr>
      <th width="60" colspan="2">编号</th>
      <th class="ta-l">主题</th>
      <th width="150">类型</th>
      <th width="160">用户名</th>
      <th width="130">状态</th>
      <th width="110">日期</th>
    </tr>
    {@each list as v}
    <tr>
      <td width="20"><input name="id[]" type="checkbox" value="${v.fb_id}" /></td>
      <td width="40">${v.fb_id}</td>
      <td class="ta-l"><a class="blue" href="<?php echo url(array('m'=>$MOD, 'c'=>'feedback', 'a'=>'view', 'id'=>'${v.fb_id}', ));?>">${v.subject}</a></td>
      <td>${v.type}</td>
      <td><a class="blue" href="<?php echo url(array('m'=>$MOD, 'c'=>'user', 'a'=>'view', 'id'=>'${v.user_id}', ));?>">${v.username}</a></td>
      <td>${v.status}</td>
      <td class="c888">${v.created_date}</td>
    </tr>
    {@/each}
  </table>
</form>
</script>
<?php include $_view_obj->compile('backend/lib/paging.html'); ?>
<script type="text/javascript" src="public/script/juicer.js"></script>
</body>
</html>