<?php $this->layout($myTemplate) ?>
<!-- main header -->
    <?php include('configs/dummyData/dummy_data.php'); ?>
<!-- top section picture -->
    <?php $this->insert("partials/{$myTemplate}/banner") ?>
        <div class="container">
            <!-- main body -->
            <main id="main">

                <h1 class="text-center text-blue py-5">Σελίδα Λίστας Δίστηλη</h1>
                <div class="row mb-5">
                    <!-- side menu section -->
                    <div class="col-md-3 col-sm-6">
                        <section>
                            <?php $this->insert("partials/{$myTemplate}/side_list") ?>
                        </section>
                    </div>
                    <!--list section   -->
                    <div class="col-md-9 col-sm-6">
                        <section class="">
                            <!-- article loop -->
                            <?php for($i=0; $i<5; $i++) { ?>
                                <div class="row py-2">
                                    <div class="col-md-3 col-sm-6">
                                        <img src="/dist/img/group<?php echo $i+1; ?>.png" alt="picture" class="img-fluid">
                                    </div>
                                    <div class="col-md-9 col-sm-6">
                                        <a href="#"><h3 class="text-blue"><?php echo $titles[$i]; ?></h3></a>
                                        <p class="text-blue"><em><?php echo rand_date(); ?></em></p>
                                        <p class="text-blue"><?php echo $texts[$i]; ?></p>
                                    </div>
                                </div>
                            <?php  } ?>

                        </section>
                    </div>
                </div>

            </main>
        </div>
        <!-- map spacer -->
    <?php $this->insert("partials/{$myTemplate}/spacer_map") ?>