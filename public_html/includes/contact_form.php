<div class="contact_form">
    <form id="contact_form" action="/inc/sendmail.php" method="POST">
        <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                <input type="text" name="name" id="name" placeholder="Your Name*" required>
            </div>
            <div class="form-group">
                <input type="text" name="phone" id="phone" placeholder="Phone Number*" required>
            </div>
            </div>
            <div class="col-md-6"> 
            <div class="form-group">   
                <input type="email" name="email" id="email" placeholder="Email*" required>
            </div>
            <div class="form-group">
                <input type="text" name="address" id="address" placeholder="Address*" required>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                <input type="text" name="city" id="city" placeholder="City*" required>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <input type="text" name="state" id="state" placeholder="State*" required>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <input type="text" name="zip" id="zip" placeholder="Zip*" required>
            </div>
        </div>
        </div>
        <div class="form-group">
            <textarea cols="30" rows="5" name="message" id="message" placeholder="Tell Us A Little About Your Plumbing Needs" required></textarea>
        </div>
        <button class="mt_btn_yellow g-recaptcha btn-block1" data-sitekey="6LeBZ7oUAAAAACcV-Iwqqd790PNACpblIuQNSX-D" data-callback='onSubmit' data-badge="bottomleft">SEND MESSAGE
            <span class="mt_load">
                <span></span>
            </span>
        </button>
        <div id="msg"></div>
    </form>

</div>