<?php if(!class_exists("View", false)) exit("no direct access allowed");?><!DOCTYPE HTML>
<html>
<head>
<?php include $_view_obj->compile('mobile/default/lib/meta.html'); ?>
<title>确认订单 - <?php echo htmlspecialchars($GLOBALS['cfg']['site_name'], ENT_QUOTES, "UTF-8"); ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/css/general.css" />
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/iconfont/iconfont.css">
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/css/order.css" />
<script type="text/javascript" src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/js/zepto.min.js"></script>
<script type="text/javascript" src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/js/verydows.mobile.js"></script>
<script type="text/javascript" src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/js/order.js"></script>
<script type="text/javascript" src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/js/consignee.js"></script>
<script type="text/javascript">
var freightApi = "<?php echo url(array('c'=>'api/order', 'a'=>'freight', ));?>", areaApi = "<?php echo url(array('c'=>'api/area', 'a'=>'children', ));?>";

$(function(){
  getFreight();
});

function submitOrder(){
  var csn_id = $('#consignee h4').data('id') || false;
  if(!csn_id){
    $.vdsPrompt({content:'您必须先创建一个收件人信息'});
    return false;
  }
  $.asynInter("<?php echo url(array('c'=>'api/order', 'a'=>'submit', ));?>", {csn_id:csn_id, shipping_id:$('#shipping_method').val(), memos:$('#memos').val()}, function(res){
    if(res.status == 'success'){
      var target = "<?php echo url(array('c'=>'mobile/pay', 'a'=>'index', 'order_id'=>'$replace', ));?>";
      window.location.href = target.replace('$replace', res.order_id);
    }else{
      $.vdsPrompt({content:res.msg});
    }
  });
}
</script>
</head>
<body>
<div class="wrapper" id="wrapper">
  <!-- header start -->
  <div class="header">
    <div class="op lt"><a href="javascript:history.back(-1)"><i class="f20 iconfont">&#xe602;</i></a></div>
    <h2>确认订单</h2>
  </div>
  <!-- header end -->
  <div class="confirm">
    <div class="row" id="consignee">
      <div class="lc">收件人</div>
      <?php if (!empty($consignee_list[0])) : ?>
      <div class="rc" onclick="popCsnList()">
        <div class="unfold fr"><i class="iconfont">&#xe614;</i></div>
        <h4 class="c666" data-id="<?php echo htmlspecialchars($consignee_list[0]['id'], ENT_QUOTES, "UTF-8"); ?>"><?php echo htmlspecialchars($consignee_list[0]['receiver'], ENT_QUOTES, "UTF-8"); ?><span class="ml10"><?php echo htmlspecialchars($consignee_list[0]['mobile'], ENT_QUOTES, "UTF-8"); ?></span></h4>
        <p class="mt5 c888"><?php echo htmlspecialchars($consignee_list[0]['area']['province'], ENT_QUOTES, "UTF-8"); ?> <?php echo htmlspecialchars($consignee_list[0]['area']['city'], ENT_QUOTES, "UTF-8"); ?> <?php echo htmlspecialchars($consignee_list[0]['area']['borough'], ENT_QUOTES, "UTF-8"); ?> <?php echo htmlspecialchars($consignee_list[0]['address'], ENT_QUOTES, "UTF-8"); ?><?php if (!empty($consignee_list[0]['zip'])) : ?><br /><?php echo htmlspecialchars($consignee_list[0]['zip'], ENT_QUOTES, "UTF-8"); ?><?php endif; ?></p>
      </div>
      <?php else : ?>
      <div class="rc" onclick="popCsnList()"><a class="add" onclick="addCsn()">+ 添加收件人</a></div>
      <?php endif; ?>
    </div>
    <div class="row">
      <div class="lc">配送方式</div>
      <div class="rc">
        <div class="vslt">
          <select id="shipping_method" onchange="getFreight()">
            <?php $_foreach_v_counter = 0; $_foreach_v_total = count($shipping_list);?><?php foreach( $shipping_list as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
            <option value="<?php echo htmlspecialchars($v['id'], ENT_QUOTES, "UTF-8"); ?>"<?php if ($_foreach_v_first == true) : ?> selected="selected"<?php endif; ?>><?php echo htmlspecialchars($v['name'], ENT_QUOTES, "UTF-8"); ?></option>
            <?php endforeach; ?>
          </select>
          <span><i class="iconfont">&#xe615;</i></span>
        </div>
      </div>
    </div>
    <div class="parcel row" id="parcel">
      <div class="lc">包裹清单</div>
      <div class="rc">
        <ul class="gli" id="gli">
          <?php $_foreach_v_counter = 0; $_foreach_v_total = count($cart['items']);?><?php foreach( $cart['items'] as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
          <li>
            <div class="im"><img alt="<?php echo htmlspecialchars($v['goods_name'], ENT_QUOTES, "UTF-8"); ?>" src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/upload/goods/prime/50x50/<?php echo htmlspecialchars($v['goods_image'], ENT_QUOTES, "UTF-8"); ?>" /></div>
            <div class="info">
              <p class="name"><?php echo htmlspecialchars($v['goods_name'], ENT_QUOTES, "UTF-8"); ?></p>
              <?php if (!empty($v['opts'])) : ?>
              <p class="opts mt5"><?php $_foreach_o_counter = 0; $_foreach_o_total = count($v['opts']);?><?php foreach( $v['opts'] as $o ) : ?><?php $_foreach_o_index = $_foreach_o_counter;$_foreach_o_iteration = $_foreach_o_counter + 1;$_foreach_o_first = ($_foreach_o_counter == 0);$_foreach_o_last = ($_foreach_o_counter == $_foreach_o_total - 1);$_foreach_o_counter++;?><span class="mr5">[<?php echo htmlspecialchars($o['type'], ENT_QUOTES, "UTF-8"); ?>: <font><?php echo htmlspecialchars($o['opt_text'], ENT_QUOTES, "UTF-8"); ?></font>]</span><?php endforeach; ?></p>
              <?php endif; ?>
              <p class="subtotal mt5 c666"><span class="price mr10"><i class="cny">¥</i><font class="f14"><?php echo htmlspecialchars($v['now_price'], ENT_QUOTES, "UTF-8"); ?></font></span>×<b class="q"><?php echo htmlspecialchars($v['qty'], ENT_QUOTES, "UTF-8"); ?></b></p>
            </div>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
    <div class="memos row">
      <div class="lc">留言备注</div>
      <div class="rc"><textarea name="memos" class="vtextarea" id="memos" placeholder="填写您对订单需要备注的内容，没有请留空"></textarea></div>
    </div>
    <div class="amount">
      <h3 class="f14 center">订单合计</h3>
      <dl>
        <dt>商品合计:</dt>
        <dd class="c666"><i class="cny">¥</i><font class="f14" id="goods-amount"><?php echo htmlspecialchars($cart['amount'], ENT_QUOTES, "UTF-8"); ?></font></dd>
      </dl>
      <dl>
        <dt>运费:</dt>
        <dd class="c666"><i class="cny">¥</i><font class="f14" id="shipping-amount">0.00</font></dd>
      </dl>
      <dl class="totals">
        <dt class="f14">共计:</dt>
        <dd class="f18"><i class="cny">¥</i><font id="total-amount"><?php echo htmlspecialchars($cart['amount'], ENT_QUOTES, "UTF-8"); ?></font></dd>
      </dl>
    </div>
    <div class="submit mt20"><a class="f14 xauto center" onClick="submitOrder()">提交订单</a></div>
  </div>
</div>
<!-- 收件人列表开始 -->
<div class="csnli poper hide" id="csnli">
  <div class="header">
    <div class="op lt"><a onclick="hideCsnList()"><i class="f20 iconfont">&#xe602;</i></a></div>
    <h2>选择收件人</h2>
  </div>
  <div class="opts module">
    <?php if (!empty($consignee_list)) : ?>
    <?php $_foreach_v_counter = 0; $_foreach_v_total = count($consignee_list);?><?php foreach( $consignee_list as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
    <dl id="csnopt-<?php echo htmlspecialchars($v['id'], ENT_QUOTES, "UTF-8"); ?>"<?php if ($_foreach_v_first == true) : ?> class="checked"<?php endif; ?>>
      <dd class="l" onclick="onChangeCsn(this)"><i class="iconfont">&#xe61a;</i></dd>
      <dd class="r" data-json='<?php echo htmlspecialchars($v['json'], ENT_QUOTES, "UTF-8"); ?>' onclick="editCsn(this)"><i class="iconfont">&#xe617;</i></dd>
      <dd class="m">
        <h4 class="c666" data-id="<?php echo htmlspecialchars($v['id'], ENT_QUOTES, "UTF-8"); ?>"><?php echo htmlspecialchars($v['receiver'], ENT_QUOTES, "UTF-8"); ?><span class="ml10"><?php echo htmlspecialchars($v['mobile'], ENT_QUOTES, "UTF-8"); ?></span></h4>
        <p class="mt5 c888"><?php echo htmlspecialchars($v['area']['province'], ENT_QUOTES, "UTF-8"); ?> <?php echo htmlspecialchars($v['area']['city'], ENT_QUOTES, "UTF-8"); ?> <?php echo htmlspecialchars($v['area']['borough'], ENT_QUOTES, "UTF-8"); ?> <?php echo htmlspecialchars($v['address'], ENT_QUOTES, "UTF-8"); ?><?php if (!empty($v['zip'])) : ?><br /><?php echo htmlspecialchars($v['zip'], ENT_QUOTES, "UTF-8"); ?><?php endif; ?></p>
      </dd>
    </dl>
    <?php endforeach; ?>
    <?php endif; ?>
    <a class="add" onclick="addCsn()">+ 添加收件人</a>
  </div>
</div>
<!-- 收件人列表结束 -->
<!-- 收件人表单开始 -->
<div class="csnform hide" id="csnform">
  <div class="header">
    <div class="op lt"><a onclick="hideCsnForm()"><i class="f20 iconfont">&#xe602;</i></a></div>
    <h2>收件人</h2>
  </div>
  <form><div class="main cut"></div></form>
  <a class="submit act xauto mt15" onclick="saveCsnForm('<?php echo url(array('c'=>'api/consignee', 'a'=>'save', ));?>')">保 存</a>
</div>
<!-- 收件人表单结束 -->
<script type="text/template" id="csn-row-tpl">
<dl id="csnopt-${id}"{@if checked == 1} class="checked"{@/if}>
  <dd class="l" onclick="onChangeCsn(this)"><i class="iconfont">&#xe61a;</i></dd>
  <dd class="r" data-json='${json}' onclick="editCsn(this)"><i class="iconfont">&#xe617;</i></dd>
  <dd class="m">
    <h4 class="c666" data-id="${id}">${receiver}<span class="ml10">${mobile}</span></h4>
    <p class="mt5 c888">${province} ${city} ${borough} ${address}{@if zip != ''}<br />${zip}{@/if}</p>
  </dd>
</dl>
</script>
<script type="text/template" id="csn-form-tpl">
<input type="hidden" name="id" value="0" />
<dl><dt>收件人</dt><dd><input name="receiver" type="text" class="vinput"></dd></dl>
<dl><dt>手机号码</dt><dd><input name="mobile" type="number" pattern="[0-9]*" class="vinput"></dd></dl>
<dl>
  <dt>选择省份</dt>
  <dd>
    <div class="vslt">
      <select name="province" id="areaslt-province" data-type="province" onchange="getAreaSelect('province')">
      <option value="">选择省份</option>
      </select>
      <span><i class="iconfont">&#xe615;</i></span>
    </div>
  </dd>
</dl>
<dl>
  <dt>选择城市</dt>
  <dd>
    <div class="vslt">
      <select name="city" id="areaslt-city" onchange="getAreaSelect('city')">
      <option value="">选择城市</option>
      </select>
      <span><i class="iconfont">&#xe615;</i></span>
    </div>
  </dd>
</dl>
<dl>
  <dt>选择区/县</dt>
  <dd>
    <div class="vslt">
      <select name="borough" id="areaslt-borough">
      <option value="">选择区/县</option>
      </select>
      <span><i class="iconfont">&#xe615;</i></span>
    </div>
  </dd>
</dl>
<dl><dt>详细地址</dt><dd><textarea name="address" class="vtextarea"></textarea></dd></dl>
<dl><dt>邮编</dt><dd><input name="zip" type="number" pattern="[0-9]*" class="vinput"></dd></dl>
</script>
<script type="text/template" id="csn-checked-tpl">
<div class="unfold fr"><i class="iconfont">&#xe614;</i></div>
<h4 class="c666" data-id="${id}">${receiver}<span class="ml10">${mobile}</span></h4>
<p class="mt5 c888">${province} ${city} ${borough} ${address}{@if zip != ''}<br />${zip}{@/if}</p>
</script>
<script type="text/javascript" src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/public/script/juicer.js"></script>
<?php include $_view_obj->compile('mobile/default/lib/footer.html'); ?>
</body>
</html>