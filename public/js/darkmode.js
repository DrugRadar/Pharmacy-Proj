
let darkmodebtn = document.querySelector("#dark-mode");
let body = document.querySelector('body');
let nav  = document.querySelector('nav');
let navLinkText = document.querySelector(".nav-link-text");

darkmodebtn.addEventListener('change', function(){

    if (darkmodebtn.checked) {
        body.classList.remove("bg-gray-200");
        body.style.backgroundImage =
            "linear-gradient( #000000,#5d9ca3)";
        navLinkText.style.color ='white';
    } else {

        console.log("Checkbox is not checked");
        body.classList.remove("bg-gray-200");
        body.style.backgroundImage =
            "linear-gradient(330.93deg, #FFB234 -6.5%, rgba(141, 42, 19, 0.5) 42.31%, transparent 81.62%)";
    }
})
