
let darkmodebtn = document.querySelector("#dark-mode");
let body = document.querySelector('body');
let nav  = document.querySelector('nav');
let navLinkText = document.querySelector(".nav-link-text");
let i = document.querySelector('i');
let footer = document.querySelector('footer');
let aside = document.querySelector('aside');
let chartWrapper = document.querySelector(".chartWrapper");
let html = document.querySelector('html');


const savedValue = localStorage.getItem("site-mode");
if (savedValue !== null) {
    darkmodebtn.checked = savedValue === "dark";
    if(darkmodebtn.checked){
        body.classList.add("darkMode")
        footer.classList.add("bg-gradient-dark");
        html.style.backgroundColor = "black !important";
    }
    else{
        body.classList.add("lightMode");
        footer.classList.remove("bg-gradient-dark");
        footer.style.backgroundColor = "rgba(0,0,0,0.5)";
        nav.style.backgroundColor = "rgba(0,0,0,0.5)";
        // html.style.backgroundColor = "black !important";
    }
}

darkmodebtn.addEventListener('change', function(){
    const value = this.checked ? "dark" : "light";

    if (darkmodebtn.checked) {
        body.classList.remove("bg-gray-200");
        body.classList.remove("lightMode");
        body.classList.add("darkMode");
        navLinkText.style.color ='white';
        footer.classList.add("bg-gradient-dark");
    } else {
        body.classList.remove("bg-gray-200");
        body.classList.remove("darkMode");
        body.classList.add("lightMode");
        footer.classList.remove('bg-gradient-dark');
    }

    localStorage.setItem("site-mode", value);
})
