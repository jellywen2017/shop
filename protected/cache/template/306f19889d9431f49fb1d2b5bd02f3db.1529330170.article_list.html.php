<?php if(!class_exists("View", false)) exit("no direct access allowed");?><!DOCTYPE HTML>
<html>
<head>
<?php include $_view_obj->compile('mobile/default/lib/meta.html'); ?>
<meta name="keywords" content="资讯" />
<meta name="description" content="资讯" />
<title>资讯 - <?php echo htmlspecialchars($GLOBALS['cfg']['site_name'], ENT_QUOTES, "UTF-8"); ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/css/general.css" />
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/iconfont/iconfont.css">
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/css/article.css" />
<script type="text/javascript" src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/js/zepto.min.js"></script>
<script type="text/javascript" src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/js/verydows.mobile.js"></script>
<script type="text/javascript">
$(function(){
  showFalls();
  
  $('#catenav li').click(function(){
    if($(this).hasClass('cur')) return;
    $(this).addClass('cur').siblings('.cur').removeClass('cur');
    $('#artli').empty();
    showFalls();
  });
  
  $.vdsTouchScroll({
    onBottom: function(){
      var container = $('#artli');
      if(container.data('cur') != container.data('next')){
        showFalls();
      }else{
        if(!container.find('.nomore').length) container.append('<div class="nomore mt8 center">—— 没有更多内容了 ——</div>');
      }
    },
  });
});

function showFalls(){
  var container = $('#artli'), cate_id = $('#catenav li.cur').data('cate') || 0, page_id = container.data('next');
  $.asynList("<?php echo url(array('c'=>'api/article', 'a'=>'list', ));?>", {cate:cate_id, page:page_id, pernum:10}, function(res){
    if(res.status == 'success'){
      juicer.register('transtime', function(v){return transtime(v, 'y年m月d日')});
      container.append(juicer($('#row-tpl').html(), res));
      if(res.paging){
        container.data('cur', page_id);
        container.data('next', res.paging.next_page);
      }
    }else{
      container.append($('#nodata-tpl').html());
    }
  });
}
</script>
</head>
<body>
<div class="wrapper" id="wrapper">
  <!-- header start -->
  <div class="header">
    <div class="op lt"><a href="<?php echo url(array('c'=>'mobile/main', 'a'=>'index', ));?>"><i class="f20 iconfont">&#xe602;</i></a></div>
    <h1>资 讯</h1>
  </div>
  <?php if (!empty($cate_list)) : ?>
  <ul class="catenav mb10 cut" id="catenav">
    <li class="cur" data-cate="0"><a>全部</a></li>
    <?php $_foreach_v_counter = 0; $_foreach_v_total = count($cate_list);?><?php foreach( $cate_list as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
    <li data-cate="<?php echo htmlspecialchars($v['cate_id'], ENT_QUOTES, "UTF-8"); ?>"><a><?php echo htmlspecialchars($v['cate_name'], ENT_QUOTES, "UTF-8"); ?></a></li>
    <?php endforeach; ?>
  </ul>
  <?php endif; ?>
  <!-- header end -->
  <div class="artli cut" id="artli" data-cur='1' data-next='1'></div>
</div>
<script type="text/template" id="row-tpl">
{@each list as v}
<dl>
  <dt><a href="<?php echo url(array('c'=>'mobile/article', 'a'=>'view', 'id'=>'${v.id}', ));?>">${v.title}</a></dt>
  {@if v.picture != ''}
  <dd><a href="<?php echo url(array('c'=>'mobile/article', 'a'=>'view', 'id'=>'${v.id}', ));?>"><img src="${v.picture}" /></a></dd>
  {@/if}
  {@if v.brief != ''}
  <dd class="bf">${v.brief}</dd>
  {@/if}
  <dd class="bm">
    <span><i class="iconfont">&#xe63f;</i><font>${v.created_date|transtime, 'y-m-d'}</font></span>
    <a href="<?php echo url(array('c'=>'mobile/article', 'a'=>'view', 'id'=>'${v.id}', ));?>"><i class="iconfont">&#xe66e;</i><font>查看全文</font></a>
  </dd>
</dl>
{@/each}
</script>
<script type="text/template" id="nodata-tpl">
<div class="nodata"><div class="th"><span><i class="iconfont">&#xe61e;</i></span><div class="line"></div></div><p class="mt8">暂无相关内容</p></div>
</script>
<script type="text/javascript" src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/public/script/juicer.js"></script>
<script type="text/javascript" src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/public/script/formatdate.js"></script>
<?php include $_view_obj->compile('mobile/default/lib/footer.html'); ?>
</body>
</html>