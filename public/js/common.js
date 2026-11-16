const navigationMenu = document.querySelector(".navigation-menu")
const menuBtn = document.querySelector(".navigation-icon")
const menuCross = document.querySelector(".navigation-cross")

// button and icons selectors
const searchBtn = document.getElementById("search-icon");
const searchInputBox = document.getElementById("search-input-box");
const crossBtn = document.getElementById("cross-btn")
const searchInputContainer = document.getElementById("search-input-container")
const phoneBtn = document.getElementById("phone-icon")
const phoneBox = document.querySelector(".phone-hover")
const contactForm = document.querySelector(".contact-input-box")
const contactCross = document.querySelector(".cross-contact")
const contactBtn = document.getElementById("email-icon")

let searchShow = false;
let phoneShow = false;
let contactShow = false;

let rellax = new Rellax('.rellax');


AOS.init({
    mirror: false,
    disable: 'mobile'
});

menuBtn.addEventListener("click", e => {
    e.preventDefault()
    navigationMenu.style.left = "0"
    menuBtn.style.display = "none"
    menuCross.style.display = "block"
})

menuCross.addEventListener("click", e => {
    e.preventDefault()
    navigationMenu.style.left = "-100%"
    menuBtn.style.display = "block"
    menuCross.style.display = "none"
})



// search btn event

const handleSearchBtnShow = () => {
    searchInputBox.style.transform = "translateX(0)"
}
const handleSearchBtnHide = () => {
    searchInputBox.style.transform = "translateX(425px)"
    searchInputContainer.value = ""
}
const handlePhoneBoxShow = () => {
    phoneBox.style.transform = "translateX(0)"
}
const handlePhoneBoxHide = () => {
    phoneBox.style.transform = "translateX(400px)"
}
const handleContactFormShow = () => {
    contactForm.style.transform = "translateX(0)"
}
const handleContactFormHide = () => {
    contactForm.style.transform = "translateX(565px)"
}

// search box event
searchBtn.addEventListener("click", e => {
    e.preventDefault()
    handleSearchBtnShow()
    handlePhoneBoxHide()
    handleContactFormHide()
})

crossBtn.addEventListener("click", e => {
    e.preventDefault()
    handleSearchBtnHide()
})

// phone box event
phoneBtn.addEventListener("mouseover", e => {
    e.preventDefault()
    handlePhoneBoxShow()
    handleContactFormHide()
    handleSearchBtnHide()
})

phoneBtn.addEventListener("mouseleave", e => {
    e.preventDefault()
    handlePhoneBoxHide()
})

// contact form event

contactBtn.addEventListener("click", e => {
    e.preventDefault()
    handleContactFormShow()
    handleSearchBtnHide()
    handlePhoneBoxHide()
})

contactCross.addEventListener("click", e => {
    e.preventDefault()
    handleContactFormHide()
})



// const smileCircle = document.getElementById("smileCircle");
// $(".smile-list-item-hover-effect").mouseover(function(){
//     var image = $(this).attr('image');
//     smileCircle.style.backgroundImage = "url('"+image+"')"
//   });


  function contactUsSubmit(){
    var isError=false;
    $('.text-danger').html('');
    if (!$('#name').val()){
        $('#name').parent().append('<span class="text-danger">Please enter your name.</span>');
        isError=true;
    }
    if (!$('#subject').val()){
        $('#subject').parent().append('<span class="text-danger">Please enter subject.</span>');
        isError=true;
    }
    var email=$('#email').val();
    if (!email){
        $('#email').parent().append('<span class="text-danger">Please enter your email address.</span>');
        isError=true;
    }else if(!IsEmail(email)){
        $('#email').parent().append('<span class="text-danger">Please enter valid email address.</span>');
        isError=true;
    }


    if (!$('#message').val()){
        $('#message').parent().append('<span class="text-danger">Please enter your message.</span>');
        isError=true;
    }

    if(isError){
        return false;
    }
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    // e.preventDefault();
    var formData = {
        name: $('#name').val(),
        subject: $('#subject').val(),
        email: $('#email').val(),
        message: $('#message').val(),
    };


    var type = "POST";
    var ajaxurl = '/send-message';
    $.ajax({
        type: type,
        url: ajaxurl,
        data: formData,
        dataType: 'json',
        success: function (data) {
            if(data.success){
                $('#contactSuccess').modal('show');
                $('#contact-us-success-msg').html('Thanks for submitting your message.We will reach you soon!');
                handleContactFormHide();
            }
            console.log(data);
            // var todo = '<tr id="todo' + data.id + '"><td>' + data.id + '</td><td>' + data.title + '</td><td>' + data.description + '</td>';
            // if (state == "add") {
            //     $('#todo-list').append(todo);
            // } else {
            //     $("#todo" + todo_id).replaceWith(todo);
            // }
            // jQuery('#myForm').trigger("reset");
            // jQuery('#formModal').modal('hide')
        },
        error: function (data) {
            console.log(data);
        }
    });
};

function IsEmail(email) {
var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if(!regex.test(email)) {
        return false;
    }else{
        return true;
    }
}
let mybutton = document.getElementById("btn-back-to-top");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function () {
scrollFunction();
};

function scrollFunction() {
if (
    document.body.scrollTop > 20 ||
    document.documentElement.scrollTop > 20
) {
    mybutton.style.display = "block";
} else {
    mybutton.style.display = "none";
}
}
// When the user clicks on the button, scroll to the top of the document
mybutton.addEventListener("click", backToTop);

function backToTop() {
document.body.scrollTop = 0;
document.documentElement.scrollTop = 0;
}

// const dropDownBtn = document.getElementById("container-btn")
// const containerList = document.getElementById("container-list")
// const downSign = document.getElementById("down-sign")

// dropDownBtn.addEventListener("click", e => {
//     e.preventDefault()
//     if(containerList.style.display === "block"){
//         containerList.style.display = "none"
//         downSign.style.transform = "rotate(0deg)"
//     }else{
//         containerList.style.display = "block"
//         downSign.style.transform = "rotate(-180deg)"
//     }
// })

// $('.dropdown-container').mouseover(function(){
//     if(containerList.style.display === "block"){
//         containerList.style.display = "none"
//         downSign.style.transform = "rotate(0deg)"
//     }else{
//         containerList.style.display = "block"
//         downSign.style.transform = "rotate(-180deg)"
//     }
// });

// $('.down-arrow').mouseover(function(){
//     if(containerList.style.display === "block"){
//         containerList.style.display = "none"
//         downSign.style.transform = "rotate(0deg)"
//     }else{
//         containerList.style.display = "block"
//         downSign.style.transform = "rotate(-180deg)"
//     }
// });

// $(window).scroll(testScroll);
// var viewed = false;

// function isScrolledIntoView(elem) {
//     var docViewTop = $(window).scrollTop();
//     var docViewBottom = docViewTop + $(window).height();

//     var elemTop = $(elem).offset().top;
//     var elemBottom = elemTop + $(elem).height();

//     return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
// }


// function testScroll() {
//     if (isScrolledIntoView($(".counter-count")) && !viewed) {
//         viewed = true;
//         $('.counter-count').each(function () {
//             $(this).prop('Counter', 0).animate({
//                 Counter: $(this).text()
//             }, {
//                 duration: 4000,
//                 easing: 'swing',
//                 step: function (now) {
//                     $(this).text(Math.ceil(now));
//                 }
//             });
//         });
//     }
// }
$(document).ready(function(){
  $(".dropdown").hover(function(){
        var dropdownMenu = $(this).children(".dropdown-menu");
        if(dropdownMenu.is(":visible")){
            dropdownMenu.parent().toggleClass("open");
        }
    });
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    // boundary: document.body
    return new bootstrap.Tooltip(tooltipTriggerEl)
    })
    $(document).on('mouseleave','[data-bs-toggle="tooltip"]', function(){
        $(this).tooltip('hide');
    });
});



