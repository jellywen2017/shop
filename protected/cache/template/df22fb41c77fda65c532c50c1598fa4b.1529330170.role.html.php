<?php if(!class_exists("View", false)) exit("no direct access allowed");?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include $_view_obj->compile('backend/lib/meta.html'); ?>
<link rel="stylesheet" type="text/css" href="public/theme/backend/css/verydows.css" />
<link rel="stylesheet" type="text/css" href="public/theme/backend/css/main.css" />
<script type="text/javascript" src="public/script/jquery.js"></script>
<script type="text/javascript" src="public/theme/backend/js/verydows.js"></script>
<script type="text/javascript">
$(function(){
  $('div.ckrow h4 label').click( function(){
    var cbs = $(this).parent().next('ul').children('li').find('input[type="checkbox"]');
    if($(this).find('input[type="checkbox"]').prop('checked')){
      cbs.prop('checked', true);
    }else{
      cbs.prop('checked', false);
    }
  });
});

function submitForm(){
  $('#role_name').vdsFieldChecker({rules:{required:[true, '角色名不能为空'], maxlen:[50, '角色名不能超过50个字符']}});
  $('#role_desc').vdsFieldChecker({rules:{maxlen:[240, '角色描述不能超过240个字符']}, tipsPos:'br'});
  $('form').vdsFormChecker();
}
</script>
</head>
<body>
<?php if ($_GET['a'] == 'add') : ?>
<div class="content">
  <div class="loc"><h2><i class="icon"></i>添加新管理角色</h2></div>
  <form method="post" action="<?php echo url(array('m'=>$MOD, 'c'=>'role', 'a'=>'add', 'step'=>'submit', ));?>">
    <div class="box">
      <div class="module">
        <table class="dataform">
          <tr>
            <th width="110">角色名</th>
            <td><input class="w200 txt" name="role_name" id="role_name" type="text" /></td>
          </tr>
          <tr>
            <th>角色描述</th>
            <td><textarea name="role_desc" id="role_desc" class="txtarea" cols="68" rows="4"></textarea></td>
          </tr>
          <tr>
            <th>分配权限</th>
            <td>
              <?php $_foreach_v_counter = 0; $_foreach_v_total = count($uri_list);?><?php foreach( $uri_list as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
              <div class="ckrow pad5 cut">
                <h4 class="c666"><label><input type="checkbox" /><font class="ml5"><?php echo htmlspecialchars($v['name'], ENT_QUOTES, "UTF-8"); ?></font></label></h4>
                <ul class="c666 mult">
                  <?php $_foreach_vv_counter = 0; $_foreach_vv_total = count($v['uri']);?><?php foreach( $v['uri'] as $kk => $vv ) : ?><?php $_foreach_vv_index = $_foreach_vv_counter;$_foreach_vv_iteration = $_foreach_vv_counter + 1;$_foreach_vv_first = ($_foreach_vv_counter == 0);$_foreach_vv_last = ($_foreach_vv_counter == $_foreach_vv_total - 1);$_foreach_vv_counter++;?>
                  <li><label><input type="checkbox" name="role_acl[]" value="<?php echo htmlspecialchars($kk, ENT_QUOTES, "UTF-8"); ?>" /><font class="ml5"><?php echo htmlspecialchars($vv, ENT_QUOTES, "UTF-8"); ?></font></label></li>
                  <?php endforeach; ?>
                </ul>
              </div>
              <?php endforeach; ?>
            </td>
          </tr>
        </table>
      </div>
      <div class="submitbtn">
        <button type="button" class="ubtn btn" onclick="submitForm()">保存并提交</button>
        <button type="reset" class="fbtn btn">重置表单</button>
      </div>
    </div>
  </form>
</div>
<?php else : ?>
<div class="content">
  <div class="loc"><h2><i class="icon"></i>编辑角色:<font class="ml5">[<?php echo htmlspecialchars($rs['role_id'], ENT_QUOTES, "UTF-8"); ?>]</font></h2></div>
  <form method="post" action="<?php echo url(array('m'=>$MOD, 'c'=>'role', 'a'=>'edit', 'step'=>'submit', 'id'=>$rs['role_id'], ));?>">
    <div class="box">
      <div class="module">
        <table class="dataform">
          <tr>
            <th width="110">角色名</th>
            <td><input class="w200 txt" name="role_name" id="role_name" type="text" value="<?php echo htmlspecialchars($rs['role_name'], ENT_QUOTES, "UTF-8"); ?>" /></td>
          </tr>
          <tr>
            <th>角色描述</th>
            <td><textarea name="role_desc" id="role_desc" class="txtarea" cols="68" rows="4"><?php echo htmlspecialchars($rs['role_desc'], ENT_QUOTES, "UTF-8"); ?></textarea></td>
          </tr>
          <tr>
            <th>分配权限</th>
            <td>
              <?php $_foreach_v_counter = 0; $_foreach_v_total = count($uri_list);?><?php foreach( $uri_list as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
              <div class="ckrow pad5 cut">
                <h4 class="c666"><label><input type="checkbox" /><font class="ml5"><?php echo htmlspecialchars($v['name'], ENT_QUOTES, "UTF-8"); ?></font></label></h4>
                <ul class="c666 mult">
                  <?php $_foreach_vv_counter = 0; $_foreach_vv_total = count($v['uri']);?><?php foreach( $v['uri'] as $kk => $vv ) : ?><?php $_foreach_vv_index = $_foreach_vv_counter;$_foreach_vv_iteration = $_foreach_vv_counter + 1;$_foreach_vv_first = ($_foreach_vv_counter == 0);$_foreach_vv_last = ($_foreach_vv_counter == $_foreach_vv_total - 1);$_foreach_vv_counter++;?>
                  <?php if (is_array($rs['role_acl']) && in_array($kk, $rs['role_acl'])) : ?>
                  <li><label><input checked="checked" type="checkbox" name="role_acl[]" value="<?php echo htmlspecialchars($kk, ENT_QUOTES, "UTF-8"); ?>" /><font class="ml5"><?php echo htmlspecialchars($vv, ENT_QUOTES, "UTF-8"); ?></font></label></li>
                  <?php else : ?>
                  <li><label><input type="checkbox" name="role_acl[]" value="<?php echo htmlspecialchars($kk, ENT_QUOTES, "UTF-8"); ?>" /><font class="ml5"><?php echo htmlspecialchars($vv, ENT_QUOTES, "UTF-8"); ?></font></label></li>
                  <?php endif; ?>
                  <?php endforeach; ?>
                </ul>
              </div>
              <?php endforeach; ?>
            </td>
          </tr>
        </table>
      </div>
      <div class="submitbtn">
        <button type="button" class="ubtn btn" onclick="submitForm()">保存并更新</button>
        <button type="reset" class="fbtn btn">重置表单</button>
      </div>
    </div>
  </form>
</div>
<?php endif; ?>
</body>
</html>