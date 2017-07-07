<?php if ($list_type == 1) { ?>
	<?php $icon_0 = "folder-o"; ?>
	<?php $icon_1 = "folder-open-o"; ?>
<?php } else { ?>
	<?php $icon_0 = "sticky-note-o"; ?>
	<?php $icon_1 = "sticky-note-o"; ?>
<?php } ?>

<h3><?php echo $heading_title; ?></h3>
<div class="list-group cat-articles">
        <?php foreach ($articles as $article) { ?>
          <?php if ($article['article_id'] == $article_id) { ?>
          <a href="<?php echo $article['href']; ?>" class="list-group-item active"><i class="fa fa-<?php echo $icon_1; ?>"></i> <?php echo $article['name']; ?></a>
          <?php if ($article['children']) { ?>
            <?php foreach ($article['children'] as $child) { ?>
              <?php if ($child['article_id'] == $child_id) { ?>
              <a href="<?php echo $child['href']; ?>" class="list-group-item active child">&nbsp;&nbsp;&nbsp;<i class="fa fa-<?php echo $icon_1; ?>"></i> <?php echo $child['name']; ?></a>
              <?php } else { ?>
              <a href="<?php echo $child['href']; ?>" class="list-group-item child">&nbsp;&nbsp;&nbsp;<i class="fa fa-<?php echo $icon_0; ?>"></i> <?php echo $child['name']; ?></a>
              <?php } ?>
            <?php } ?>
          <?php } ?>
<?php } else { ?>
<a href="<?php echo $article['href']; ?>" class="list-group-item"><i class="fa fa-<?php echo $icon_0; ?>"></i> <?php echo $article['name']; ?></a>
  <?php } ?>
  <?php } ?>
</div>
	<?php if ($list_type == 2) { ?>
	<?php $count = count($articles); ?>
	<?php if ($count >= 20) { ?>
            <div class="all-articles"><a href="<?php echo $articles_link; ?>"><i class="fa fa-bars"></i> <?php echo $text_all_articles; ?></a></div>
	<?php } ?>
	<?php } ?>
