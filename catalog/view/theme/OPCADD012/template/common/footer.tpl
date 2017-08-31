    <footer>
        <!-- Opencart 3 level Category Menu-->
        <div class="container">
            <div class="main-menu-top">


                <div id="menu" class="main-menu">

                    <div class="nav-responsive"><span>Menu</span><div class="expandable"></div></div>
                    <ul class="cms-menu">
                        <li class="head-links"> <a href="<?php echo $home; ?>"><?php echo $text_home; ?></a></li>
                        <li class="level0"><a href="<?php echo $delivery; ?>"><?php echo $text_delivery; ?></a></li>
                        <li class="level0"><a href="<?php echo $articles; ?>"><?php echo $text_articles; ?></a></li>
                        <li class="level0"><a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a></li>
                    </ul>

                    <ul class="main-navigation top-menu">
                        <?php foreach ($categories as $category) { ?>
                        <li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>
                            <?php if ($category['children']) { ?>

                            <?php for ($i = 0; $i < count($category['children']);) { ?>
                            <ul class="drop-downmenu">
                                <?php $j = $i + ceil(count($category['children']) / $category['column']); ?>
                                <?php for (; $i < count($category['children']); $i++) { ?>
                                <?php if (isset($category['children'][$i])) { ?>
                                <li>
                                    <?php if(count($category['children'][$i]['children_level2'])>0){ ?>
                                    <a href="<?php echo $category['children'][$i]['href']; ?>" class="activSub" ><?php echo $category['children'][$i]['name'];?></a>
                                    <?php } else { ?>
                                    <a href="<?php echo $category['children'][$i]['href']; ?>" ><?php echo $category['children'][$i]['name']; ?></a>
                                    <?php } ?>
                                    <?php if ($category['children'][$i]['children_level2']) { ?>
                                    <ul class="col<?php echo $j; ?>">
                                        <?php for ($wi = 0; $wi < count($category['children'][$i]['children_level2']); $wi++) { ?>
                                        <li><a href="<?php echo $category['children'][$i]['children_level2'][$wi]['href']; ?>"  ><?php echo $category['children'][$i]['children_level2'][$wi]['name']; ?></a></li>
                                        <?php } ?>
                                    </ul>
                                    <?php } ?>
                                </li>
                                <?php } ?>
                                <?php } ?>
                            </ul>
                            <?php } ?>
                            <?php } ?>
                        </li>
                        <?php } ?>

                        <li ><a href="<?php echo $affiliate; ?>"><?php echo $text_affiliate; ?></a></li>
                        <li ><a href="<?php echo $voucher; ?>"><?php echo $text_voucher; ?></a></li>
                        <li ><a href="<?php echo $manufacturer; ?>"><?php echo $text_manufacturer; ?></a></li>
                        <li ><a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a></li>
                        <li ><a href="<?php echo $special; ?>"><?php echo $text_special; ?></a></li>

                    </ul>
                </div>
        </div>
        <!-- ======= Menu Code END ========= -->
    </footer>
</body>
</html>