<h3><?php echo $heading_title; ?></h3>
<div class="row product-layout">
  <div class="og-container">
    <?php foreach ($videos as $video) { ?>

    <div class="<?php echo $apr; ?> col-xs-12 og-vd-md" style="height:<?php echo $m_height; ?>px;">
      <div class="og-vd-md-<?php echo $vs; ?>">
        <a href="<?php echo $video['href']; ?>">
          <img src="<?php echo $video['thumb'] ?>" title="<?php echo $video['name'] ?>" alt="<?php echo $video['name'] ?>"/>
          <div class="play-button play-button-1" style="top:<?php echo $play_btn_top; ?>px; left:<?php echo $play_btn_left; ?>px;"></div>
        </a>
      </div>
      <p><a href="<?php echo $video['href']; ?>" style="font-family: <?php echo $title_font; ?> ; font-size: <?php echo $title_size; ?>px; <?php if($og_title_font_weight) { echo 'font-weight: bold;'; } ?> "><?php echo $video['name'] ?></a>
      </p>
    </div>
    
    <?php } ?>
  </div>
</div>

