<?php if(!class_exists("View", false)) exit("no direct access allowed");?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include $_view_obj->compile('backend/lib/meta.html'); ?>
<link rel="stylesheet" type="text/css" href="public/theme/backend/css/verydows.css" />
<link rel="stylesheet" type="text/css" href="public/theme/backend/css/main.css" />
<link rel="stylesheet" type="text/css" href="public/theme/backend/css/goods.css" />
<script type="text/javascript" src="public/script/jquery.js"></script>
<script type="text/javascript" src="public/theme/backend/js/verydows.js"></script>
<script type="text/javascript">
function searchGoods(){
  var cate_id = $('#cate_id').val(), brand_id = $('#brand_id').val(), kw = $('#kw').val();
  $.asynList("<?php echo url(array('c'=>'backend/goods', 'a'=>'edit', 'step'=>'related', 'op'=>'list', ));?>", {'cate_id':cate_id, 'brand_id':brand_id, 'kw':kw}, function(data){
    $("#selectable").empty();
    if(data.list && data.list != ''){	    
      for(var i in data.list){
        $("#selectable").append("<option value='"+data.list[i].goods_id+"'>"+data.list[i].goods_name+"</option>");  
      }
      $("#selectable").find('option[value="<?php echo htmlspecialchars($goods['goods_id'], ENT_QUOTES, "UTF-8"); ?>"]').remove();
    }else{
      $('body').vdsAlert({msg:"为查找符合条件的商品数据", time:1});
    }
  });
}
//添加关联
function addRelated(){
  var selected = $("#selectable option:selected");
  if(selected.length == 0){
    $('body').vdsAlert({msg:'请选中需要关联的商品', time:1});
    return false;
  }
  var direction = $('input[name="direction"]:checked'), space = " ["+direction.attr('title')+"]", addval;
  selected.each(function(){
    addval = $(this).val() + '-' + direction.val();
    $("#related:not(:has(option[data-key='"+$(this).val()+"']))").append("<option value='"+addval+"' data-key='"+$(this).val()+"'>"+$(this).text()+space+"</option>");  
    $(this).remove();
  });
}
//移除关联
function removeRelated(){
  var selected = $("#related option:selected");
  if(selected.length == 0){
    $('body').vdsAlert({msg:'请选中需要移除的关联商品', time:1});
    return false;   
  }
  var text, remval;
  selected.each(function(){
    text = $(this).text().substring(0, $(this).text().lastIndexOf('['));
    remval = $(this).data('key');
    $("#selectable:not(:has(option[value='"+remval+"']))").append("<option value='"+remval+"'>"+text+"</option>");
    $(this).remove();
  });
}
</script>
</head>
<body>
<div class="content">
  <div class="loc"><h2><i class="icon"></i>关联商品:<font class="ml5">[<?php echo htmlspecialchars($goods['goods_id'], ENT_QUOTES, "UTF-8"); ?>]</font></h2></div>
  <div class="box">
    <div class="bw-row ta-c pad10 cut">
      <h3 class="c666"><?php echo htmlspecialchars($goods['goods_name'], ENT_QUOTES, "UTF-8"); ?></h3>
      <p class="c999 mt10">货号:<font class="c666 ml5"><?php echo htmlspecialchars($goods['goods_sn'], ENT_QUOTES, "UTF-8"); ?></font></p>
    </div>
    <div class="bw-row mt5 pad10 ta-c cut">
      <select id="cate_id" class="slt">
        <option value="">全部分类</option>
        <?php if (!empty($cate_list)) : ?>
        <option disabled="disabled">------------------------------</option>
        <?php $_foreach_v_counter = 0; $_foreach_v_total = count($cate_list);?><?php foreach( $cate_list as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
        <option value="<?php echo htmlspecialchars($v['cate_id'], ENT_QUOTES, "UTF-8"); ?>"><?php echo str_repeat('|— ',$v['lv']);?> <?php echo htmlspecialchars($v['cate_name'], ENT_QUOTES, "UTF-8"); ?></option>
        <?php endforeach; ?>
        <?php endif; ?>
      </select>
      <select id="brand_id" class="slt">
        <option value="">全部品牌</option>
        <?php if (!empty($brand_list)) : ?>
        <option disabled="disabled">------------------------------</option>
        <?php $_foreach_v_counter = 0; $_foreach_v_total = count($brand_list);?><?php foreach( $brand_list as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
        <option value="<?php echo htmlspecialchars($v['brand_id'], ENT_QUOTES, "UTF-8"); ?>"><?php echo htmlspecialchars($v['brand_name'], ENT_QUOTES, "UTF-8"); ?></option>
        <?php endforeach; ?>
        <?php endif; ?>
      </select>
      <input class="w250 txt" id="kw" type="text" placeholder="商品关键词或商品货号" />
      <button class="cbtn btn" type="button" onclick="searchGoods()">搜索</button>
    </div>
    <form method="post" onsubmit="$('#related option').prop('selected', true)" action="<?php echo url(array('m'=>$MOD, 'c'=>'goods', 'a'=>'edit', 'step'=>'related', 'op'=>'update', 'id'=>$goods['goods_id'], ));?>">
      <div class="bw-row mt5 pad10">
        <div class="selmulwp x-auto cut">
          <div class="selmultd fl cut">
            <p class="c888 ta-c">可选商品</p>
            <p class="mt10">
              <select size="25" multiple="multiple" class="mult" id="selectable">
              </select>
            </p>
          </div>
          <div class="selmulac ta-c fl cut">
            <ul>
              <li>
                <label>
                <input title="单向关联" name="direction" value="1" checked="checked" type="radio">
                <font class="ml5 c888">单向关联</font></label>
              </li>
              <li>
                <label>
                <input title="双向关联" name="direction" value="2" type="radio">
                <font class="ml5 c888">双向关联</font></label>
              </li>
              <li>
                <button class="cbtn sm btn" type="button" onclick="addRelated()">&gt;</button>
              </li>
              <li>
                <button class="cbtn sm btn" type="button" onclick="removeRelated()">&lt;</button>
              </li>
            </ul>
          </div>
          <div class="selmultd fl cut">
            <p class="c888 ta-c">已关联商品</p>
            <p class="mt10">
              <select name="related[]" size="25" multiple="multiple" class="mult" id="related">
                <?php $_foreach_v_counter = 0; $_foreach_v_total = count($related);?><?php foreach( $related as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
                <option value="<?php echo htmlspecialchars($v['goods_id'], ENT_QUOTES, "UTF-8"); ?>-<?php echo htmlspecialchars($v['direction'], ENT_QUOTES, "UTF-8"); ?>" data-key="<?php echo htmlspecialchars($v['goods_id'], ENT_QUOTES, "UTF-8"); ?>"><?php echo htmlspecialchars($v['goods_name'], ENT_QUOTES, "UTF-8"); ?><?php if ($v['direction'] == 1) : ?> [单项关联]<?php else : ?> [双向关联]<?php endif; ?></option>
                <?php endforeach; ?>
              </select>
            </p>
          </div>
        </div>
      </div>
      <div class="mt10 pad10 ta-c"><button type="submit" class="ubtn btn">保存并更新</button></div>
    </form>
  </div>
</div>
</body>
</html>