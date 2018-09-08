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
//搜索商品
function searchRes(page_id){
  var goods_id = $('#goods_id').val() || '', user_id = $('#user_id').val() || '', status = $('#status').val(), replied = $('#replied').val(), sort_id = $('#sort_id').val();
  var dataset = {'goods_id':goods_id, 'user_id':user_id, 'status':status, 'replied':replied, 'sort_id':sort_id, 'page':page_id};
  
  $.asynList("<?php echo url(array('m'=>$MOD, 'c'=>'goods_review', 'a'=>'index', 'step'=>'search', ));?>", dataset, function(data){
    if(data.status == 'success'){
      juicer.register('rating_text', function(v){return ratingText(v);});
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

function ratingText(n){
  var text = '';
  switch(n){
    case '1': text = '<font color="#336600">1分<br />很不满意</font>'; break;
    case '2': text = '<font color="#009999">2分<br />不满意</font>'; break;
    case '3': text = '<font color="#666">3分<br />一般</font>'; break;
    case '4': text = '<font color="#ff3366">4分<br />满意</font>'; break;
    case '5': text = '<font color="#cc3300">5分<br />非常满意</font>'; break;
  }
  return text;
}
</script>
</head>
<body>
<div class="content">
  <div class="loc"><h2><i class="icon"></i>商品评价</h2></div>
  <div class="box">
    <?php if (isset($goods)) : ?>
    <div class="ta-c bw-row mb5 pad10 c666 cut">
      <p><a href="<?php echo url(array('c'=>'goods', 'a'=>'index', 'id'=>$goods['goods_id'], ));?>"><img width="60" height="60" src="upload/goods/prime/0/<?php echo htmlspecialchars($goods['goods_image'], ENT_QUOTES, "UTF-8"); ?>" /></a></p>
      <p class="mt5"><a class="blue" href="<?php echo url(array('c'=>'goods', 'a'=>'index', 'id'=>$goods['goods_id'], ));?>"><?php echo htmlspecialchars($goods['goods_name'], ENT_QUOTES, "UTF-8"); ?></a></p>
      <p class="mt10">共获得 <b class="c333"><?php echo htmlspecialchars($goods['count'], ENT_QUOTES, "UTF-8"); ?></b> 条评价<span class="sep20"></span>平均评分 <b class="red"><?php echo round($goods['rating'], 1);?></b> 分</p>
      <input type="hidden" id="goods_id" value="<?php echo htmlspecialchars($goods['goods_id'], ENT_QUOTES, "UTF-8"); ?>" />
    </div>
    <?php endif; ?>
    <?php if (!empty($user)) : ?>
    <div class="ta-c bw-row mb5 pad10 c666 cut">
      <p>用户<b class="ml5"><a class="blue" href="<?php echo url(array('m'=>$MOD, 'c'=>'user', 'a'=>'view', 'id'=>$user['user_id'], ));?>"><?php echo htmlspecialchars($user['username'], ENT_QUOTES, "UTF-8"); ?></a></b><font class="c999 ml5 mr5">[<?php echo htmlspecialchars($user['email'], ENT_QUOTES, "UTF-8"); ?>]</font> 的商品评价记录</p>
      <input type="hidden" id="user_id" value="<?php echo htmlspecialchars($user['user_id'], ENT_QUOTES, "UTF-8"); ?>" />
    </div>
    <?php endif; ?>
    <div class="doacts">
      <a class="ae btn" onclick="doslvent('<?php echo url(array('m'=>$MOD, 'c'=>'goods_review', 'a'=>'view', ));?>')"><i class="view"></i><font>查看详细</font></a>
      <a class="ae btn" onclick="domulent('<?php echo url(array('m'=>$MOD, 'c'=>'goods_review', 'a'=>'approval', 'status'=>'1', ));?>')"><i class="accept"></i><font>审核通过</font></a>
      <a class="ae btn" onclick="domulent('<?php echo url(array('m'=>$MOD, 'c'=>'goods_review', 'a'=>'approval', 'status'=>'2', ));?>')"><i class="forbid"></i><font>审核未通过</font></a>
      <a class="ae btn" onclick="domulent('<?php echo url(array('m'=>$MOD, 'c'=>'goods_review', 'a'=>'delete', ));?>')"><i class="remove"></i><font>删除</font></a>
    </div>
    <div class="stools mt5">
      <select id="status" class="slt">
        <option value="" selected="selected">审核状态</option>
        <option value="0">未审核</option>
        <option value="1">通过</option>
        <option value="2">未通过</option>
      </select>
      <select id="replied" class="slt">
        <option value="">回复状态</option>
        <option value="1">未回复</option>
        <option value="2">已回复</option>
      </select>
      <select id="sort_id" class="slt">
        <option value="0">默认排序</option>
        <option value="1">时间降序</option>
        <option value="2">时间升序</option>
        <option value="3">评分降序</option>
        <option value="4">评分升序</option>
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
      <th class="ta-l">评价内容</th>
      <th width="100">评分</th>
      <th width="230">商品</th>
      <th width="120">用户</th>
      <th width="100">审核状态</th>
      <th width="100">回复状态</th>
      <th width="90">发表日期</th>
    </tr>
    {@each list as v}
    <tr>
      <td width="20"><input name="id[]" type="checkbox" value="${v.review_id}" /></td>
      <td width="40">${v.review_id}</td>
      <td class="ta-l"><a class="blue" href="index.php?m=<?php echo htmlspecialchars($MOD, ENT_QUOTES, "UTF-8"); ?>&c=goods_review&a=view&id=${v.review_id}">${v.content}</a></td>
      <td>$${v.rating|rating_text}</td>
      <td class="ta-l"><a class="blue" href="<?php echo url(array('c'=>'goods', 'a'=>'index', 'id'=>'${v.goods_id}', ));?>">${v.goods_name}</a></td>
      <td>${v.username}</td>
      <td>{@if v.status == 1}<font class="green">审核通过</font>{@else if v.status == 2}<font class="red">审核未通过</font>{@else}<font class="c999">未审核</font>{@/if}</td>
      <td>{@if v.replied != ''}<font class="green">已回复</font>{@else}<font class="c999">未回复</font>{@/if}</td>
      <td class="c888">$${v.created_date|format_date}</td>
    </tr>
    {@/each}
  </table>
</form>
</script>
<?php include $_view_obj->compile('backend/lib/paging.html'); ?>
<script type="text/javascript" src="public/script/juicer.js"></script>
</body>
</html>