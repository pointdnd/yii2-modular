<?php 
$this->title = 'Creación de páginas web innovadoras - '.y()->id;
?>

    <section id="home" name="home"></section>
    <div id="w">
        <div class="container">
            <div class="row centered">
                <h2 class="logo aligncenter"><?=y()->id?></h2>
                <h1 class="aligncenter"><?=$this->context->module->homeTitle?></h1>
                <h3 class="main-title aligncenter"><?=$this->context->module->homeSubTitle?></h3>
                <h4><a href="#portfolio" class="smoothScroll link-more"><?=$this->context->module->homeButton?></a></h4>
            </div>
        </div>
    </div>
    
    <?php foreach($this->context->module->proyectsLists as $row):?>
    <section id="portfolio">
        <div class="section-info">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 centered info-container">
                        <!-- <h4 class="info-icon-big"><i class="fa fa-gift"></i></h4> -->
                        <h4 class="info-header"><?=$row['name']?></h4>
                        <p class="info-text intro"><?=$row['description']?></p>
                        <hr class="aligncenter">
                        
                        <div class="img-browser">
                            <div class="img-browser-header">
                                <i class="fa fa-arrow-left"></i>
                                <i class="fa fa-arrow-right"></i>
                                <i class="fa fa-repeat"></i>
                            </div>
                            <img style="width:100%" src="<?=y('.view')->theme->baseUrl?>/<?=$row['image']?>" alt="<?=$row['image_alt']?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endforeach;?>

    <?php $x=2;?>

    <?php foreach($this->context->module->questionLists as $row):?>
    <section>
        <div class="section-info<?php echo ($x++%2==0)?" section-gray":"";?>">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3 centered info-container">
                        <h4 class="info-icon-big"><i class="fa <?=$row['icon']?>"></i></h4>
                        <h4 class="info-header"><?=$row['question']?></h4>
                        <p class="info-text intro"><?=$row['response']?></p>
                        <hr class="aligncenter">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endforeach;?>