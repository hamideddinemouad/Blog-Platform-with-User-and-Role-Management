let button = document.querySelector("[data-collapse-toggle]");
let mobilenav = document.querySelector("#navbar-default")
console.log(button);
button.addEventListener("click", ()=>
{
    mobilenav.classList.toggle("hidden");
})