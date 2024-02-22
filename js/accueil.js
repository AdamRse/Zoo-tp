console.log("Hola accueil");
let divMenu = document.querySelector("#divMenuMap");
let divStat = document.querySelector("#divStatMap");
let btStats = document.querySelector("#btStats");
let divMap = document.querySelector("#divMap");
let tmpEnclos = document.querySelector("#tmpEnclosSelect");
let tmpNewEnclos = document.querySelector("#tmpEnclos");
let btMenu = document.querySelector("#btMenu");

let colorTheme = divMap.dataset.color_theme;
console.log(colorTheme);


if (btMenu) {
    btMenu.addEventListener("click", function(){

        if (divMenu.classList.contains("hidden")) {
            divMenu.classList.remove("hidden");
            btMenu.classList.add("bg-"+colorTheme+"-200");
            btMenu.classList.add("ring-"+colorTheme+"-700");
        }else{
            divMenu.classList.add("hidden");
            btMenu.classList.remove("bg-"+colorTheme+"-200");
            btMenu.classList.remove("ring-"+colorTheme+"-700");
        }
             
       });  
}

if(btStats){
    btStats.addEventListener("click", function(){

        if (divStat.classList.contains("hidden")) {
            divStat.classList.remove("hidden");
            btStats.classList.add("bg-"+colorTheme+"-200");
            btStats.classList.add("ring-"+colorTheme+"-700");
        }else{
            divStat.classList.add("hidden");
            btStats.classList.remove("bg-"+colorTheme+"-200");
            btStats.classList.remove("ring-"+colorTheme+"-700");
        }
             
       }); 
}
// Ajout
document.querySelector('#btBuyZk').addEventListener("click", function(){
    fetch('./ajax/buyZookeeper.php')
    .then((response=>{ 
        console.log(response);
       
    }))
})
document.querySelector('#btBuyEnclosure').addEventListener("click", function(){
    let encType = document.querySelector("#selectBuyEnc").value;
    getFetch("getEnclosAvailablePosition", "type="+encType).then((rt) => {
        let i = 0;
        rt.forEach(enc => {
            let nvEncSelect = tmpEnclos.cloneNode(true);
            nvEncSelect.id = "ne-"+i; nvEncSelect.classList.add("inline-block");  nvEncSelect.classList.remove("hidden");
            nvEncSelect.dataset.posX = enc.posX; nvEncSelect.dataset.posY = enc.posY; nvEncSelect.style.left = enc.posX+"%"; nvEncSelect.style.top = enc.posY+"%";
            nvEncSelect.addEventListener("click", function(){
                let thisEnc = this;
                getFetch("buyEnclosure", "type="+encType).then((rtBuy) => {
                    if(rtBuy === true){
                        nvEncSelect.classList.remove("inline-block"); nvEncSelect.classList.add("hidden");
                        let nvEnc = tmpNewEnclos.cloneNode(true);
                        nvEnc.id = ""; nvEnc.classList.add("inline-block"); nvEnc.classList.remove("hidden");
                        nvEnc.style.top = thisEnc.dataset.posY; nvEnc.style.top = thisEnc.dataset.posX; nvEnc.style.background = "center/150% url('./images/"+encType+".png')";
                        nvEnc.querySelector('div').innerHTML = encType;
                        
                    }
                    else{
                        alert("An error occured\n"+rtBuy.error);
                        window.location.href = "./";
                    }
                });
            })
            divMap.appendChild(nvEnc);
        });
    });
   
})
document.querySelector('#btBuyAnimal').addEventListener("click", function(){
    fetch('./ajax/buyAnimal.php')
   
    .then((response=>{ 
        console.log(response);
       
    }))
   
})
function random(a) {
    fetch('./classes/Animaux/Animal.class.php')
    a.then((response =>{
        return response.json();
    }))

}
