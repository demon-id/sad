<div class="box category">
  <div class="box-heading"><?php echo $heading_title; ?></div>
  <div class="box-content">
<ul id="nav-one" class="dropmenu">
  <?php foreach ($categories as $category) { ?>
        <?php if ($category['children']) { ?>
			<li class="top_level dropdown"><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>

			<div class="dropdown-menu megamenu column<?php echo $category['column']; ?>">
            <div class="dropdown-inner">
              <?php foreach (array_chunk($category['children'], ceil(count($category['children']) / $category['column'])) as $children) { ?>
				<ul class="list-unstyled childs_1">
                <?php foreach ($children as $child) { ?>
					<!-- 2 Level Sub Categories START -->
					<?php if ($child['childs']) { ?>
					  <li class="dropdown"><a href="<?php echo $child['href']; ?>"><?php echo $child['name']; ?></a>

						  <div class="dropdown-menu">
			              <div class="dropdown-inner">
			              <?php foreach (array_chunk($child['childs'], ceil(count($child['childs']) / $child['column'])) as $childs_col) { ?>
							<ul class="list-unstyled childs_2">
							  <?php foreach ($childs_col as $childs_2) { ?>
								<li><a href="<?php echo $childs_2['href']; ?>"><?php echo $childs_2['name']; ?></a></li>
							  <?php } ?>
							</ul>
						  <?php } ?>
						  </div>
						  </div>

					  </li>
					<?php } else { ?>
					  <li><a href="<?php echo $child['href']; ?>"><?php echo $child['name']; ?></a></li>
					<?php } ?>
					<!-- 2 Level Sub Categories END -->
                <?php } ?>
              
			    </ul>
              <?php } ?>
            </div>
			</div>

			</li>
        <?php } else { ?>
			<li class="top_level"><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>
        <?php } ?>
        <?php } ?>
		<?php if(isset($blog_enable)){   ?>
       	<li> <a href="<?php echo $all_blogs; ?>"><?php echo $text_blog; ?></a></li>       
<?php  } ?>
 </ul>
  </div>
</div>




