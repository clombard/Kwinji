<!DOCTYPE html>
<html lang="en">
<head>
<?php echo $metas; ?>
<title><?php echo $title; ?></title>
<?php echo $css; ?>
<?php echo $js; ?>
</head>
<body <?php echo $gmap;?>>
    <div id="wrapper">
        <header>
          <?php echo $header; ?>
        </header>
        
        <section>
            <div class="container_8 clearfix">

                <!-- Back to Top -->
               <?php echo $back_to_top; ?>    

                <!-- Sidebar -->
                <aside class="grid_1">
	               <?php echo $aside_left; ?>    
                </aside>

                <!-- Sidebar End -->
                

                <!-- Main Section -->

                <section class="main-section grid_7">

                    <div class="main-content">
                    
                    <?php echo $content; ?>
                    
                    </div>

                </section>

                <!-- Main Section End -->

            </div>
            <div id="push"></div>
        </section>
    </div>
    
    <footer>
        <?php echo $footer; ?>
    </footer>
    <?php echo $widgets; ?>
    
</body>
</html>
