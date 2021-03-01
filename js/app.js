function izmijeniGrad(id) {
    document.getElementById('grad_id_izmjena').value = id;
}

function izmijeniNekretninu(id) {
    document.getElementById('nekretnina_id_izmjena').value = id;
    console.log(id);
}

function izmijeniTip(id) {
    document.getElementById('tip_id_izmjena').value = id;
}

$(document).ready(function() {



    //slider
    $('.owl-carousel').owlCarousel({
        center: true,
        nav: false,
        loop: true,
        items: 1,
        smartSpeed: 1200,
        autoplayHoverPause: true,
        margin: 0,
        dots: true,
        dotsData: false,

    });


    var openmodal = document.querySelectorAll('.modal-open')
    for (var i = 0; i < openmodal.length; i++) {
        openmodal[i].addEventListener('click', function(event) {
            event.preventDefault()
            toggleModal()
        })
    }

    const overlay = document.querySelector('.modal-overlay')
    overlay.addEventListener('click', toggleModal)

    var closemodal = document.querySelectorAll('.modal-close')
    for (var i = 0; i < closemodal.length; i++) {
        closemodal[i].addEventListener('click', toggleModal)
    }

    document.onkeydown = function(evt) {
        evt = evt || window.event
        var isEscape = false
        if ("key" in evt) {
            isEscape = (evt.key === "Escape" || evt.key === "Esc")
        } else {
            isEscape = (evt.keyCode === 27)
        }
        if (isEscape && document.body.classList.contains('modal-active')) {
            toggleModal()
        }
    };

    function toggleModal() {
        const body = document.querySelector('body')
        const modal = document.querySelector('.modal')
        modal.classList.toggle('opacity-0')
        modal.classList.toggle('pointer-events-none')
        body.classList.toggle('modal-active')
    }

    var openmodal2 = document.querySelectorAll('.modal-open2')
    for (var i = 0; i < openmodal2.length; i++) {
        openmodal2[i].addEventListener('click', function(event) {
            event.preventDefault()
            toggleModal2()
        })
    }

    const overlay2 = document.querySelector('.modal-overlay2')
    overlay2.addEventListener('click', toggleModal2)

    var closemodal2 = document.querySelectorAll('.modal-close2')
    for (var i = 0; i < closemodal2.length; i++) {
        closemodal2[i].addEventListener('click', toggleModal2)
    }

    document.onkeydown = function(evt) {
        evt = evt || window.event
        var isEscape = false
        if ("key" in evt) {
            isEscape = (evt.key === "Escape" || evt.key === "Esc")
        } else {
            isEscape = (evt.keyCode === 27)
        }
        if (isEscape && document.body.classList.contains('modal-active')) {
            toggleModal2()
        }
    };

    function toggleModal2() {
        const body = document.querySelector('body')
        const modal = document.querySelector('.modal2')
        modal.classList.toggle('opacity-0')
        modal.classList.toggle('pointer-events-none')
        body.classList.toggle('modal-active')
    }


});