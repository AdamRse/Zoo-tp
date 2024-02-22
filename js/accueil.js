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
document.querySelector("#btMenu").addEventListener("click", function(){
    divMenu.classList.toggle("hidden");
});

btStats.addEventListener("click", function(){
    divStat.classList.toggle("hidden");
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