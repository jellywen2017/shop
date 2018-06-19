<?php if(!class_exists("View", false)) exit("no direct access allowed");?><!DOCTYPE HTML>
<html>
<head>
<?php include $_view_obj->compile('mobile/default/lib/meta.html'); ?>
<meta name="keywords" content="用户登录" />
<meta name="description" content="用户登录" />
<title>用户登陆 - <?php echo htmlspecialchars($GLOBALS['cfg']['site_name'], ENT_QUOTES, "UTF-8"); ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/css/general.css" />
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/iconfont/iconfont.css">
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/css/login.css" />
<script type="text/javascript" src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/js/zepto.min.js"></script>
<script type="text/javascript" src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/js/verydows.mobile.js"></script>
<script type="text/javascript">
function login(){
  $('#username').vdsFieldChecker({rules: {required:[true, '请输入用户名']}});
  $('#password').vdsFieldChecker({rules: {required:[true, '请输入密码']}});
  if($('#arise-captcha')){
    $('#captcha input.field').vdsFieldChecker({rules: {required:[true, '请输入验证码']}});
  }
  if($('#login-form').vdsFormChecker({isSubmit:false}) == true){
    $.asynInter("<?php echo url(array('c'=>'api/user', 'a'=>'login', ));?>", {username: $('#username').val(), password:hex_md5($('#password').val()+'Verydows'), captcha:$('#captcha input.field').val(), stay:$(stay).val()}, function(res){
      if(res.status == 'success'){
        window.location.href = "<?php echo url(array('c'=>'mobile/user', 'a'=>'index', ));?>";
      }else{
        if(res.captcha){
          $.vdsPrompt({content:res.msg, clicked:function(){window.location.reload()}});
        }else{
          $.vdsPrompt({content:res.msg});
        }
      }
    });
  }
}
</script>
</head>
<body>
<div class="wrapper">
  <!-- header start -->
  <div class="header">
    <div class="op lt"><a href="<?php echo url(array('c'=>'mobile/main', 'a'=>'index', ));?>"><i class="f20 iconfont">&#xe602;</i></a></div>
    <h2>用户登录</h2>
  </div>
  <!-- header end -->
  <form id="login-form">
  <input type="password" value="" class="hide" />
  <div class="login eform">
    <div class="user tr"><span class="icopos"><i class="iconfont">&#xe60c;</i></span><input class="field variseclear" type="text" name="username" id="username" placeholder="请输入用户名" required /><i class="vinclrbtn iconfont">&#xe62d;</i></div>
    <div class="pwd tr"><span class="icopos"><i class="iconfont">&#xe607;</i></span><input class="field variseclear" type="password" name="password" id="password" placeholder="请输入密码" required /><i class="vinclrbtn iconfont">&#xe62d;</i><i class="vineyebtn iconfont">&#xe66e;</i></div>
    <?php if (!empty($captcha)) : ?>
    <div class="captcha tr puff mt8" id="captcha">
      <a class="fr"><img onclick="resetCaptcha(this)" src="<?php echo url(array('c'=>'api/captcha', 'a'=>'image', ));?>" /></a>
      <span class="icopos"><i class="iconfont">&#xe601;</i></span><input class="field" type="text" placeholder="请输入图形验证码" />
    </div>
    <?php endif; ?>
    <div class="slck mt8 cut">
      <div class="fl c888 f14">一月内保持登录</div>
      <div class="fr"><input class="vswitch-1" name="stay" id="stay" type="checkbox" checked="checked" value="1" /><label for="stay"></label></div>
    </div>
    <div class="submit mt20"><a href="javascript:void(0)" onClick="login()">登 录</a></div>
    <div class="bypass mt15 c999 cut">
      <div class="fl">您还没有账号？<a href="<?php echo url(array('c'=>'mobile/user', 'a'=>'register', ));?>">立即注册</a></div>
      <div class="fr"><a href="<?php echo url(array('c'=>'mobile/retrieve', 'a'=>'password', ));?>">忘记密码？</a></div>
    </div>
    <?php if (!empty($oauth_list)) : ?>
    <div class="oauthli center mt30">
      <h3 class="c777">使用其他方式登录</h3>
      <div class="mt10">
        <?php $_foreach_v_counter = 0; $_foreach_v_total = count($oauth_list);?><?php foreach( $oauth_list as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
        <a href="<?php echo htmlspecialchars($v['url'], ENT_QUOTES, "UTF-8"); ?>"><img alt="<?php echo htmlspecialchars($v['name'], ENT_QUOTES, "UTF-8"); ?>" src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/plugin/oauth/icon/<?php echo htmlspecialchars($v['party'], ENT_QUOTES, "UTF-8"); ?>.png" /></a>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endif; ?>
  </div>
  </form>
</div>
<script type="text/javascript" src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/public/script/md5.js"></script>
<?php include $_view_obj->compile('mobile/default/lib/footer.html'); ?>
</body>
</html>