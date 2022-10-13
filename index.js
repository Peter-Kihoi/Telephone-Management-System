const btn = document.querySelector("#menu-btn");
const overlay = document.querySelector("#overlay");
const menu = document.querySelector("#mobile-menu");
const counters = document.querySelectorAll(".counter");

btn.addEventListener('click', function () {

    btn.classList.toggle('open');
    overlay.classList.toggle("overlay-show");
    document.body.classList.toggle("stop-scrolling");
    menu.classList.toggle("show-menu");

})


// login


    function myFunction(){
        var x = document.getElementById("myInput");
        var y = document.getElementById("hide1");
        var z = document.getElementById("hide2");

        if(x.type === 'password'){
            x.type = "text";
            y.style.display = "block";
            z.style.display = "none";
        }
        else{
            x.type = "password";
            y.style.display = "none";
            z.style.display = "block";
        }
    }

