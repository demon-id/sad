    <footer>
        <div class="container">
            <div class="main-menu-top">
                <div class="main-menu">
                    <ul class="cms-menu">
                        <li class="head-links"> <a href="<?php echo $home; ?>"><?php echo $text_home; ?></a></li>
                        <li class="level0"><a href="<?php echo $delivery; ?>"><?php echo $text_delivery; ?></a></li>
                        <li class="level0"><a href="<?php echo $articles; ?>"><?php echo $text_articles; ?></a></li>
                        <li class="level0"><a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a></li>
                        <li class="level0">&nbsp;</li>
                    </ul>
                    <div class="bottom-copyright pull-right">Питомник "Слобода Сад". <?php
                         echo '2017';
                         if(date('Y')>2017) {
                        echo '-'.date('Y');
                        }
                        ?>
                    </div>
                </div>
        </div>
    </footer>
</body>
</html>