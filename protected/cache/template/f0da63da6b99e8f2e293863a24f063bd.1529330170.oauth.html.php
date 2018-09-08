<?php if(!class_exists("View", false)) exit("no direct access allowed");?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include $_view_obj->compile('backend/lib/meta.html'); ?>
<link rel="stylesheet" type="text/css" href="public/theme/backend/css/verydows.css" />
<link rel="stylesheet" type="text/css" href="public/theme/backend/css/main.css" />
<script type="text/javascript" src="public/script/jquery.js"></script>
<script type="text/javascript" src="public/theme/backend/js/verydows.js"></script>
</head>
<body>
<div class="content">
  <div class="loc"><h2><i class="icon"></i>设置<font class="ml5 mr5">[<?php echo htmlspecialchars($rs['name'], ENT_QUOTES, "UTF-8"); ?>]</font>授权相关配置</h2></div>
  <form method="post" action="<?php echo url(array('m'=>$MOD, 'c'=>'oauth', 'a'=>'edit', 'party'=>$rs['party'], 'step'=>'submit', ));?>">
    <input type="hidden" name="params" id="params" />
    <div class="box">
      <div class="module">
        <table class="dataform">
          <tr>
            <th width="110">名称</th>
            <td><p class="pad5"><b class="c666"><?php echo htmlspecialchars($rs['name'], ENT_QUOTES, "UTF-8"); ?></b></p></td>
          </tr>
          <tr>
            <th>说明</th>
            <td><p class="c888 pad5"><?php echo htmlspecialchars($rs['instruction'], ENT_QUOTES, "UTF-8"); ?></p></td>
          </tr>
          <tr>
            <th>图标</th>
            <td><p class="c888 pad5"><img src="plugin/oauth/icon/<?php echo htmlspecialchars($rs['party'], ENT_QUOTES, "UTF-8"); ?>.png" /></p></td>
          </tr>
          <?php include $_view_obj->compile($rs['template']); ?>
          <tr>
            <th>是否启用</th>
            <td>
              <p class="pad5">
                <label><input type="radio" name="enable" value="1" <?php if ($rs['enable'] == 1) : ?>checked="checked"<?php endif; ?> /><font class="green ml5">是</font></label>
                <label class="ml20"><input type="radio" name="enable" value="0" <?php if ($rs['enable'] == 0) : ?>checked="checked"<?php endif; ?> /><font class="red ml5">否</font></label>
              </p>
              <p class="mt5 c999">注：开启前请确保您的服务器环境中开启了<font class="ml5 mr5 c666">allow_url_fopen</font>支持</p>
            </td>
          </tr>
        </table>
      </div>
      <div class="submitbtn">
        <button type="submit" class="ubtn btn">保存并更新</button>
        <button type="reset" class="fbtn btn">重置表单</button>
      </div>
    </div>
  </form>
</div>
</body>
</html>