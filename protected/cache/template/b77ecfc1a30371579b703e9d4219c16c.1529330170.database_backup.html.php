<?php if(!class_exists("View", false)) exit("no direct access allowed");?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include $_view_obj->compile('backend/lib/meta.html'); ?>
<link rel="stylesheet" type="text/css" href="public/theme/backend/css/verydows.css" />
<link rel="stylesheet" type="text/css" href="public/theme/backend/css/main.css" />
<link rel="stylesheet" type="text/css" href="public/theme/backend/css/database.css" />
<script type="text/javascript" src="public/script/jquery.js"></script>
<script type="text/javascript" src="public/theme/backend/js/verydows.js"></script>
<script type="text/javascript">
$(function(){
  $('#select-type label').click(function(){
    if($(this).find('input').val() == 'custom'){
      $('#table-list').slideDown();
    }else{
      $('#table-list').slideUp();
    }
  });
});

function backup(){
  var type = $('#select-type input[type="radio"]:checked').val(), tables = [];
  if(type == 'custom'){
    var selected = $('#table-selected input[type="checkbox"]:checked');
    if(selected.size() > 0){
      selected.each(function(){
        tables.push($(this).val());
      });
    }
    else{
      $('body').vdsAlert({msg:"请选择您需要备份的数据表"});
      return false;
    }
  }

  $.ajax({
    type: 'post',
    dataType: 'json',
    url: "<?php echo url(array('m'=>$MOD, 'c'=>'database', 'a'=>'backup', 'step'=>'export', ));?>",
    data: {'tables':tables},
    beforeSend: function(){$.vdsMasker(true);$('#waiting').vdsMidst({gotop: -200}).show();},
    success: function(res){
      $.vdsMasker(false);
      $('#waiting').hide();
      if(res.status == 'success'){
        $('#prompt').find('h3').addClass('green').text('备份完成！导出数据成功!');
      }else{
        $('#prompt').find('h3').addClass('red').text(res.msg);
      }
      $('#backup').empty().append($('#prompt').html());
    },
    error: function(){ $.vdsMasker(false);$('#waiting').hide();$('body').vdsAlert({msg:"处理请求时发生错误"});
    }
  });
}
</script>
</head>
<body>
<div class="content">
  <div class="loc"><h2><i class="icon"></i>数据库备份</h2></div>
  <div class="box">
    <div class="doacts">
      <a class="sbtn sm btn disabled"><font>备份</font></a>
      <a class="sbtn sm btn" href="<?php echo url(array('m'=>$MOD, 'c'=>'database', 'a'=>'restore', ));?>"><font>恢复</font></a>
      <a class="sbtn sm btn" href="<?php echo url(array('m'=>$MOD, 'c'=>'database', 'a'=>'optimize', ));?>"><font>优化</font></a>
    </div>
    <div class="module mt5 cut" id="backup">
      <div class="bw-row pad10 cut">
        <dl class="ml5 pad5" id="select-type">
          <dt><h3 class="c888">选择备份类型:</h3></dt>
          <dd class="mt15">
            <label><input name="type" type="radio" value="all" checked="checked" /><font class="ml10 c666">全部备份</font></label>
            <font class="ml20 caaa vtcmid">对系统所有数据库表进行备份</font>
          </dd>
          <dd class="mt10">
            <label><input name="type" type="radio" value="custom" /><font class="ml10 c666">自定义备份</font></label>
            <font class="ml20 caaa vtcmid">根据自己需求选择数据库表进行备份</font>
          </dd>
        </dl>
      </div>
      <div class="bw-row tbsel mt5 hide cut" id="table-list">
        <h3><h3 class="c888">选择需备份的数据表:</h3></h3>
        <div class="ckrow mt10 cut">
          <ul class="per25 tbcolor" id="table-selected">
            <?php $_foreach_v_counter = 0; $_foreach_v_total = count($table_list);?><?php foreach( $table_list as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
            <li><label><input type="checkbox" value="<?php echo htmlspecialchars($v, ENT_QUOTES, "UTF-8"); ?>" /><font class="ml5"><?php echo htmlspecialchars($v, ENT_QUOTES, "UTF-8"); ?></font></label></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
      <div class="bw-row mt5 pad10 ta-c"><button type="button" class="cbtn btn" onclick="backup()">开始备份</button></div>
    </div>
  </div>
</div>
<!-- waiting start -->
<div class="waiting ta-c cut hide" id="waiting">
  <h3 class="c666 f14">正在备份...</h3>
  <div class="loading"></div>
</div>
<!-- waiting end -->
<!-- rs start -->
<div id="prompt" class="hide">
  <div class="bw-row pad10 ta-c"><h3 class="f14 pad10"></h3></div>
</div>
<!-- rs start -->
</body>
</html>