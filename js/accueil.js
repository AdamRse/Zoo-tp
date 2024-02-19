console.log("Hola accueil");
let divMenu = document.querySelector("#divMenuMap");
let divStat = document.querySelector("#divStatMap");
let btStats = document.querySelector("#btStats");
document.querySelector("#btMenu").addEventListener("click", function(){
    divMenu.classList.toggle("hidden");
});

if(btStats){
    btStats.addEventListener("click", function(){
        divStat.classList.toggle("hidden");
    });
}
// Ajout
document.querySelector('#btBuyZk').addEventListener("click", function(){
    fetch('./ajax/buyZookeeper.php')
   
    .then((response=>{ 
        console.log(response);
       
    }))
   
})
