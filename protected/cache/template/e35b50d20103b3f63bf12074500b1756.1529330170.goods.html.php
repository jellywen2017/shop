<?php if(!class_exists("View", false)) exit("no direct access allowed");?><!DOCTYPE HTML>
<html>
<head>
<?php include $_view_obj->compile('mobile/default/lib/meta.html'); ?>
<meta name="keywords" content="<?php echo htmlspecialchars($goods['meta_keywords'], ENT_QUOTES, "UTF-8"); ?>" />
<meta name="description" content="<?php echo htmlspecialchars($goods['meta_description'], ENT_QUOTES, "UTF-8"); ?>" />
<title><?php echo htmlspecialchars($goods['goods_name'], ENT_QUOTES, "UTF-8"); ?> - <?php echo htmlspecialchars($GLOBALS['cfg']['site_name'], ENT_QUOTES, "UTF-8"); ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/css/general.css" />
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/iconfont/iconfont.css">
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/css/goods.css" />
<script type="text/javascript" src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/js/zepto.min.js"></script>
<script type="text/javascript" src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/js/verydows.mobile.js"></script>
<script type="text/javascript" src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/js/goods.js"></script>
<script type="text/javascript">
$(function(){
  viewCartbar();
  preserveSpace('footfixed');
  $('#showMenuBtn').vdsTapSwapper(
    function(){$('#topMenu').height(50);},
    function(){$('#topMenu').height(0);}
  );
  albumSlider();
});

function addFavorite(goods_id){
  $.asynInter("<?php echo url(array('c'=>'api/favorite', 'a'=>'add', ));?>", {goods_id:goods_id}, function(res){
    if(res.status == 'success'){
      $.vdsPrompt({content:'加入收藏夹成功!'});
    }else if(res.status == 'unlogined'){
      $.vdsPrompt({
        content:res.msg,
        clicked:function(){
          window.location.href = "<?php echo url(array('c'=>'mobile/user', 'a'=>'login', ));?>";
        }
      });
    }
    else{
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
    <div class="op lt"><a href="javascript:history.back(-1);"><i class="f20 iconfont">&#xe602;</i></a></div>
    <h2>商品详情</h2>
    <div class="op rt"><a class="pointer" id="showMenuBtn"><i class="f28 iconfont">&#xe60e;</i></a></div>
  </div>
  <!-- header end -->
  <div class="absmu latent" id="topMenu">
    <a href="<?php echo url(array('c'=>'mobile/main', 'a'=>'index', ));?>"><i class="home iconfont">&#xe606;</i><span>首页</span></a>
    <a href="<?php echo url(array('c'=>'mobile/category', 'a'=>'index', ));?>"><i class="home iconfont">&#xe60b;</i><span>商品分类</span></a>
    <a href="<?php echo url(array('c'=>'mobile/cart', 'a'=>'index', ));?>"><i class="home iconfont">&#xe603;</i><span>购物车</span></a>
    <a href="<?php echo url(array('c'=>'mobile/user', 'a'=>'index', ));?>"><i class="home iconfont">&#xe632;</i><span>我的</span></a>
  </div>
  <!-- goods imgs start -->
  <div class="gims" id="gims">
    <div class="slider">
      <a><img src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/upload/goods/prime/350x350/<?php echo htmlspecialchars($goods['goods_image'], ENT_QUOTES, "UTF-8"); ?>" /></a>
      <?php if (!empty($album_list)) : ?>
      <?php $_foreach_v_counter = 0; $_foreach_v_total = count($album_list);?><?php foreach( $album_list as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
      <a><img src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/upload/goods/album/350x350/<?php echo htmlspecialchars($v['image'], ENT_QUOTES, "UTF-8"); ?>"></a>
      <?php endforeach; ?>
      <?php endif; ?>
    </div>
    <div class="clearfix"></div>
    <div class="trigger"><b>1</b><span>/</span><font>1</font></div>
  </div>
  <!-- goods imgs end -->
  <div class="gth">
    <h2><?php echo htmlspecialchars($goods['goods_name'], ENT_QUOTES, "UTF-8"); ?></h2>
    <h3 class="mt8 c888"><?php echo $goods['goods_brief']; ?></h3>
    <div class="pri mt8">
      <?php if ($goods['original_price'] > 0) : ?><span class="ori cny mr10">¥<?php echo htmlspecialchars($goods['original_price'], ENT_QUOTES, "UTF-8"); ?></span><?php endif; ?>
      <span class="cny"><i>¥</i><font id="nowprice" data-price="<?php echo htmlspecialchars($goods['now_price'], ENT_QUOTES, "UTF-8"); ?>"><?php echo htmlspecialchars($goods['now_price'], ENT_QUOTES, "UTF-8"); ?></font></span>
    </div>
  </div>
  <div class="gopts mt10" id="buyopts">
    <?php if (!empty($opt_list)) : ?>
    <?php $_foreach_v_counter = 0; $_foreach_v_total = count($opt_list);?><?php foreach( $opt_list as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
    <dl class="ck">
      <dt data-name="<?php echo htmlspecialchars($v['type_name'], ENT_QUOTES, "UTF-8"); ?>"><?php echo htmlspecialchars($v['type_name'], ENT_QUOTES, "UTF-8"); ?>：</dt>
      <dd>
        <?php $_foreach_vv_counter = 0; $_foreach_vv_total = count($v['children']);?><?php foreach( $v['children'] as $vv ) : ?><?php $_foreach_vv_index = $_foreach_vv_counter;$_foreach_vv_iteration = $_foreach_vv_counter + 1;$_foreach_vv_first = ($_foreach_vv_counter == 0);$_foreach_vv_last = ($_foreach_vv_counter == $_foreach_vv_total - 1);$_foreach_vv_counter++;?>
        <a data-key="<?php echo htmlspecialchars($vv['id'], ENT_QUOTES, "UTF-8"); ?>" data-price="<?php echo htmlspecialchars($vv['opt_price'], ENT_QUOTES, "UTF-8"); ?>"><?php echo htmlspecialchars($vv['opt_text'], ENT_QUOTES, "UTF-8"); ?></a>
        <?php endforeach; ?>
      </dd>
    </dl>
    <?php endforeach; ?>
    <?php endif; ?>
    <dl class="qty">
      <dt>数量：</dt>
      <dd>
        <a class="minus" onclick="changeBuyQty('decr')">-</a><input id="buy-qty" type="text" readonly value="1" data-stock='<?php echo htmlspecialchars($goods['stock_qty'], ENT_QUOTES, "UTF-8"); ?>' /><a class="plus" onclick="changeBuyQty('incr')">+</a>
        <?php if (($GLOBALS['cfg']['show_goods_stock'])) : ?>
        <span class="stock">剩余<b class="pink"><?php echo htmlspecialchars($goods['stock_qty'], ENT_QUOTES, "UTF-8"); ?></b>件</span>
        <?php endif; ?>
      </dd>
    </dl>
  </div>
  <div class="gdata mt10 cut">
    <a href="<?php echo url(array('c'=>'mobile/goods', 'a'=>'illustrated', 'id'=>$goods['goods_id'], ));?>">
      <span class="fl"><font class="f14">图文详情</font></span>
      <i class="fr iconfont">&#xe614;</i>
      <span class="hint fr">建议在WIFI环境下使用</span>
    </a>
    <a href="<?php echo url(array('c'=>'mobile/goods', 'a'=>'specs', 'id'=>$goods['goods_id'], ));?>">
      <span class="fl"><font class="f14">规格参数</font></span>
      <i class="fr iconfont">&#xe614;</i>
    </a>
    <a href="<?php echo url(array('c'=>'mobile/goods', 'a'=>'reviews', 'id'=>$goods['goods_id'], ));?>">
      <span class="fl"><font class="f14">商品评价</font><font class="total ml5">(<?php echo htmlspecialchars($review_rating['total'], ENT_QUOTES, "UTF-8"); ?>)</font></span>
      <i class="fr iconfont">&#xe614;</i>
      <?php if ($review_rating['total'] > 0) : ?><span class="hint fr">满意度<?php echo htmlspecialchars($review_rating['satis'], ENT_QUOTES, "UTF-8"); ?>%</span><?php endif; ?>
    </a>
  </div>
  <?php if (!empty($related)) : ?>
  <div class="lateral mt10">
    <div class="th"><h2><i class="icon"></i><font>相关推荐</font></h2></div>
    <div class="gli">
      <div class="slider">
        <div class="col">
          <ul>
            <?php $_foreach_v_counter = 0; $_foreach_v_total = count($related);?><?php foreach( $related as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
            <li>
              <div class="im"><a href="<?php echo url(array('c'=>'mobile/goods', 'a'=>'index', 'id'=>$v['goods_id'], ));?>"><img alt="<?php echo htmlspecialchars($v['goods_name'], ENT_QUOTES, "UTF-8"); ?>" src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/upload/goods/prime/100x100/<?php echo htmlspecialchars($v['goods_image'], ENT_QUOTES, "UTF-8"); ?>" /></a></div>
              <h3 class="mustrcut"><a href="<?php echo url(array('c'=>'mobile/goods', 'a'=>'index', 'id'=>$v['goods_id'], ));?>"><?php echo htmlspecialchars($v['goods_name'], ENT_QUOTES, "UTF-8"); ?></a></h3>
              <p class="price"><i>¥</i><?php echo htmlspecialchars($v['now_price'], ENT_QUOTES, "UTF-8"); ?></p>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
  <?php endif; ?>
  <?php if (!empty($bestseller)) : ?>
  <div class="lateral mt10">
    <div class="th"><h2><i class="icon"></i><font>热销榜</font></h2></div>
    <div class="gli">
      <div class="slider">
        <div class="col">
          <ul>
            <?php $_foreach_v_counter = 0; $_foreach_v_total = count($bestseller);?><?php foreach( $bestseller as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
            <li>
              <div class="im"><a href="<?php echo url(array('c'=>'mobile/goods', 'a'=>'index', 'id'=>$v['goods_id'], ));?>"><img alt="<?php echo htmlspecialchars($v['goods_name'], ENT_QUOTES, "UTF-8"); ?>" src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/upload/goods/prime/100x100/<?php echo htmlspecialchars($v['goods_image'], ENT_QUOTES, "UTF-8"); ?>" /></a></div>
              <h3 class="mustrcut"><a href="<?php echo url(array('c'=>'mobile/goods', 'a'=>'index', 'id'=>$v['goods_id'], ));?>"><?php echo htmlspecialchars($v['goods_name'], ENT_QUOTES, "UTF-8"); ?></a></h3>
              <p class="sold">已售出<b><?php echo htmlspecialchars($v['count'], ENT_QUOTES, "UTF-8"); ?></b>件</p>
              <p class="price"><i>¥</i><?php echo htmlspecialchars($v['now_price'], ENT_QUOTES, "UTF-8"); ?></p>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
  <?php endif; ?>
</div>
<div class="footact" id="footfixed">
  <div class="iact fl cut">
    <a href="javascript:void(0)" onclick="addFavorite('<?php echo htmlspecialchars($goods['goods_id'], ENT_QUOTES, "UTF-8"); ?>')"><i class="iconfont">&#xe605;</i><span>收藏</span></a>
    <a id="cartbar" href="<?php echo url(array('c'=>'mobile/cart', 'a'=>'index', ));?>"><i class="iconfont">&#xe603;</i><span>购物车</span><em class="hide">0</em></a>
  </div>
  <div class="bact cut"><a class="add" id="addcartbtn" onclick="addToCart('<?php echo htmlspecialchars($goods['goods_id'], ENT_QUOTES, "UTF-8"); ?>')">加入购物车</a><a class="buy" onclick="toBuy('<?php echo htmlspecialchars($goods['goods_id'], ENT_QUOTES, "UTF-8"); ?>', '<?php echo url(array('c'=>'mobile/cart', 'a'=>'index', ));?>')">立即购买</a></div>
</div>
<?php include $_view_obj->compile('mobile/default/lib/footer.html'); ?>
</body>
</html>