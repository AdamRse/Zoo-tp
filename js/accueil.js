console.log("Hola accueil");
divMenu = document.querySelector("#divMenuMap");
divStat = document.querySelector("#divStatMap");
document.querySelector("#btMenu").addEventListener("click", function(){
    divMenu.classList.toggle("hidden");
});
document.querySelector("#btStats").addEventListener("click", function(){
    divStat.classList.toggle("hidden");
});