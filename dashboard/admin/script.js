let button = document.querySelector("[data-collapse-toggle]");
let mobilenav = document.querySelector("#navbar-default")
console.log(button);
button.addEventListener("click", ()=>
{
    mobilenav.classList.toggle("hidden");
})
let usersDash = document.querySelector("#details");
let usersTitle = document.querySelector("#showUsers");
let tagsDash = document.querySelector("#tagsDash");
let tagsTitle = document.querySelector("#showTags");
usersTitle.addEventListener("click", ()=>
{
    if(usersDash.classList.contains("hidden"))
    {
        usersDash.classList.toggle("hidden");
    }
    if (!tagsDash.classList.contains("hidden"))
    {
        tagsDash.classList.toggle("hidden");
    }

})
tagsTitle.addEventListener("click", ()=>
{
    
    if(tagsDash.classList.contains("hidden"))
        {
            tagsDash.classList.toggle("hidden");
        }
    if (!usersDash.classList.contains("hidden"))
        {
            usersDash.classList.toggle("hidden");
        }
})
// let tagsDash = 
// let tagsTitle = 