
let darkmodebtn = document.querySelector("#dark-mode");
let body = document.querySelector('body');

darkmodebtn.addEventListener('change', function(){

    if (darkmodebtn.checked) {
        console.log("Checkbox is checked");
    } else {
        console.log("Checkbox is not checked");
    }
})
