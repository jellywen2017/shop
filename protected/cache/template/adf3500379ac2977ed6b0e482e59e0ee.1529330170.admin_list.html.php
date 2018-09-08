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
  <div class="loc"><h2><i class="icon"></i>管理员列表</h2></div>
  <div class="box">
    <div class="doacts">
      <a class="ae add btn" href="<?php echo url(array('m'=>$MOD, 'c'=>'admin', 'a'=>'add', ));?>"><i></i><font>添加新管理员</font></a>
      <a class="ae btn" onclick="doslvent('<?php echo url(array('m'=>$MOD, 'c'=>'admin', 'a'=>'edit', ));?>', 'id')"><i class="edit"></i><font>编辑</font></a>
      <a class="ae btn" onclick="doslvent('<?php echo url(array('m'=>$MOD, 'c'=>'admin', 'a'=>'delete', ));?>', 'id')"><i class="remove"></i><font>删除</font></a>
    </div>
    <div class="module mt5">
      <table class="datalist">
        <tr>
          <th width="50" colspan="2">编号</th>
          <th class="ta-l">用户名</th>
          <th class="ta-l" width="210">电子邮箱</th>
          <th class="ta-l" width="190">姓名称呼</th>
          <th width="130">上次登录日期</th>
          <th width="130">上次登录IP</th>
          <th width="130">创建日期</th>
        </tr>
        <?php $_foreach_v_counter = 0; $_foreach_v_total = count($results);?><?php foreach( $results as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
        <tr>
          <td width="20"><input name="id" type="checkbox" value="<?php echo htmlspecialchars($v['user_id'], ENT_QUOTES, "UTF-8"); ?>" /></td>
          <td width="30"><?php echo htmlspecialchars($v['user_id'], ENT_QUOTES, "UTF-8"); ?></td>
          <td class="ta-l"><a class="blue" href="<?php echo url(array('m'=>$MOD, 'c'=>'admin', 'a'=>'edit', 'id'=>$v['user_id'], ));?>"><?php echo htmlspecialchars($v['username'], ENT_QUOTES, "UTF-8"); ?></a></td>
          <td class="ta-l"><?php echo htmlspecialchars($v['email'], ENT_QUOTES, "UTF-8"); ?></td>
          <td class="ta-l"><?php if (!empty($v['name'])) : ?><?php echo htmlspecialchars($v['name'], ENT_QUOTES, "UTF-8"); ?><?php else : ?><font class="c999">未设置</font><?php endif; ?></td>
          <td class="c888"><?php echo date('Y-m-d', $v['last_date']);?></td>
          <td class="c888"><?php echo htmlspecialchars($v['last_ip'], ENT_QUOTES, "UTF-8"); ?></td>
          <td class="c888"><?php echo date('Y-m-d', $v['created_date']);?></td>
        </tr>
        <?php endforeach; ?>
      </table>
    </div>
    <?php if (!empty($paging)) : ?>
    <div class="libom mt5"><?php echo html_paging(array('m'=>$MOD, 'c'=>'admin', 'a'=>'index', 'paging'=>$paging, 'class'=>'paging', ));?></div>
    <?php endif; ?>
  </div>
</div>
</body>
</html>