    <footer>
        <div class="container">
            <div class="main-menu-top">
                <div id="menu" class="main-menu">
                    <div class="nav-responsive"><span>Menu</span><div class="expandable"></div></div>
                    <ul class="cms-menu">
                        <li class="head-links"> <a href="<?php echo $home; ?>"><?php echo $text_home; ?></a></li>
                        <li class="level0"><a href="<?php echo $delivery; ?>"><?php echo $text_delivery; ?></a></li>
                        <li class="level0"><a href="<?php echo $articles; ?>"><?php echo $text_articles; ?></a></li>
                        <li class="level0"><a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a></li>
                        <li class="level0 text-right"><span class="pull-right">Питомник "Слобода Сад". <?php
                         echo '2017';
                         if(date('Y')>2016) {
                            echo '-'.date('Y');
                            }
                         ?>
                            </span></li>
                    </ul>
                </div>
        </div>
    </footer>
</body>
</html>