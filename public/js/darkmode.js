
let darkmodebtn = document.querySelector("#dark-mode");
let body = document.querySelector('body');
let nav  = document.querySelector('nav');
let navLinkText = document.querySelector(".nav-link-text");

const savedValue = localStorage.getItem("site-mode");
if (savedValue !== null) {
    darkmodebtn.checked = savedValue === "dark";
    darkmodebtn.checked
        ? body.classList.add("darkMode")
        : body.classList.add("lightMode");
}

darkmodebtn.addEventListener('change', function(){
    const value = this.checked ? "dark" : "light";

    if (darkmodebtn.checked) {
        body.classList.remove("bg-gray-200");
        body.classList.remove("lightMode");
        body.classList.add("darkMode");
        navLinkText.style.color ='white';
    } else {
        console.log("Checkbox is not checked");
        body.classList.remove("bg-gray-200");
        body.classList.remove("darkMode");
        body.classList.add("lightMode");
        
    }

    localStorage.setItem("site-mode", value);
})
