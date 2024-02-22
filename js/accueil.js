let hiddenElements = document.querySelector("#hiddenElem");
let idZoo = hiddenElements.dataset.id;
let elemMenuEmployee = hiddenElements.querySelector(".elem-menuEmploye");
let elemEnclosure = hiddenElements.querySelector(".elem-enclosure");

let divTitleEmployees = document.querySelector("#divTitleEmployees");

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

refreshAll();

function refreshAll(){
    getFetch("getEnclosEmployeesAnimaux").then((rt) => {
        console.log(rt);
        if(rt.employes)
            updateDivEmployees(rt.employes)
    })
}

function updateDivEmployees(employes){
    let nbEmployees = employes.length;
    divTitleEmployees.innerHTML = "Employee"+(nbEmployees>1?"s":"")+" ("+nbEmployees+")";
    employes.forEach((employe) => {
        let newDiv = elemMenuEmployee.cloneNode(true);
        console.log();
        newDiv.dataset.id = employe.id;
        newDiv.querySelector("img").src = newDiv.querySelector("img").dataset.p_icon+"/"+employe.img;
        newDiv.querySelector(".name").innerHTML = employe.name;
        newDiv.querySelector(".role").innerHTML = employe.role
        newDiv.querySelector(".experience").innerHTML = employe.experience == 0 ? "Newbie" : "Experience : "+employe.experience;
        divStat.appendChild(newDiv);
    });
}