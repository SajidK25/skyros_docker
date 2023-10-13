<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<form class="py-3" id="contactForm" action="/contact/send" method="post">
        <div class="form-group">
            <label for="exampleFormControlInput1"><?= mainModel::getLang("contact.form.email",$lang) ?></label>
            <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="<?= mainModel::getLang("contact.form.placeholder.email",$lang) ?>">
        </div>
        <div class="form-group">
            <label for="name"><?= mainModel::getLang("contact.form.name",$lang) ?></label>
            <input type="text" name="name" class="form-control" id="name" placeholder="<?= mainModel::getLang("contact.form.placeholder.name",$lang) ?>">
        </div>
        <div class="form-group">
            <label for="subject"><?= mainModel::getLang("contact.form.subject",$lang) ?></label>
            <input type="text" name="subject" class="form-control" id="subject" placeholder="<?= mainModel::getLang("contact.form.placeholder.subject",$lang) ?>">
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1"><?= mainModel::getLang("contact.form.message",$lang) ?></label>
            <textarea name="message" class="form-control" id="exampleFormControlTextarea1" placeholder="<?= mainModel::getLang("contact.form.placeholder.message",$lang) ?>" rows="3"></textarea>
        </div>


        <div class="form-group">
        <div class="g-recaptcha" data-sitekey="<?= Config::get("reCAPTCHASiteKey") ?>"></div>
        </div>


        <div class="form-group">
            <button class="btn bg-blue text-smoke px-3 py-2 mt-3"><?= mainModel::getLang("contact.form.submit",$lang) ?></button>
        </div>
        <div class="errors"></div>
    </form>

