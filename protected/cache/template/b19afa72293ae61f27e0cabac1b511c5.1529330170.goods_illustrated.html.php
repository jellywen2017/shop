<?php if(!class_exists("View", false)) exit("no direct access allowed");?><!DOCTYPE HTML>
<html>
<head>
<?php include $_view_obj->compile('mobile/default/lib/meta.html'); ?>
<title><?php echo htmlspecialchars($goods['goods_name'], ENT_QUOTES, "UTF-8"); ?> - <?php echo htmlspecialchars($GLOBALS['cfg']['site_name'], ENT_QUOTES, "UTF-8"); ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/css/general.css" />
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/iconfont/iconfont.css">
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/css/goods.css" />
<script type="text/javascript" src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/js/zepto.min.js"></script>
<script type="text/javascript" src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/js/verydows.mobile.js"></script>
</head>
<body>
<div class="wrapper">
  <!-- header start -->
  <div class="header">
    <div class="op lt"><a href="javascript:history.back(-1);"><i class="f20 iconfont">&#xe602;</i></a></div>
    <h2>图文详情</h2>
  </div>
  <!-- header end -->
  <div class="ilustd">
    <div class="gsubth"><h2 class="xauto"><?php echo htmlspecialchars($goods['goods_name'], ENT_QUOTES, "UTF-8"); ?></h2></div>
    <?php if (!empty($goods['goods_content'])) : ?>
    <div class="main mt10"><?php echo $goods['goods_content']; ?></div>
    <?php else : ?>
    <div class="nodata f14 caaa">暂无内容...</div>
    <?php endif; ?>
  </div>
</div>
<?php include $_view_obj->compile('mobile/default/lib/footer.html'); ?>
</body>
</html>