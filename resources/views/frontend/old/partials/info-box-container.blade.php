<section class="info-box-container">
    <form method="get" action="/search">
    <div class="search-input" id="search-input-box">
        <img src="/assets/btn-cross.svg" alt="" id="cross-btn">
        <input type="text" name="search" placeholder="search" id="search-input-container">
    </div>
    </form>
    <div class="phone-hover d-flex align-items-center justify-content-center">
        <div class="d-flex align-items-center justify-content-center flex-lg-row flex-md-row flex-column">
            <p>+880244802111,</p>
            <p>+8809642115500</p>
        </div>
    </div>
    <div class="contact-input-box" id="search-input-box">
        <div class="cross-contact">
            <img src="/assets/cross-green.svg" alt="">
        </div>
        <div class="input-collection text-center">
            <h2>contact us</h2>
        </div>
        <div class="input-collection">
            <label for="">Your name</label>
            <input type="text" id="name">
        </div>
        <div class="input-collection">
            <label for="">Your subject</label>
            <input type="text" id="subject">
        </div>
        <div class="input-collection">
            <label for="">Your email</label>
            <input type="email" id="email">
        </div>
        <div class="input-collection">
            <label for="">Your message</label>
            <textarea type="text" id="message"></textarea>
        </div>
        <div class="input-collection text-center">
            <button onclick="contactUsSubmit()">send</button>
        </div>
    </div>
</section>
<section class="info-box-container">
    <div class="search-input" id="search-input-box">
        <img src="/assets/btn-cross.svg" alt="" id="cross-btn">
        <input type="text" placeholder="search" id="search-input-container">
    </div>
</section>

<div class="modal fade custom-modal" id="contactSuccess" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div id="contact-us-success-msg" class="text-success"></div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
</div>


<link rel="stylesheet" href="/css/scss/global.css">
