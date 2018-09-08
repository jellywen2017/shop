<?php if(!class_exists("View", false)) exit("no direct access allowed");?><tr>
  <th>配置参数</th>
  <td><input type="hidden" name="pcode" value="alipay" />
    <table class="dataform">
      <tr>
        <th width="70">APP ID</th>
        <td><input title="APP ID" class="w300 txt" name="params[app_id]" id="app_id" type="text" value="<?php echo htmlspecialchars($rs['params']['app_id'], ENT_QUOTES, "UTF-8"); ?>" /></td>
      </tr>
      <tr>
        <th>APP KEY</th>
        <td><input title="APP KEY" class="w300 txt" name="params[app_key]" id="app_key" type="text" value="<?php echo htmlspecialchars($rs['params']['app_key'], ENT_QUOTES, "UTF-8"); ?>" /></td>
      </tr>
    </table>
  </td>
</tr>