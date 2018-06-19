<?php if(!class_exists("View", false)) exit("no direct access allowed");?><!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8" />
<?php include $_view_obj->compile('mobile/default/lib/meta.html'); ?>
<title>商品分类 - <?php echo htmlspecialchars($GLOBALS['cfg']['site_name'], ENT_QUOTES, "UTF-8"); ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/css/general.css" />
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/iconfont/iconfont.css">
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/css/search.css">
<script type="text/javascript" src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/js/zepto.min.js"></script>
<script type="text/javascript" src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/js/verydows.mobile.js"></script>
<script type="text/javascript" src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/js/search.js"></script>
<script type="text/javascript">
$(function(){
  $('#cate-tabs a').click(function(){
    var i = $(this).index();
    $('#cate-tabs a.cur').removeClass('cur');
    $(this).addClass('cur');
    $('#cate-con dl.cur').removeClass('cur');
    $('#cate-con dl').eq(i).addClass('cur');
  });
});
</script>
</head>
<body>
<?php include $_view_obj->compile('mobile/default/lib/searcher.html'); ?>
<div class="wrapper" id="wrapper">
  <!-- header start -->
  <div class="searcher">
    <div class="main">
      <a class="back pointer" href="<?php echo url(array('c'=>'mobile/main', 'a'=>'index', ));?>"><i class="iconfont">&#xe638;</i></a>
      <a class="latsw pointer" id="latsw"><i class="f18 iconfont">&#xe637;</i></a>
      <div class="scfake in cut"><input id="kwfake" type="text" value="" /></div>
    </div>
  </div>
  <div class="absmu latent hide" id="top-menus">
    <a href="<?php echo url(array('c'=>'mobile/main', 'a'=>'index', ));?>"><i class="iconfont">&#xe606;</i><span>首页</span></a>
    <a class="cur"><i class="iconfont">&#xe60b;</i><span>商品分类</span></a>
    <a href="<?php echo url(array('c'=>'mobile/cart', 'a'=>'index', ));?>"><i class="iconfont">&#xe603;</i><span>购物车</span></a>
    <a href="<?php echo url(array('c'=>'mobile/user', 'a'=>'index', ));?>"><i class="iconfont">&#xe632;</i><span>我的</span></a>
  </div>
  <!-- header end -->
  <?php if (!empty($cate_list)) : ?>
  <div class="catewrap module cut">
    <div class="cate-top" id="cate-tabs">
      <?php $_foreach_v_counter = 0; $_foreach_v_total = count($cate_list);?><?php foreach( $cate_list as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
      <a <?php if ($_foreach_v_first == true) : ?>class="cur"<?php endif; ?>><?php echo htmlspecialchars($v['cate_name'], ENT_QUOTES, "UTF-8"); ?></a>
      <?php endforeach; ?>
    </div>
    <div class="cate-sub" id="cate-con">
      <?php $_foreach_v_counter = 0; $_foreach_v_total = count($cate_list);?><?php foreach( $cate_list as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
      <dl <?php if ($_foreach_v_first == true) : ?>class="cur"<?php endif; ?>>
        <dt><a href="<?php echo url(array('c'=>'mobile/search', 'a'=>'index', 'cate'=>$v['cate_id'], ));?>">全部<?php echo htmlspecialchars($v['cate_name'], ENT_QUOTES, "UTF-8"); ?></a></dt>
        <dd>
          <?php if (!empty($v['children'])) : ?>
          <?php $_foreach_vv_counter = 0; $_foreach_vv_total = count($v['children']);?><?php foreach( $v['children'] as $vv ) : ?><?php $_foreach_vv_index = $_foreach_vv_counter;$_foreach_vv_iteration = $_foreach_vv_counter + 1;$_foreach_vv_first = ($_foreach_vv_counter == 0);$_foreach_vv_last = ($_foreach_vv_counter == $_foreach_vv_total - 1);$_foreach_vv_counter++;?>
          <a href="<?php echo url(array('c'=>'mobile/search', 'a'=>'index', 'cate'=>$vv['cate_id'], ));?>"><?php echo htmlspecialchars($vv['cate_name'], ENT_QUOTES, "UTF-8"); ?></a>
          <?php endforeach; ?>
          <?php endif; ?>
        </dd>
      </dl>
      <?php endforeach; ?>
    </div>
  </div>
  <?php else : ?>
  <div class="nodata">
    <div class="th"><span><i class="iconfont">&#xe60b;</i></span><div class="line"></div></div>
    <p>暂无商品分类记录</p>
  </div>
  <?php endif; ?>
</div>
<script type="text/javascript" src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/public/script/juicer.js"></script>
<?php include $_view_obj->compile('mobile/default/lib/footer.html'); ?>
</body>
</html>