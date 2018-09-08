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
  <div class="loc"><h2><i class="icon"></i>管理员角色列表</h2></div>
  <div class="box">
    <div class="doacts">
      <a class="ae add btn" href="<?php echo url(array('m'=>$MOD, 'c'=>'role', 'a'=>'add', ));?>"><i></i><font>添加新角色</font></a>
      <a class="ae btn" onclick="doslvent('<?php echo url(array('m'=>$MOD, 'c'=>'role', 'a'=>'edit', ));?>', 'id')"><i class="edit"></i><font>编辑</font></a>
      <a class="ae btn" onclick="doslvent('<?php echo url(array('m'=>$MOD, 'c'=>'role', 'a'=>'delete', ));?>', 'id')"><i class="remove"></i><font>删除</font></a>
    </div>
    <?php if (!empty($results)) : ?>
    <div class="module mt5">
      <table class="datalist">
        <tr>
          <th width="50" colspan="2">编号</th>
          <th width="300" class="ta-l">角色名</th>
          <th class="ta-l">描述</th>
        </tr>
        <?php $_foreach_v_counter = 0; $_foreach_v_total = count($results);?><?php foreach( $results as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
        <tr>
          <td width="20"><input name="id" type="checkbox" value="<?php echo htmlspecialchars($v['role_id'], ENT_QUOTES, "UTF-8"); ?>" /></td>
          <td width="30"><?php echo htmlspecialchars($v['role_id'], ENT_QUOTES, "UTF-8"); ?></td>
          <td class="ta-l"><a class="blue" href="<?php echo url(array('m'=>$MOD, 'c'=>'role', 'a'=>'edit', 'id'=>$v['role_id'], ));?>"><?php echo htmlspecialchars($v['role_name'], ENT_QUOTES, "UTF-8"); ?></a></td>
          <td class="ta-l"><p class="c666"><?php echo htmlspecialchars($v['role_desc'], ENT_QUOTES, "UTF-8"); ?></p></td>
        </tr>
        <?php endforeach; ?>
      </table>
    </div>
    <?php else : ?>
    <div class="nors mt5">未找到匹配的数据记录...</div>
    <?php endif; ?>
  </div>
</div>
</body>
</html>