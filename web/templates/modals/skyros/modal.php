<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header card-header">
                <p class="modal-title " id="exampleModalLabel">Είσοδος στην υπηρεσία My Petrogaz</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="text-center"> <b>Είστε ήδη χρήστης;</b></label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                               placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.
                        </small>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <div class="form-group ">
                        <div class="form-check2">
                            <div class="custom-checkbox  ">
                                <input type="checkbox" class="aaa" name="cbx7" id="cbx7" style="display:none">
                                <label for="cbx7" class="toggle"><span></span></label>
                            </div>
                            <label class="form-check-label" for="cbx7">Check me out</label>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div>Είστε νέος χρήστης;</div>
                        <a href=""><b>Εγγραφή τώρα!</b></a>
                    </div>

                    <div class="form-group ">
                        <div> Ξεχάσατε το Όνομα Χρήστη ή/και τον Κωδικό Πρόσβασης;</div>
                        <a href=""><b>Ανάκτηση στοιχείων πρόσβασης</b></a>
                    </div>

                    <div class="form-group ">
                        <div> Προβλήματα με την ενεργοποίηση του χρήστη;</div>
                        <a href=""><b>Αντιμετώπιση θεμάτων ενεργοποίησης</b></a>
                    </div>

                    <div class="form-group ">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header card-header">
                <p class="modal-title " id="exampleModalLabel">Ανάκτηση στοιχείων πρόσβασης</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form>
                    <div class="form-group ">
                        <div>Σε περίπτωση που ξεχάσατε τα στοιχεία πρόσβασής σας στην υπηρεσία e-bill, συμπληρώστε το
                            email που δηλώσατε κατά την αρχική εγγραφή σας. Σύντομα ένα νέο μήνυμα θα σας σταλεί, με το
                            Όνομα Χρήστη και οδηγίες για το πως θα αλλάξετε τον Κωδικό Πρόσβασης. Παρακαλούμε ελέγξτε τα
                            εισερχόμενα μηνύματα της ηλεκτρονικής διεύθυνσής σας.
                        </div>

                    </div>
                    <div class="form-group">

                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                               placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.
                        </small>
                    </div>


                    <div class="form-group ">
                        <button type="submit" class="btn btn-primary">e-mail</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header card-header">
                <p class="modal-title " id="exampleModalLabel">ΦΟΡΜΑ ΕΚΔΗΛΩΣΗΣ ΕΝΔΙΑΦΕΡΟΝΤΟΣ</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formaEndiaferontos" method="post" action="/send/forma/endiaferontos">
                    <div class="form-group">
                        <label for="fee_fname" class="text-center"> <b>Όνομα*</b></label>
                        <input type="text" class="form-control" id="fee_fname" name="fee_fname" aria-describedby="Όνομα" required
                               placeholder="Όνομα">
                        <!--                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
                    </div>
                    <div class="form-group">
                        <label for="fee_lname" class="text-center"> <b>Επώνυμο*</b></label>
                        <input type="text" class="form-control" id="fee_lname" name="fee_lname" aria-describedby="Επώνυμο" required
                               placeholder="Επώνυμο">
                        <!--                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
                    </div>
                    <div class="form-group">
                        <label for="fee_phone" class="text-center"> <b>Τηλέφωνο*</b></label>
                        <input type="text" class="form-control" id="fee_phone" name="fee_phone" aria-describedby="Τηλέφωνο" required
                               placeholder="Τηλέφωνο">
                        <!--                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
                    </div>
                    <div class="form-group">
                        <label for="fee_email" class="text-center"> <b>Email</b></label>
                        <input type="text" class="form-control" id="fee_email" name="fee_email"  aria-describedby="Email"
                               placeholder="Email">
                        <!--                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
                    </div>
                    <div class="form-group ">
                        <label class="form-check-label" for="fee_contact_hours">ΕΠΙΘΥΜΗΤΕΣ ΩΡΕΣ ΕΠΙΚΟΙΝΩΝΙΑΣ</label>
                        <select class="form-control" name="fee_contact_hours" id="fee_contact_hours">
                            <option value="1">09:00 - 14:30</option>
                            <option value="2">17:30 - 21:00</option>
                            <option value="3">09:00 - 21:00</option>
                        </select>
                    </div>
                    <div class="form-group ">
                        <div class="form-check2">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <input type="checkbox" class="custom-control-input" id="fee_gdpr" name="fee_gdpr">
                                <label class="custom-control-label" for="fee_gdpr">Συμφωνώ με τους όρους χρήσης (όροι για την
                                    επεξεργασία των στοιχείων για μελλοντική επικοινωνία λόγω GDPR)</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group ">
                        <div class="alert alert-warning" id="warning_alert"></div>
                        <div class="alert alert-success" id="success_alert"></div>
                    </div>

                    <div class="form-group text-center">
                        <button id="ekdilosi_endiaferontos_button" type="submit" class="btn btn-primary">Υποβολή Φόρμας</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
