<?php if(!class_exists("View", false)) exit("no direct access allowed");?><!DOCTYPE HTML>
<html>
<head>
<?php include $_view_obj->compile('mobile/default/lib/meta.html'); ?>
<title>付款结果 - <?php echo htmlspecialchars($GLOBALS['cfg']['site_name'], ENT_QUOTES, "UTF-8"); ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/css/general.css" />
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/iconfont/iconfont.css">
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/css/pay.css" />
<script type="text/javascript" src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/js/zepto.min.js"></script>
<script type="text/javascript" src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/js/verydows.mobile.js"></script>
</head>
<body>
<div class="wrapper">
  <!-- header start -->
  <div class="header">
    <div class="op lt"><a href="<?php echo url(array('c'=>'mobile/user', 'a'=>'index', ));?>"><i class="f20 iconfont">&#xe602;</i></a></div>
    <h2>支付订单</h2>
  </div>
  <!-- header end -->
  <div class="pay">
    <div class="return <?php echo htmlspecialchars($status, ENT_QUOTES, "UTF-8"); ?>">
      <p><i class="iconfont"><?php if ($status == 'success') : ?>&#xe63a;<?php else : ?>&#xe639;<?php endif; ?></i></p>
      <h2 class="f14 mt20 xauto"><?php echo htmlspecialchars($message, ENT_QUOTES, "UTF-8"); ?></h2>
    </div>
    <?php if (!empty($order)) : ?>
    <div class="order">
      <dl><dt>订单号：</dt><dd><b class="c555" id="order_id"><?php echo htmlspecialchars($order['order_id'], ENT_QUOTES, "UTF-8"); ?></b></dd></dl>
      <dl><dt>金额：</dt><dd class="amount"><i class="f18 cny">¥</i><font class="f18 ml2"><?php echo htmlspecialchars($order['order_amount'], ENT_QUOTES, "UTF-8"); ?></font></dd></dl>
    </div>
    <div class="submit mt20"><a class="xauto center" href="<?php echo url(array('c'=>'mobile/order', 'a'=>'view', 'id'=>$order['order_id'], ));?>">查看订单</a></div>
    <?php endif; ?>
  </div>
</div>
<?php include $_view_obj->compile('mobile/default/lib/footer.html'); ?>
</body>
</html>