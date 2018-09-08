<?php if(!class_exists("View", false)) exit("no direct access allowed");?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include $_view_obj->compile('backend/lib/meta.html'); ?>
<link rel="stylesheet" type="text/css" href="public/theme/backend/css/verydows.css" />
<link rel="stylesheet" type="text/css" href="public/theme/backend/css/main.css" />
<script type="text/javascript" src="public/script/jquery.js"></script>
<script type="text/javascript" src="public/theme/backend/js/verydows.js"></script>
<script type="text/javascript" src="public/theme/backend/js/list.js"></script>
</head>
<body>
<div class="content">
  <div class="loc"><h2><i class="icon"></i>帮助列表</h2></div>
  <div class="box">
    <div class="doacts">
      <a class="ae add btn" href="<?php echo url(array('m'=>$MOD, 'c'=>'help', 'a'=>'add', ));?>"><i></i><font>添加帮助</font></a>
      <a class="ae btn" onclick="doslvent('<?php echo url(array('m'=>$MOD, 'c'=>'help', 'a'=>'edit', ));?>')"><i class="edit"></i><font>编辑</font></a>
      <a class="ae btn" onclick="domulent('<?php echo url(array('m'=>$MOD, 'c'=>'help', 'a'=>'delete', ));?>')"><i class="remove"></i><font>删除</font></a>
    </div>
    <?php if (!empty($results)) : ?>
    <div class="module mt5">
      <form method="post" id="mulentform">
        <table class="datalist">
          <tr>
            <th width="50" colspan="2">编号</th>
            <th class="ta-l">标题</th>
            <th width="150">分类</th>
            <th width="120">排序</th>
          </tr>
          <?php $_foreach_v_counter = 0; $_foreach_v_total = count($results);?><?php foreach( $results as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
          <tr>
            <td width="20"><input name="id[]" type="checkbox" value="<?php echo htmlspecialchars($v['id'], ENT_QUOTES, "UTF-8"); ?>" /></td>
            <td width="30"><?php echo htmlspecialchars($v['id'], ENT_QUOTES, "UTF-8"); ?></td>
            <td class="ta-l"><a class="blue" href="<?php echo url(array('m'=>$MOD, 'c'=>'help', 'a'=>'edit', 'id'=>$v['id'], ));?>"><?php echo htmlspecialchars($v['title'], ENT_QUOTES, "UTF-8"); ?></a></td>
            <?php if ($v['cate_id'] == 0 || empty($cate_list[$v['cate_id']])) : ?>
            <td class="c999">未分类</td>
            <?php else : ?>
            <td><?php echo htmlspecialchars($cate_list[$v['cate_id']]['cate_name'], ENT_QUOTES, "UTF-8"); ?></td>
            <?php endif; ?>
            <td><?php echo htmlspecialchars($v['seq'], ENT_QUOTES, "UTF-8"); ?></td>
          </tr>
          <?php endforeach; ?>
        </table>
      </form>
    </div>
    <?php if (!empty($paging)) : ?>
    <div class="bom mt5"><?php echo html_paging(array('paging'=>$paging, 'm'=>$MOD, 'c'=>'help', 'a'=>'index', 'class'=>'paging', ));?></div>
    <?php endif; ?>
    <?php else : ?>
    <div class="nors mt5">暂无数据记录...</div>
    <?php endif; ?>
  </div>
</div>
</body>
</html>