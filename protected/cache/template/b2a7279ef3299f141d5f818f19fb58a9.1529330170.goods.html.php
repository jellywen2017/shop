<?php if(!class_exists("View", false)) exit("no direct access allowed");?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include $_view_obj->compile('backend/lib/meta.html'); ?>
<link rel="stylesheet" type="text/css" href="public/theme/backend/css/verydows.css" />
<link rel="stylesheet" type="text/css" href="public/theme/backend/css/main.css" />
<link rel="stylesheet" type="text/css" href="public/theme/backend/css/goods.css" />
<link rel="stylesheet" type="text/css" href="public/theme/backend/umeditor/themes/default/css/umeditor.min.css" />
<link rel="stylesheet" type="text/css" href="public/theme/backend/webupload/webuploader.css" />
<script type="text/javascript" src="public/script/jquery.js"></script>
<script type="text/javascript" src="public/theme/backend/js/verydows.js"></script>
<script type="text/javascript" src="public/theme/backend/js/goods.js"></script>
<script type="text/javascript">
$(function(){
  $('#tabs').vdsTabsSwitch();
  UM.getEditor('goods_brief', {
    textarea:'goods_brief', toolbar:['source | fontfamily fontsize forecolor bold link unlink | removeformat']
  });
  UM.getEditor('goods_content', {textarea:'goods_content', imageUrl: "<?php echo url(array('m'=>$MOD, 'c'=>'goods', 'a'=>'image', 'step'=>'editor', ));?>", initialFrameWidth: '98%'});
  $('#gim').find('a i').on('click', function(){
    $('#gim').hide().find('img').attr('src', '');
    $('#gimbtns').show();
    $('#gim input[name="goods_image"]').val('');
  });
  $('#album').find('a i').on('click', function(){
    $(this).parent().remove();
    if($('#album').find('a').size() == 0) $('#album').hide();
  });
});

function submitForm(){
  $('#goods_name').vdsFieldChecker({rules: {required:[true, '请输入商品名称'], maxlen:[180, '商品名称不能超过180个字符']}});
  $('#goods_sn').vdsFieldChecker({rules: {maxlen:[20, '商品货号不能超过20个字符']}});
  $('#now_price').vdsFieldChecker({rules: {required:[true, '请输入当前售价'], decimal:[true, '当前售价不符合格式要求']}});
  $('#original_price').vdsFieldChecker({rules: {decimal:[true, '原售价不符合格式要求']}});
  $('#goods_weight').vdsFieldChecker({rules: {decimal:[true, '重量不符合格式要求']}});
  $('#goods-form').vdsFormChecker();
}
</script>
</head>
<body>
<?php if ($_GET['a'] == 'add') : ?>
<div class="content">
  <div class="loc"><h2><i class="icon"></i>添加新商品</h2></div>
  <form method="post" enctype="multipart/form-data" action="<?php echo url(array('m'=>$MOD, 'c'=>'goods', 'a'=>'add', 'step'=>'submit', ));?>" id="goods-form">
    <div class="box">
      <div class="tabs mt5">
        <ul id="tabs">
          <li class="cur">基本信息</li>
          <li>商品图片</li>
          <li>商品详情</li>
          <li>购买选项</li>
          <li>其他信息</li>
        </ul>
      </div>
      <!-- 基本信息开始 -->
      <div class="module swcon mt5">
        <table class="dataform">
          <tr>
            <th width="110">商品名称</th>
            <td><input class="w400 txt" name="goods_name" id="goods_name" type="text" /></td>
          </tr>
          <tr>
            <th>商品分类</th>
            <td>
              <select id="cate_id" name="cate_id" class="slt">
                <option value="0">无分类</option>
                <option disabled="disabled">------------------------------</option>
                <?php if (!empty($cate_list)) : ?>
                <?php $_foreach_v_counter = 0; $_foreach_v_total = count($cate_list);?><?php foreach( $cate_list as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
                <option value="<?php echo htmlspecialchars($v['cate_id'], ENT_QUOTES, "UTF-8"); ?>"><?php echo str_repeat('|— ',$v['lv']);?> <?php echo htmlspecialchars($v['cate_name'], ENT_QUOTES, "UTF-8"); ?></option>
                <?php endforeach; ?>
                <?php endif; ?>
              </select>
            </td>
          </tr>
          <tr>
            <th>所属品牌</th>
            <td>
              <select id="brand_id" name="brand_id" class="slt">
                <option value="0">无品牌</option>
                <?php if (!empty($brand_list)) : ?>
                <option disabled="disabled">------------------------------</option>
                <?php $_foreach_v_counter = 0; $_foreach_v_total = count($brand_list);?><?php foreach( $brand_list as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
                <option value="<?php echo htmlspecialchars($v['brand_id'], ENT_QUOTES, "UTF-8"); ?>"><?php echo htmlspecialchars($v['brand_name'], ENT_QUOTES, "UTF-8"); ?></option>
                <?php endforeach; ?>
                <?php endif; ?>
              </select>
            </td>
          </tr>
          <tr>
            <th>商品货号</th>
            <td><input class="w200 txt" name="goods_sn" type="text" /><p class="c999 mt10">长度不应超过20个字符, 留空则系统会按约定规则自动生成货号</p></td>
          </tr>
          <tr>
            <th>当前售价</th>
            <td><input class="w200 txt" name="now_price" id="now_price" type="text" /><p class="c999 mt10">售价请按此格式填写, 如: "188.00" 或 "8.00"</p></td>
          </tr>
          <tr>
            <th>原售价</th>
            <td>
              <input class="w200 txt" name="original_price" id="original_price" type="text" />
              <p class="c999 mt10">留空或为0时，前台不显示原售价</p>
            </td>
          </tr>
          <tr>
            <th>商品简介</th>
            <td><script type="text/plain" id="goods_brief" style="width:100%;height:100px;"></script></td>
          </tr>
          <tr>
            <th>标记</th>
            <td>
              <div class="pad5">
                <label><input name="newarrival" type="checkbox" value="1" /><font class="c666 ml5">新品</font></label>
                <label class="ml20"><input name="recommend" type="checkbox" value="1" /><font class="c666 ml5">推荐</font></label>
                <label class="ml20"><input name="bargain" type="checkbox" value="1" /><font class="c666 ml5">特价</font></label>
              </div>
            </td>
          </tr>
          <tr>
            <th>状态</th>
            <td>
              <div class="pad5">
                <label><input type="radio" name="status" value="1" checked="checked" /><font class="green ml5">上架</font></label>
                <label class="ml20"><input type="radio" name="status" value="0" /><font class="red ml5">下架</font></label>
                <p class="c999 mt10">如状态选择下架，前台则不会显示该商品</p>
              </div>
            </td>
          </tr>
        </table>
      </div>
      <!-- 基本信息结束 -->
      <!-- 商品图片开始 -->
      <div class="module swcon mt5 hide">
        <table class="dataform">
          <tr>
            <th width="110">主要图片</th>
            <td>
              <div class="gim pad5 unslt cut hide" id="gim"><a><img src="" /><i>×</i></a><input type="hidden" name="goods_image" value="" /></div>
              <div class="pad5 cut" id="gimbtns">
                <a class="dashedbtn" onclick="popUploadImg()">+上传新图片</a>
                <span class="sep20"></span>
                <a class="dashedbtn" onclick="popImgList('prime')">选择图库中已有图片</a>
              </div>
            </td>
          </tr>
          <tr>
            <th>相册图片</th>
            <td>
              <div class="gim pad5 unslt cut hide" id="album"></div>
              <div class="pad5 cut">
                <a class="dashedbtn" onclick="popUploadAlbum()">+上传新图片</a>
                <span class="sep20"></span>
                <a class="dashedbtn" onclick="popImgList('album')">选择图库中已有图片</a>
              </div>
            </td>
          </tr>
        </table>
      </div>
      <!-- 商品图片结束 -->
      <!-- 规格属性开始 -->
      <div class="module swcon mt5 hide"><script type="text/plain" id="goods_content" style="height:300px;"></script></div>
      <!-- 商品详细结束 -->
      <!-- 商品选项开始 -->
      <div class="module swcon mt5 hide">
        <table class="dataform">
          <tr>
            <th width="90">选项类型</th>
            <td>
              <select class="slt" id="opt-type">
                <option value="0">选择选项类型</option>
                <?php if (!empty($opt_type_list)) : ?>
                <option disabled="disabled">------------------------------</option>
                <?php $_foreach_v_counter = 0; $_foreach_v_total = count($opt_type_list);?><?php foreach( $opt_type_list as $k => $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
                <option value="<?php echo htmlspecialchars($k, ENT_QUOTES, "UTF-8"); ?>"><?php echo htmlspecialchars($v, ENT_QUOTES, "UTF-8"); ?></option>
                <?php endforeach; ?>
                <?php endif; ?>
              </select>
              <button type="button" class="cbtn btn" onclick="selectedOptType(this)">确定</button>
              <a class="blue ml10" href="<?php echo url(array('m'=>$MOD, 'c'=>'goods_optional_type', 'a'=>'add', ));?>">新增选项类型</a>
            </td>
          </tr>
          <tr>
            <td colspan="2" id="opt-container"></td>
          </tr>
        </table>
      </div>
      <!-- 商品选项结束 -->
      <!-- 其他信息开始 -->
      <div class="module swcon mt5 hide">
        <table class="dataform">
          <tr>
            <th width="110">库存数量</th>
            <td><input value="9999" class="w100 txt" name="stock_qty" id="stock_qty" type="text" /></td>
          </tr>
          <tr>
            <th>重量</th>
            <td><input class="w100 txt" name="goods_weight" id="goods_weight" value="0.00" type="text" /><font class="c999 ml5">Kg (千克)</font></td>
          </tr>
          <tr>
            <th>Meta 关键词</th>
            <td>
              <textarea class="txtarea" name="meta_keywords" cols="80" rows="4"></textarea>
              <p class="caaa mt10">多个关键词请用半角逗号","隔开，此项会加入到前端商品搜索中匹配</p>
            </td>
          </tr>
          <tr>
            <th>Meta 描述</th>
            <td><textarea class="txtarea" name="meta_description" cols="80" rows="4"></textarea></td>
          </tr>
        </table>
      </div>
      <!-- 其他信息结束 -->
      <div class="submitbtn">
        <button type="button" class="ubtn btn" onclick="submitForm()">保存并提交</button>
        <button type="reset" class="fbtn btn">重置表单</button>
      </div>
    </div>
  </form>
</div>
<?php else : ?>
<div class="content">
  <div class="loc"><h2><i class="icon"></i>编辑商品:<font class="ml5">[<?php echo htmlspecialchars($rs['goods_id'], ENT_QUOTES, "UTF-8"); ?>]</font></h2></div>
  <form method="post" enctype="multipart/form-data" action="<?php echo url(array('m'=>$MOD, 'c'=>'goods', 'a'=>'edit', 'step'=>'update', 'id'=>$rs['goods_id'], ));?>" id="goods-form">
    <div class="box">
      <div class="tabs mt5">
        <ul id="tabs">
          <li class="cur">基本信息</li>
          <li>商品图片</li>
          <li>商品详情</li>
          <li>购买选项</li>
          <li>其他信息</li>
        </ul>
      </div>
      <!-- 基本信息开始 -->
      <div class="module swcon mt10">
        <table class="dataform">
          <tr>
            <th width="110">商品名称</th>
            <td><input class="w400 txt" name="goods_name" id="goods_name" type="text" value="<?php echo htmlspecialchars($rs['goods_name'], ENT_QUOTES, "UTF-8"); ?>" /></td>
          </tr>
          <tr>
            <th>商品分类</th>
            <td>
              <select id="cate_id" name="cate_id" class="slt">
                <option value="0">无分类</option>
                <?php if (!empty($cate_list)) : ?>
                <option disabled="disabled">------------------------------</option>
                <?php $_foreach_v_counter = 0; $_foreach_v_total = count($cate_list);?><?php foreach( $cate_list as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?> <?php if ($v['cate_id'] == $rs['cate_id']) : ?>
                <option selected="selected" value="<?php echo htmlspecialchars($v['cate_id'], ENT_QUOTES, "UTF-8"); ?>"><?php echo str_repeat('|— ',$v['lv']);?> <?php echo htmlspecialchars($v['cate_name'], ENT_QUOTES, "UTF-8"); ?></option>
                <?php else : ?>
                <option value="<?php echo htmlspecialchars($v['cate_id'], ENT_QUOTES, "UTF-8"); ?>"><?php echo str_repeat('|— ',$v['lv']);?> <?php echo htmlspecialchars($v['cate_name'], ENT_QUOTES, "UTF-8"); ?></option>
                <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>
              </select>
            </td>
          </tr>
          <tr>
            <th>所属品牌</th>
            <td>
              <select id="brand_id" name="brand_id" class="slt">
                <option value="0">无品牌</option>
                <?php if (!empty($brand_list)) : ?>
                <option disabled="disabled">------------------------------</option>
                <?php $_foreach_v_counter = 0; $_foreach_v_total = count($brand_list);?><?php foreach( $brand_list as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?> <?php if ($v['brand_id'] == $rs['brand_id']) : ?>
                <option selected="selected" value="<?php echo htmlspecialchars($v['brand_id'], ENT_QUOTES, "UTF-8"); ?>"><?php echo htmlspecialchars($v['brand_name'], ENT_QUOTES, "UTF-8"); ?></option>
                <?php else : ?>
                <option value="<?php echo htmlspecialchars($v['brand_id'], ENT_QUOTES, "UTF-8"); ?>"><?php echo htmlspecialchars($v['brand_name'], ENT_QUOTES, "UTF-8"); ?></option>
                <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>
              </select>
            </td>
          </tr>
          <tr>
            <th>商品货号</th>
            <td>
              <input class="w200 txt" name="goods_sn" type="text" value="<?php echo htmlspecialchars($rs['goods_sn'], ENT_QUOTES, "UTF-8"); ?>" />
              <p class="c999 mt10">长度不应超过20个字符, 留空则系统会自动生成货号</p>
            </td>
          </tr>
          <tr>
            <th>当前售价</th>
            <td>
              <input class="w200 txt" name="now_price" id="now_price" type="text" value="<?php echo htmlspecialchars($rs['now_price'], ENT_QUOTES, "UTF-8"); ?>" />
              <p class="c999 mt10">售价请按此格式填写, 如: "188.00" 或 "8.00"</p>
            </td>
          </tr>
          <tr>
            <th>原售价</th>
            <td>
              <input class="w200 txt" name="original_price" id="original_price" type="text" value="<?php echo htmlspecialchars($rs['original_price'], ENT_QUOTES, "UTF-8"); ?>" />
              <p class="c999 mt10">留空或为0时，前台不显示原售价</p>
            </td>
          </tr>
          <tr>
            <th>商品简介</th>
            <td><script type="text/plain" id="goods_brief" style="width:100%;height:100px;"><?php echo $rs['goods_brief']; ?></script></td>
          </tr>
          <tr>
            <th>标记</th>
            <td>
              <div class="pad5">
                <label><input name="newarrival" type="checkbox" value="1" <?php if ($rs['newarrival'] == 1) : ?>checked="checked"<?php endif; ?> /><font class="c666 ml5">新品</font></label>
                <label class="ml20"><input name="recommend" type="checkbox" value="1" <?php if ($rs['recommend'] == 1) : ?>checked="checked"<?php endif; ?> /><font class="c666 ml5">推荐</font></label>
                <label class="ml20"><input name="bargain" type="checkbox" value="1" <?php if ($rs['bargain'] == 1) : ?>checked="checked"<?php endif; ?> /><font class="c666 ml5">特价</font></label>
              </div>
            </td>
          </tr>
          <tr>
            <th>状态</th>
            <td>
              <p> 
                <?php if ($rs['status'] == 1) : ?>
                <label class="mr10"><input type="radio" name="status" value="1" checked="checked" /><font class="green ml5">上架</font></label>
                <label><input type="radio" name="status" value="0" /><font class="red ml5">下架</font></label>
                <?php else : ?>
                <label class="mr10"><input type="radio" name="status" value="1" /><font class="green ml5">上架</font></label>
                <label><input type="radio" name="status" value="0" checked="checked" /><font class="red ml5">下架</font></label>
                <?php endif; ?>
              </p>
              <p class="c999 mt10">如状态选择下架，前台则不会显示该商品</p></td>
          </tr>
          <tr>
            <th>创建时间</th>
            <td><p class="pad5 c888"><?php echo date('Y-m-d h:i:s', $rs['created_date']);?></p></td>
          </tr>
        </table>
      </div>
      <!-- 基本信息结束 -->
      <!-- 商品图片开始 -->
      <div class="module swcon mt10 hide">
        <table class="dataform">
          <tr>
            <th width="110">主要图片</th>
            <td>
              <?php if (!empty($rs['goods_image'])) : ?>
              <div class="gim pad5 unslt cut" id="gim"><a><img src="upload/goods/prime/0/<?php echo htmlspecialchars($rs['goods_image'], ENT_QUOTES, "UTF-8"); ?>" /><i>×</i></a><input type="hidden" name="goods_image" value="<?php echo htmlspecialchars($rs['goods_image'], ENT_QUOTES, "UTF-8"); ?>" /></div>
              <div class="pad5 cut hide" id="gimbtns">
                <a class="dashedbtn" onclick="popUploadImg()">+上传新图片</a>
                <span class="sep20"></span>
                <a class="dashedbtn" onclick="popImgList('prime')">选择图库中已有图片</a>
              </div>
              <?php else : ?>
              <div class="gim pad5 unslt cut hide" id="gim"><a><img src="" /><i>×</i></a><input type="hidden" name="goods_image" value="" /></div>
              <div class="pad5 cut" id="gimbtns">
                <a class="dashedbtn" onclick="popUploadImg()">+上传新图片</a>
                <span class="sep20"></span>
                <a class="dashedbtn" onclick="popImgList('prime')">选择图库中已有图片</a>
              </div>
              <?php endif; ?>
            </td>
          </tr>
          <tr>
            <th>相册图片</th>
            <td>
              <?php if (!empty($album_list)) : ?>
              <div class="gim pad5 unslt cut" id="album">
                <?php $_foreach_v_counter = 0; $_foreach_v_total = count($album_list);?><?php foreach( $album_list as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
                <a><img src="upload/goods/album/0/<?php echo htmlspecialchars($v['image'], ENT_QUOTES, "UTF-8"); ?>" /><i>×</i><input type="hidden" name="album[]" value="<?php echo htmlspecialchars($v['image'], ENT_QUOTES, "UTF-8"); ?>" /></a>
                <?php endforeach; ?>
              </div>
              <?php else : ?>
              <div class="gim pad5 unslt cut hide" id="album"></div>
              <?php endif; ?>
              <div class="pad5 cut">
                <a class="dashedbtn" onclick="popUploadAlbum()">+上传新图片</a>
                <span class="sep20"></span>
                <a class="dashedbtn" onclick="popImgList('album')">选择图库中已有图片</a>
              </div>
            </td>
          </tr>
        </table>
      </div>
      <!-- 商品图片结束 -->
      <!-- 规格属性开始 -->
      <div class="module swcon mt10 hide"><script type="text/plain" id="goods_content" style="height:300px;"><?php echo $rs['goods_content']; ?></script></div>
      <!-- 商品详细结束 -->
      <!-- 商品选项开始 -->
      <div class="module swcon mt10 hide">
        <table class="dataform">
          <tr>
            <th width="90">选项类型</th>
            <td>
              <select class="slt" id="opt-type">
                <option value="0">选择选项类型</option>
                <?php if (!empty($opt_type_list)) : ?>
                <option disabled="disabled">------------------------------</option>
                <?php $_foreach_v_counter = 0; $_foreach_v_total = count($opt_type_list);?><?php foreach( $opt_type_list as $k => $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
                <option value="<?php echo htmlspecialchars($k, ENT_QUOTES, "UTF-8"); ?>"><?php echo htmlspecialchars($v, ENT_QUOTES, "UTF-8"); ?></option>
                <?php endforeach; ?>
                <?php endif; ?>
              </select>
              <button type="button" class="cbtn btn" onclick="selectedOptType(this)">确定</button>
              <a class="blue ml10" href="<?php echo url(array('m'=>$MOD, 'c'=>'goods_optional_type', 'a'=>'add', ));?>">新增选项类型</a>
            </td>
          </tr>
          <tr>
            <td colspan="2" id="opt-container">
              <?php if (!empty($opt_list)) : ?>
              <?php $_foreach_v_counter = 0; $_foreach_v_total = count($opt_list);?><?php foreach( $opt_list as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
              <dl class="optlsdl">
                <dt>
                  <font class="c888 mr10" data-id="<?php echo htmlspecialchars($v['type_id'], ENT_QUOTES, "UTF-8"); ?>"><?php echo htmlspecialchars($v['type_name'], ENT_QUOTES, "UTF-8"); ?></font>
                  <button type="button" class="add mbtn btn mr5" onclick="addOptVal(this)">+1 可选值</button>
                  <button type="button" class="del mbtn btn" onclick="removeOpt(this)">删除</button>
                  <p class="mt10 c999">左边输入选项内容, 右边输入增加价格(留空则价格不变)</p>
                </dt>
                <?php $_foreach_vv_counter = 0; $_foreach_vv_total = count($v['children']);?><?php foreach( $v['children'] as $vv ) : ?><?php $_foreach_vv_index = $_foreach_vv_counter;$_foreach_vv_iteration = $_foreach_vv_counter + 1;$_foreach_vv_first = ($_foreach_vv_counter == 0);$_foreach_vv_last = ($_foreach_vv_counter == $_foreach_vv_total - 1);$_foreach_vv_counter++;?>
                <dd>
                  <a class="f14 blue mr5" title="移除" onclick="removeOptVal(this)">[-]</a>
                  <input class="w150 txt" name="goods_opts[text][]" type="text" value="<?php echo htmlspecialchars($vv['opt_text'], ENT_QUOTES, "UTF-8"); ?>" />
                  <input class="w100 txt" name="goods_opts[price][]" type="text" value="<?php echo htmlspecialchars($vv['opt_price'], ENT_QUOTES, "UTF-8"); ?>" />
                  <input type="hidden" name="goods_opts[type][]" value="<?php echo htmlspecialchars($v['type_id'], ENT_QUOTES, "UTF-8"); ?>" />
                </dd>
                <?php endforeach; ?>
              </dl>
              <?php endforeach; ?>
              <?php endif; ?>
            </td>
          </tr>
        </table>
      </div>
      <!-- 商品选项结束 -->
      <!-- 其他信息开始 -->
      <div class="module swcon mt10 hide">
        <table class="dataform">
          <tr>
            <th width="110">库存数量</th>
            <td><input title="库存数量" class="w100 txt" name="stock_qty" id="stock_qty" type="text" value="<?php echo htmlspecialchars($rs['stock_qty'], ENT_QUOTES, "UTF-8"); ?>" /></td>
          </tr>
          <tr>
            <th>重量</th>
            <td><input title="重量" class="w100 txt" name="goods_weight" id="goods_weight" type="text" value="<?php echo htmlspecialchars($rs['goods_weight'], ENT_QUOTES, "UTF-8"); ?>" /><font class="c999 ml5">Kg (千克)</font></td>
          </tr>
          <tr>
            <th>Meta 关键词</th>
            <td>
              <textarea class="txtarea" name="meta_keywords" cols="80" rows="4"><?php echo htmlspecialchars($rs['meta_keywords'], ENT_QUOTES, "UTF-8"); ?></textarea>
              <p class="caaa mt10">多个关键词请用半角逗号","隔开，此项会加入到前端商品搜索中匹配</p>
            </td>
          </tr>
          <tr>
            <th>Meta 描述</th>
            <td><textarea class="txtarea" name="meta_description" cols="80" rows="4"><?php echo htmlspecialchars($rs['meta_description'], ENT_QUOTES, "UTF-8"); ?></textarea></td>
          </tr>
        </table>
      </div>
      <!-- 其他信息结束 -->
      <div class="submitbtn">
        <button type="button" class="ubtn btn" onclick="submitForm()">保存并更新</button>
        <button type="reset" class="fbtn btn">重置表单</button>
      </div>
    </div>
  </form>
</div>
<?php endif; ?>
<?php include $_view_obj->compile('backend/goods/goods_upload.html'); ?>
<script type="text/template" id="add-album-tpl">
<div class="mrimgtr">
  <a class="blue mr5" title="移除">[-]</a>
  <label><font class="c666 mr5">上传图片:</font><input name="goods_album[]" type="file" /></label>
</div> 
</script>
<script type="text/template" id="opt-tpl">
<dl class="optlsdl">
  <dt>
    <font class="c888 mr10" data-id="{{type_id}}">{{type_name}}</font>
    <button type="button" class="add mbtn btn mr5" onclick="addOptVal(this)">+1 可选值</button>
    <button type="button" class="del mbtn btn" onclick="removeOpt(this)">删除</button>
    <p class="mt10 c999">左边输入选项内容, 右边输入增加价格(留空则价格不变)</p>
  </dt>
  <dd>
    <a class="f14 blue mr5" title="移除" onclick="removeOptVal(this)">[-]</a>
    <input class="w150 txt" name="goods_opts[text][]" type="text" />
    <input class="w100 txt" name="goods_opts[price][]" type="text" />
    <input type="hidden" value="{{type_id}}" name="goods_opts[type][]" />
  </dd>
</dl>
</script>
<script type="text/template" id="opt-val-tpl">
<dd>
  <a class="f14 blue mr5" title="移除" onclick="removeOptVal(this)">[-]</a>
  <input class="w150 txt" name="goods_opts[text][]" type="text" />
  <input class="w100 txt" name="goods_opts[price][]" type="text" />
  <input type="hidden" value="{{type_id}}" name="goods_opts[type][]" />
</dd>
</script>
<script type="text/javascript" src="public/theme/backend/umeditor/umeditor.config.js"></script>
<script type="text/javascript" src="public/theme/backend/umeditor/umeditor.min.js"></script>
</body>
</html>