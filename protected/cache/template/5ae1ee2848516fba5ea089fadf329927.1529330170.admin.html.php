<?php if(!class_exists("View", false)) exit("no direct access allowed");?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include $_view_obj->compile('backend/lib/meta.html'); ?>
<link rel="stylesheet" type="text/css" href="public/theme/backend/css/verydows.css" />
<link rel="stylesheet" type="text/css" href="public/theme/backend/css/main.css" />
<script type="text/javascript" src="public/script/jquery.js"></script>
<script type="text/javascript" src="public/theme/backend/js/verydows.js"></script>
<script type="text/javascript">
function submitForm(){
  $('#username').vdsFieldChecker({rules:{username:[/^[a-zA-Z][_a-zA-Z0-9]{4,15}$/.test($('#username').val()), '用户名不符合格式要求']}});
  if($('#resetpwd').val() == 1){
    $('#password').vdsFieldChecker({rules:{required:[true, '请设置密码'], password:[true, '密码不符合格式要求']}});
  }
  $('#repassword').vdsFieldChecker({rules:{equal:[$('#password').val(), '两次密码不一致']}});
  $('#name').vdsFieldChecker({rules:{required:[true, '姓名称呼不能为空'], maxlen:[60, '姓名称呼不能超过60个字符']}});
  $('#email').vdsFieldChecker({rules:{required:[true, '电子邮箱不能为空'], email:[true, '无效的电子邮箱地址']}});
  $('form').vdsFormChecker();
}

function resetPwd(btn){
  $('.setpwd').removeClass('hide');
  $('#resetpwd').val(1);
  $(btn).parentsUntil('tr').parent().addClass('hide');
}
</script>
</head>
<body>
<?php if ($_GET['a'] == 'add') : ?>
<div class="content">
  <div class="loc"><h2><i class="icon"></i>添加新管理员</h2></div>
  <form method="post" action="<?php echo url(array('m'=>$MOD, 'c'=>'admin', 'a'=>'add', 'step'=>'submit', ));?>">
    <div class="box">
      <div class="module">
        <table class="dataform">
          <tr>
            <th width="110">用户名</th>
            <td><input title="用户名" class="w200 txt" name="username" id="username" type="text" /><p class="c999 mt10">可以包含字母、数字或下划线，须以字母开头，长度为5-16个字符</p></td>
          </tr>
          <tr>
            <th>密码</th>
            <td>
              <input title="密码" class="w200 txt" name="password" id="password" type="password" />
              <input type="hidden" name="resetpwd" id="resetpwd" value="1" />
              <p class="c999 mt10">可以包含字母、数字以及特殊符号，长度为6-32个字符</p>
            </td>
          </tr>
          <tr>
            <th>确认密码</th>
            <td><input class="w200 txt" name="repassword" id="repassword" type="password" /></td>
          </tr>
          <tr>
            <th>姓名称呼</th>
            <td><input class="w200 txt" name="name" id="name" type="text" /></td>
          </tr>
          <tr>
            <th>电子邮箱</th>
            <td><input class="w200 txt" name="email" id="email" type="text" /></td>
          </tr>
          <tr>
            <th>分配角色</th>
            <td>
              <?php if (!empty($role_list)) : ?>
              <div class="ckrow mt5 pad5 cut">
                <ul class="c666">
                  <?php $_foreach_v_counter = 0; $_foreach_v_total = count($role_list);?><?php foreach( $role_list as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
                  <li><label><input type="checkbox" name="role_ids[]" value="<?php echo htmlspecialchars($v['role_id'], ENT_QUOTES, "UTF-8"); ?>" /><font class="ml5"><?php echo htmlspecialchars($v['role_name'], ENT_QUOTES, "UTF-8"); ?></font></label></li>
                  <?php endforeach; ?>
                </ul>
              </div>
              <?php else : ?>
              <div class="pad5"><font class="c999">系统中尚未添加任何管理员角色</font><a class="blue ml5" href="<?php echo url(array('m'=>$MOD, 'c'=>'role', 'a'=>'add', ));?>">点击添加角色</a></div>
              <?php endif; ?>
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
  <div class="loc"><h2><i class="icon"></i>编辑管理员:<font class="ml5">[<?php echo htmlspecialchars($rs['user_id'], ENT_QUOTES, "UTF-8"); ?>]</font></h2></div>
  <form method="post" action="<?php echo url(array('m'=>$MOD, 'c'=>'admin', 'a'=>'edit', 'id'=>$rs['user_id'], 'step'=>'submit', ));?>">
    <div class="box">
      <div class="module">
        <table class="dataform">
          <tr>
            <th width="110">用户名</th>
            <td><input class="w200 txt" name="username" id="username" type="text" value="<?php echo htmlspecialchars($rs['username'], ENT_QUOTES, "UTF-8"); ?>" />
              <p class="c999 mt10">可以包含字母、数字或下划线，须以字母开头，长度为5-16个字符</p>
            </td>
          </tr>
          <tr>
            <th>重设密码</th>
            <td><button type="button" class="cbtn sm btn" onclick="resetPwd(this)">点击重新设置密码</button>
              <input type="hidden" name="resetpwd" id="resetpwd" value="" />
              <p class="c999 mt10">如需重设密码请点击以上按钮，否则密码保持不变</p>
            </td>
          </tr>
          <tr class="setpwd hide">
            <th>密码</th>
            <td><input class="w200 txt" name="password" id="password" type="password" />
              <p class="c999 mt10">可以包含字母、数字以及特殊符号，长度为6-32个字符</p>
            </td>
          </tr>
          <tr class="setpwd hide">
            <th>确认密码</th>
            <td><input class="w200 txt" name="repassword" id="repassword" type="password" /></td>
          </tr>
          <tr>
            <th>姓名称呼</th>
            <td><input class="w200 txt" name="name" id="name" type="text" value="<?php echo htmlspecialchars($rs['name'], ENT_QUOTES, "UTF-8"); ?>" /></td>
          </tr>
          <tr>
            <th>电子邮箱</th>
            <td><input class="w200 txt" name="email" id="email" type="text" value="<?php echo htmlspecialchars($rs['email'], ENT_QUOTES, "UTF-8"); ?>" /></td>
          </tr>
          <?php if ($rs['user_id'] != 1) : ?>
          <tr>
            <th>分配角色</th>
            <td>
              <?php if (!empty($role_list)) : ?>
              <div class="ckrow mt5 pad5 cut">
                <ul class="c666">
                  <?php $_foreach_v_counter = 0; $_foreach_v_total = count($role_list);?><?php foreach( $role_list as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
                  <?php if (!empty($rs['role_ids']) && in_array($v['role_id'], $rs['role_ids'])) : ?>
                  <li><label><input checked="checked" type="checkbox" name="role_ids[]" value="<?php echo htmlspecialchars($v['role_id'], ENT_QUOTES, "UTF-8"); ?>" /><font class="ml5"><?php echo htmlspecialchars($v['role_name'], ENT_QUOTES, "UTF-8"); ?></font></label></li>
                  <?php else : ?>
                  <li><label><input type="checkbox" name="role_ids[]" value="<?php echo htmlspecialchars($v['role_id'], ENT_QUOTES, "UTF-8"); ?>" /><font class="ml5"><?php echo htmlspecialchars($v['role_name'], ENT_QUOTES, "UTF-8"); ?></font></label></li>
                  <?php endif; ?>
                  <?php endforeach; ?>
                </ul>
              </div>
              <?php else : ?>
              <div class="pad5"><font class="c999">系统中尚未添加任何管理员角色</font><a class="blue ml5" href="<?php echo url(array('m'=>$MOD, 'c'=>'role', 'a'=>'add', ));?>">点击添加角色</a></div>
              <?php endif; ?>
            </td>
          </tr>
          <?php endif; ?>
          <tr>
            <th>上次登录日期</th>
            <td><p class="pad5 c999"><?php echo date('Y-m-d h:i:s', $rs['last_date']);?></p></td>
          </tr>
          <tr>
            <th>上次登录IP</th>
            <td><p class="pad5 c999"><?php echo htmlspecialchars($rs['last_ip'], ENT_QUOTES, "UTF-8"); ?></p></td>
          </tr>
          <tr>
            <th>创建日期</th>
            <td><p class="pad5 c999"><?php echo date('Y-m-d h:i:s', $rs['created_date']);?></p></td>
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