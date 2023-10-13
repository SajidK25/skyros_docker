<?php $this->layout($myTemplate) ?>

    <!-- top section picture -->
    <?php $this->insert("partials/{$myTemplate}/banner") ?>
    <div class="container mb-5">
            <!-- main body -->
            <main id="main">
                <section>

                <h1 class="text-center text-blue py-5"><?= $data->title ?></h1>
                <div class="row justify-content-center">
                    <!-- telephones -->
                        <div class="col-md-6">

<!--                            <h3 class="py-5 text-blue text-center">Χρήσιμα Τηλέφωνα </h3>-->
<!--                                <p class="text-blue"><a href="mailto:dimoskirou@0888.Syzefxis.gov.gr"></a>EMAIL: dimoskirou@0888.Syzefxis.gov.gr</a></p>-->
<!--                                <p class="text-blue">ΤΗΛΕΦΩΝΙΚΗ ΓΡΑΜΜΗ: 2222350-</p>-->
<!--                                <p class="text-blue">300	Γραμματεία δημάρχου</p>-->
<!--                                <p class="text-blue">311	ΠΑΠΑΔΗΜΗΤΡΙΟΥ ΜΑΡΙΑ (ΠΡΩΤΟΚΟΛΛΟ)</p>-->
<!--                                <p class="text-blue">343	ΛΗΞΙΑΡΧΕΙΟ</p>-->
<!--                                <p class="text-blue">308	ΓΡΑΜΜΑΤΕΙΑ-ΔΗΜΟΥ ΣΚΥΡΟΥ</p>-->
<!--                                <p class="text-blue">315	ΓΡΑΜΜΑΤΕΙΑ-ΔΗΜΟΥ ΣΚΥΡΟΥ</p>-->
<!--                                <p class="text-blue">328	ΓΡΑΜΜΑΤΕΙΑ-ΔΗΜΟΥ ΣΚΥΡΟΥ</p>-->
<!--                                <p class="text-blue">318	ΟΙΚΟΝΟΜΙΚΗ ΥΠΗΡΕΣΙΑ</p>-->
<!--                                <p class="text-blue">319	ΟΙΚΟΝΟΜΙΚΗ ΥΠΗΡΕΣΙΑ</p>-->
<!--                                <p class="text-blue">320	ΟΙΚΟΝΟΜΙΚΗ ΥΠΗΡΕΣΙΑ</p>-->

                            <?= $data->descr ?>


                        </div>
                    <!-- form section   -->
                        <div class="col-md-6">
                            <h3 class="py-5 text-blue text-center"><?= mainModel::getLang("contact.form.title",$lang) ?></h3>
                            <?php $this->insert("partials/{$myTemplate}/contact_form") ?>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    <!-- map spacer -->
    <?php $this->insert("partials/{$myTemplate}/spacer_map") ?>