<?php if(!class_exists("View", false)) exit("no direct access allowed");?><!DOCTYPE HTML>
<html>
<head>
<?php include $_view_obj->compile('mobile/default/lib/meta.html'); ?>
<meta name="keywords" content="商品搜索" />
<meta name="description" content="商品搜索" />
<title>商品搜索 - <?php echo htmlspecialchars($GLOBALS['cfg']['site_name'], ENT_QUOTES, "UTF-8"); ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/css/general.css" />
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/iconfont/iconfont.css">
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/css/search.css">
<script type="text/javascript" src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/js/zepto.min.js"></script>
<script type="text/javascript" src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/js/verydows.mobile.js"></script>
<script type="text/javascript" src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/js/search.js"></script>
<script type="text/javascript">
var searchApi = "<?php echo url(array('c'=>'api/goods', 'a'=>'search', ));?>";
</script>
</head>
<body>
<?php include $_view_obj->compile('mobile/default/lib/searcher.html'); ?>
<div class="wrapper" id="wrapper">
  <div class="searcher">
    <div class="main">
      <a class="back pointer" href="javascript:history.back(-1)"><i class="iconfont">&#xe638;</i></a>
      <a class="latsw pointer" id="latsw"><i class="f18 iconfont">&#xe637;</i></a>
      <div class="scfake in cut"><input id="kwfake" type="text" value="<?php echo htmlspecialchars($u['kw'], ENT_QUOTES, "UTF-8"); ?>" /></div>
    </div>
  </div>
  <div class="absmu latent hide" id="top-menus">
    <a href="<?php echo url(array('c'=>'mobile/main', 'a'=>'index', ));?>"><i class="iconfont">&#xe606;</i><span>首页</span></a>
    <a href="<?php echo url(array('c'=>'mobile/category', 'a'=>'index', ));?>"><i class="iconfont">&#xe60b;</i><span>商品分类</span></a>
    <a href="<?php echo url(array('c'=>'mobile/cart', 'a'=>'index', ));?>"><i class="iconfont">&#xe603;</i><span>购物车</span></a>
    <a href="<?php echo url(array('c'=>'mobile/user', 'a'=>'index', ));?>"><i class="iconfont">&#xe632;</i><span>我的</span></a>
  </div>
  <div class="module">
    <?php if (!empty($goods_list)) : ?>
    <ul class="sortby">
      <?php if ($u['sort'] == 0) : ?>
      <li class="cur"><a>默认</a></li>
      <?php else : ?>
      <li><a href="<?php echo url(array('c'=>'mobile/search', 'a'=>'index', 'cate'=>$u['cate'], 'brand'=>$u['brand'], 'minpri'=>$u['minpri'], 'maxpri'=>$u['maxpri'], 'kw'=>$u['kw'], ));?>">默认</a></li>
      <?php endif; ?>
      <?php if ($u['sort'] == 1) : ?>
      <li class="cur"><a href="<?php echo url(array('c'=>'mobile/search', 'a'=>'index', 'cate'=>$u['cate'], 'brand'=>$u['brand'], 'minpri'=>$u['minpri'], 'maxpri'=>$u['maxpri'], 'kw'=>$u['kw'], 'sort'=>'2', ));?>">价格<i class="arrow iconfont">&#xe63c;</i></a></li>
      <?php elseif ($u['sort'] == 2) : ?>
      <li class="cur"><a href="<?php echo url(array('c'=>'mobile/search', 'a'=>'index', 'cate'=>$u['cate'], 'brand'=>$u['brand'], 'minpri'=>$u['minpri'], 'maxpri'=>$u['maxpri'], 'kw'=>$u['kw'], 'sort'=>'1', ));?>">价格<i class="arrow iconfont">&#xe63b;</i></a></li>
      <?php else : ?>
      <li><a href="<?php echo url(array('c'=>'mobile/search', 'a'=>'index', 'cate'=>$u['cate'], 'brand'=>$u['brand'], 'minpri'=>$u['minpri'], 'maxpri'=>$u['maxpri'], 'kw'=>$u['kw'], 'sort'=>'1', ));?>">价格</a></li>
      <?php endif; ?>
      <?php if ($u['sort'] == 3) : ?>
      <li class="cur"><a href="<?php echo url(array('c'=>'mobile/search', 'a'=>'index', 'cate'=>$u['cate'], 'brand'=>$u['brand'], 'minpri'=>$u['minpri'], 'maxpri'=>$u['maxpri'], 'kw'=>$u['kw'], 'sort'=>'4', ));?>">时间<i class="arrow iconfont">&#xe63c;</i></a></li>
      <?php elseif ($u['sort'] == 4) : ?>
      <li class="cur"><a href="<?php echo url(array('c'=>'mobile/search', 'a'=>'index', 'cate'=>$u['cate'], 'brand'=>$u['brand'], 'minpri'=>$u['minpri'], 'maxpri'=>$u['maxpri'], 'kw'=>$u['kw'], 'sort'=>'3', ));?>">时间<i class="arrow iconfont">&#xe63b;</i></a></li>
      <?php else : ?>
      <li><a href="<?php echo url(array('c'=>'mobile/search', 'a'=>'index', 'cate'=>$u['cate'], 'brand'=>$u['brand'], 'minpri'=>$u['minpri'], 'maxpri'=>$u['maxpri'], 'kw'=>$u['kw'], 'sort'=>'3', ));?>">时间</a></li>
      <?php endif; ?>
      <li onclick="showFilters()"><a>筛选</a></li>
    </ul>
    <div class="srli" id="srli" data-cur='1' data-next='2'>
      <?php $_foreach_v_counter = 0; $_foreach_v_total = count($goods_list);?><?php foreach( $goods_list as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
      <div class="item">
        <a class="gim" href="<?php echo url(array('c'=>'mobile/goods', 'a'=>'index', 'id'=>$v['goods_id'], ));?>"><img src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/upload/goods/prime/100x100/<?php echo htmlspecialchars($v['goods_image'], ENT_QUOTES, "UTF-8"); ?>" /></a>
        <div class="gin">
          <a class="gn" href="<?php echo url(array('c'=>'mobile/goods', 'a'=>'index', 'id'=>$v['goods_id'], ));?>"><?php echo htmlspecialchars($v['goods_name'], ENT_QUOTES, "UTF-8"); ?></a>
          <div class="st mt5 mustrcut"><?php echo $v['goods_brief']; ?></div>
          <p class="pri mt5"><i class="cny">¥</i><font class="f14"><?php echo htmlspecialchars($v['now_price'], ENT_QUOTES, "UTF-8"); ?></font></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <div class="nomore hide" id="nomore">—— 没有更多内容了 ——</div>
    <?php else : ?>
    <div class="nodata"><div class="th"><span><i class="iconfont">&#xe639;</i></span><div class="line"></div></div><p class="mt8">抱歉没有找到符合条件的商品</p></div>
    <?php endif; ?>
  </div>
</div>
<div class="filters hide" id="filters">
  <div class="mask"></div>
  <div class="main">
    <div class="th cut">
      <a class="lt" onclick="closeFilters()"><i class="f18 iconfont">&#xe62d;</i></a>
      <h2>筛选</h2>
    </div>
    <div class="elm cut">
      <?php if (!empty($filters['cate'])) : ?>
      <p class="ek"><span><i class="iconfont">&#xe614;</i></span>分类</p>
      <div class="ev">
        <?php if ($u['cate'] == 0) : ?>
        <a class="cur"><i class="iconfont">&#xe61a;</i>不限</a>
        <?php else : ?>
        <a href="<?php echo url(array('c'=>'mobile/search', 'a'=>'index', 'brand'=>$u['brand'], 'att'=>$u['att'], 'minpri'=>$u['minpri'], 'maxpri'=>$u['maxpri'], 'kw'=>$u['kw'], 'sort'=>$u['sort'], ));?>">不限</a>
        <?php endif; ?>
        <?php $_foreach_v_counter = 0; $_foreach_v_total = count($filters['cate']);?><?php foreach( $filters['cate'] as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
        <?php if ($u['cate'] == $v['cate_id']) : ?>
        <a class="cur"><i class="iconfont">&#xe61a;</i><?php echo htmlspecialchars($v['cate_name'], ENT_QUOTES, "UTF-8"); ?></a>
        <?php else : ?>
        <a href="<?php echo url(array('c'=>'mobile/search', 'a'=>'index', 'cate'=>$v['cate_id'], 'brand'=>$u['brand'], 'att'=>$u['att'], 'minpri'=>$u['minpri'], 'maxpri'=>$u['maxpri'], 'kw'=>$u['kw'], 'sort'=>$u['sort'], ));?>"><?php echo htmlspecialchars($v['cate_name'], ENT_QUOTES, "UTF-8"); ?></a>
        <?php endif; ?>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
      <?php if (!empty($filters['brand'])) : ?>
      <p class="ek"><span><i class="iconfont">&#xe614;</i></span>品牌</p>
      <div class="ev">
        <?php if ($u['brand'] == 0) : ?>
        <a class="cur"><i class="iconfont">&#xe61a;</i>不限</a>
        <?php else : ?>
        <a href="<?php echo url(array('c'=>'mobile/search', 'a'=>'index', 'cate'=>$u['cate'], 'att'=>$u['att'], 'minpri'=>$u['minpri'], 'maxpri'=>$u['maxpri'], 'kw'=>$u['kw'], 'sort'=>$u['sort'], ));?>">不限</a>
        <?php endif; ?>
        <?php $_foreach_v_counter = 0; $_foreach_v_total = count($filters['brand']);?><?php foreach( $filters['brand'] as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
        <?php if ($u['brand'] == $v['brand_id']) : ?>
        <a class="cur"><i class="iconfont">&#xe61a;</i><?php echo htmlspecialchars($v['brand_name'], ENT_QUOTES, "UTF-8"); ?></a>
        <?php else : ?>
        <a href="<?php echo url(array('c'=>'mobile/search', 'a'=>'index', 'cate'=>$u['cate'], 'brand'=>$v['brand_id'], 'att'=>$u['att'], 'minpri'=>$u['minpri'], 'maxpri'=>$u['maxpri'], 'kw'=>$u['kw'], 'sort'=>$u['sort'], ));?>"><?php echo htmlspecialchars($v['brand_name'], ENT_QUOTES, "UTF-8"); ?></a>
        <?php endif; ?>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
      <?php if (!empty($filters['attr'])) : ?>
      <?php $_foreach_v_counter = 0; $_foreach_v_total = count($filters['attr']);?><?php foreach( $filters['attr'] as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
      <p class="ek"><span><i class="iconfont">&#xe614;</i></span><?php echo htmlspecialchars($v['name'], ENT_QUOTES, "UTF-8"); ?></p>
      <div class="ev">
        <?php if ($v['unlimit']['checked'] == 1) : ?>
        <a class="cur"><i class="iconfont">&#xe61a;</i>不限</a>
        <?php else : ?>
        <a href="<?php echo url(array('c'=>'mobile/search', 'a'=>'index', 'cate'=>$u['cate'], 'brand'=>$u['brand'], 'att'=>$v['unlimit']['att'], 'minpri'=>$u['minpri'], 'maxpri'=>$u['maxpri'], 'kw'=>$u['kw'], 'sort'=>$u['sort'], ));?>">不限</a>
        <?php endif; ?>
        <?php $_foreach_vv_counter = 0; $_foreach_vv_total = count($v['opts']);?><?php foreach( $v['opts'] as $vv ) : ?><?php $_foreach_vv_index = $_foreach_vv_counter;$_foreach_vv_iteration = $_foreach_vv_counter + 1;$_foreach_vv_first = ($_foreach_vv_counter == 0);$_foreach_vv_last = ($_foreach_vv_counter == $_foreach_vv_total - 1);$_foreach_vv_counter++;?>
        <?php if ($vv['checked'] == 1) : ?>
        <a class="cur"><i class="iconfont">&#xe61a;</i><?php echo htmlspecialchars($vv['name'], ENT_QUOTES, "UTF-8"); ?></a>
        <?php else : ?>
        <a href="<?php echo url(array('c'=>'mobile/search', 'a'=>'index', 'cate'=>$u['cate'], 'brand'=>$u['brand'], 'att'=>$vv['att'], 'minpri'=>$u['minpri'], 'maxpri'=>$u['maxpri'], 'kw'=>$u['kw'], 'sort'=>$u['sort'], ));?>"><?php echo htmlspecialchars($vv['name'], ENT_QUOTES, "UTF-8"); ?></a>
        <?php endif; ?>
        <?php endforeach; ?>
      </div>
      <?php endforeach; ?>
      <?php endif; ?>
      <?php if (!empty($filters['price'])) : ?>
      <p class="ek"><span><i class="iconfont">&#xe614;</i></span>价格</p>
      <div class="ev">
        <?php if ($u['minpri'] == 0 && $u['maxpri'] == 0) : ?>
        <a class="cur"><i class="iconfont">&#xe61a;</i>不限</a>
        <?php else : ?>
        <a href="<?php echo url(array('c'=>'mobile/search', 'a'=>'index', 'cate'=>$u['cate'], 'brand'=>$u['brand'], 'att'=>$u['att'], 'kw'=>$u['kw'], 'sort'=>$u['sort'], ));?>">不限</a>
        <?php endif; ?>
        <?php $_foreach_v_counter = 0; $_foreach_v_total = count($filters['price']);?><?php foreach( $filters['price'] as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
        <?php if ($u['minpri'] == $v['min'] && $u['maxpri'] == $v['max']) : ?>
        <a class="cur"><i class="iconfont">&#xe61a;</i><?php echo htmlspecialchars($v['str'], ENT_QUOTES, "UTF-8"); ?></a>
        <?php else : ?>
        <a href="<?php echo url(array('c'=>'mobile/search', 'a'=>'index', 'cate'=>$u['cate'], 'brand'=>$u['brand'], 'att'=>$u['att'], 'minpri'=>$v['min'], 'maxpri'=>$v['max'], 'kw'=>$u['kw'], 'sort'=>$u['sort'], ));?>"><?php echo htmlspecialchars($v['str'], ENT_QUOTES, "UTF-8"); ?></a>
        <?php endif; ?>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </div>
  </div>
</div>
<script type="text/template" id="goods-tpl">
{@each list as v}
<div class="item">
  <a class="gim" href="<?php echo url(array('c'=>'mobile/goods', 'a'=>'index', 'id'=>'${v.goods_id}', ));?>"><img src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/upload/goods/prime/100x100/${v.goods_image}" /></a>
  <div class="gin">
    <a class="gn" href="<?php echo url(array('c'=>'mobile/goods', 'a'=>'index', 'id'=>'${v.goods_id}', ));?>">${v.goods_name}</a>
    <p class="st mt5 mustrcut">$${v.goods_brief}</p>
    <p class="pri mt5"><i class="cny">¥</i><font class="f14">${v.now_price}</font></p>
  </div>
</div>
{@/each}
</script>
<script type="text/javascript" src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/public/script/juicer.js"></script>
<?php include $_view_obj->compile('mobile/default/lib/footer.html'); ?>
</body>
</html>