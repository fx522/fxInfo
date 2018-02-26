<div class="footer-divider"></div>
    <div class="container footer">
      <div class="row">
        <div class="col-md-10">
          <div class="row">
            <?php foreach ($nav_footer as $item): ?>
            <div class="col-md-<?=$footer_width?>">
              <ul>
              <li class="header"><?=$item['module_name']?></li>
              <?php foreach ($item['sub'] as $sub_item): ?>
                <li><a href="<?php echo base_url('webfront/page/'.$item['module_type'].'/'.$item['module_id'].'/'.$sub_item['column_id']) ?>"><?=$sub_item['column_name']?></a></li>
              <?php endforeach; ?>
              </ul>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
        <div class="col-md-2 qrcode">
          <div class="qrimg"><img src="<?php echo base_url('resource/images/base/qrcode.jpg') ?>"></div>
          <div class="qrtext">关注官方信息</div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 copyright">
            <?=$site_info['website_copyright']?>
        </div>
      </div>
    </div>
    <!-- FOOTER -->
    <script src="<?php echo base_url('resource/js/jquery-3.2.1.min.js') ?>"></script>
    <script src="<?php echo base_url('resource/fx_static/bootstrap/3.3.7/js/bootstrap.min.js') ?>"></script>
    <script src="<?php echo base_url('resource/fx_static/assets/js/ie10-viewport-bug-workaround.js') ?>"></script>
  </body>
</html>