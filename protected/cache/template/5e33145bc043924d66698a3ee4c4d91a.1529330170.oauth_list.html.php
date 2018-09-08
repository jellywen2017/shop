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
  <div class="loc"><h2><i class="icon"></i>授权登录列表</h2></div>
  <div class="box">
    <?php if (!empty($results)) : ?>
    <div class="module">
      <table class="datalist">
        <tr>
          <th width="200" class="ta-l">名称</th>
          <th class="ta-l">说明</th>
          <th width="100">启用</th>
        </tr>
        <?php $_foreach_v_counter = 0; $_foreach_v_total = count($results);?><?php foreach( $results as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
        <tr>
          <td class="ta-l"><p class="pad5"><a class="blue" href="<?php echo url(array('m'=>$MOD, 'c'=>'oauth', 'a'=>'edit', 'party'=>$v['party'], ));?>"><?php echo htmlspecialchars($v['name'], ENT_QUOTES, "UTF-8"); ?></a></p></td>
          <td class="ta-l"><?php if (!empty($v['instruction'])) : ?><p class="c666" style="line-height:180%"><?php echo htmlspecialchars($v['instruction'], ENT_QUOTES, "UTF-8"); ?></p><?php else : ?><font class="caaa">未设置</font><?php endif; ?></td>
          <td><?php if ($v['enable'] == 1) : ?><i class="icon yes"></i><?php else : ?><i class="icon no"></i><?php endif; ?></td>
        </tr>
        <?php endforeach; ?>
      </table>
    </div>
    <?php else : ?>
    <div class="nors mt5">未找到相关数据记录...</div>
    <?php endif; ?>
  </div>
</div>
</body>
</html>