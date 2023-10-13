<?php $this->layout($myTemplate) ?>
<?php $this->insert("partials/{$myTemplate}/banner") ?>

        <div class="container">
            <!-- main body -->
            <main id="main">
                <section class="mb-5">
                    <div class="jumbotron unhide-slider">
                        <h1 class="display-1 text-center text-blue py-5 ">Σφάλμα 404!</h1>
                        <p class="font-big">Η Σελίδα που ψάχνετε δεν βρέθηκε. Χρησιμοποιήστε τα μενού περιήγησης για να μεταβείτε σε μια άλλη σελίδα.</p>
                    </div>
                </section>
            </main>
        </div>
        <!-- map spacer -->
        <?php $this->insert("partials/{$myTemplate}/spacer_map.php") ?>