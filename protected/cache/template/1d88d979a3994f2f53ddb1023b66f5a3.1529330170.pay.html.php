<?php if(!class_exists("View", false)) exit("no direct access allowed");?><!DOCTYPE HTML>
<html>
<head>
<?php include $_view_obj->compile('mobile/default/lib/meta.html'); ?>
<title>支付订单 - <?php echo htmlspecialchars($GLOBALS['cfg']['site_name'], ENT_QUOTES, "UTF-8"); ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/css/general.css" />
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/iconfont/iconfont.css">
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/css/pay.css" />
<script type="text/javascript" src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/js/zepto.min.js"></script>
<script type="text/javascript" src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/js/verydows.mobile.js"></script>
<script type="text/javascript">
$(function(){
  $('#payments dl').click(function(){
    if(!$(this).hasClass('checked')){
      $('#payments dl.checked').removeClass('checked');
      $(this).addClass('checked');
    }
  });
});

function doPay(){
  $.asynInter("<?php echo url(array('c'=>'api/pay', 'a'=>'url', ));?>", {order_id:$('#order_id').text(), payment_id:$('#payments dl.checked').data('pid'), device:'mobile'}, function(res){
    if(res.status == 'success'){
      window.location.href = res.url;
    }else{
      $.vdsPrompt({content:res.msg});
    }
  });
}
</script>
</head>
<body>
<div class="wrapper">
  <!-- header start -->
  <div class="header">
    <div class="op lt"><a href="<?php echo url(array('c'=>'mobile/order', 'a'=>'view', 'id'=>$order['order_id'], ));?>"><i class="f20 iconfont">&#xe602;</i></a></div>
    <h2>支付订单</h2>
  </div>
  <!-- header end -->
  <div class="pay">
    <div class="order">
      <dl>
        <dt>订单号：</dt>
        <dd><b class="c555" id="order_id"><?php echo htmlspecialchars($order['order_id'], ENT_QUOTES, "UTF-8"); ?></b></dd>
      </dl>
      <dl>
        <dt>金额：</dt>
        <dd class="amount"><i class="f18 cny">¥</i><font class="f18 ml2"><?php echo htmlspecialchars($order['order_amount'], ENT_QUOTES, "UTF-8"); ?></font></dd>
      </dl>
    </div>
    <div class="payment mt10" id="payments">
      <?php $_foreach_v_counter = 0; $_foreach_v_total = count($payment_list);?><?php foreach( $payment_list as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
      <dl<?php if ($order['payment_method'] == $v['id']) : ?> class="checked"<?php endif; ?> data-pid="<?php echo htmlspecialchars($v['id'], ENT_QUOTES, "UTF-8"); ?>">
        <dd class="fr"><a><i class="iconfont">&#xe61a;</i></a></dd>
        <dd class="fl"><i class="iconfont payico-<?php echo htmlspecialchars($v['pcode'], ENT_QUOTES, "UTF-8"); ?>"></i></dd>
        <dd class="desc"><p class="f14"><?php echo htmlspecialchars($v['name'], ENT_QUOTES, "UTF-8"); ?></p></dd>
      </dl>
      <?php endforeach; ?>
      <div class="more center"><font class="mr5">查看更多付款方式</font><i class="iconfont">&#xe615;</i></div>
    </div>
    <div class="submit mt20"><a class="xauto center" onclick="doPay()">付 款</a></div>
  </div>
</div>
<?php include $_view_obj->compile('mobile/default/lib/footer.html'); ?>
</body>
</html>