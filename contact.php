<?php
include "includes/header.php";

?>

<form id="contact-form" method="post" action="email.php" role="form">

<div class="messages"></div>

<div class="controls">
  <div class="card card-display card-cart">
    <div class="card-body">
        <h1 class="card-title text-center">Kontakt</h1>
        <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="form_name">Förnamn *</label>
                <input id="form_name" type="text" name="name" class="form-control" placeholder="Förnamn *" required="required" data-error="Firstname is required.">
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="form_lastname">Efternam *</label>
                <input id="form_lastname" type="text" name="surname" class="form-control" placeholder="Efternamn *" required="required" data-error="Lastname is required.">
                <div class="help-block with-errors"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="form_email">Email *</label>
                <input id="form_email" type="email" name="email" class="form-control" placeholder=" exempel@dinmail.com *" required="required" data-error="Valid email is required.">
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="form_phone">Telefonnummer</label>
                <input id="form_phone" type="tel" name="phone" class="form-control" placeholder="Telefonnummer">
                <div class="help-block with-errors"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="form_message">Meddelande *</label>
                <textarea id="form_message" name="message" class="form-control" placeholder="Meddelande *" rows="4" required="required" data-error="Please,leave us a message."></textarea>
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-12">
            <input type="submit" class="btn btn-success btn-send" value="Skicka mail">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <p class="text-muted"><strong>*</strong> Obligatoriska fält.</p>
        </div>
    </div>
</div>

</form>

  </div>
</div>
<?php include "includes/footer.php"; ?>