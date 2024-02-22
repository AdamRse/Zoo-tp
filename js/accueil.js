//Elements
let divMap = document.querySelector("#divMap");
let divTitleEmployees = document.querySelector("#divTitleEmployees");
let divMenu = document.querySelector("#divMenuMap");
let divStat = document.querySelector("#divStatMap");
let btStats = document.querySelector("#btStats");

let btMenu = document.querySelector("#btMenu");
let btBuyEnclos = document.querySelector("#btBuyEnclosure");

let tmpEnclos = document.querySelector("#tmpEnclosSelect");
let tmpNewEnclos = document.querySelector("#tmpEnclos");

let hiddenElements = document.querySelector("#hiddenElem");
let elemMenuEmployee = hiddenElements.querySelector(".elem-menuEmploye");
let elemEnclosure = hiddenElements.querySelector(".elem-enclosure");
let elemAnimal = hiddenElements.querySelector(".elem-animal");

let idZoo = hiddenElements.dataset.id;//Id du zoo
let colorTheme = hiddenElements.dataset.color_theme;//Constante PHP couleur theme
let pIconAnimals = hiddenElements.dataset.p_i_animals;//Constante PHP chemin dossier images animaux
let rqPending = false;

//EVENTS CLICK
btMenu.addEventListener("click", function(){//Toggle le menu
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
btStats.addEventListener("click", function(){//Toggle les stats
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

divMap.querySelector("#btBuyZk").addEventListener("click", function() {
    let btBuyZk = this;
    btBuyZk.disabled = true;
    getFetch("buyZookeeper").then(rt => {
        if(rt.error)
            alert(rt.error)
        refreshAll();
        btBuyZk.disabled = false;
    });
});
btBuyEnclos.addEventListener("click", () => {//Acheter enclos
    if(!rqPending){//l'anti-spam marche po :(
        rqPending=true;
        let typeEnclos = divMenu.querySelector("#selectBuyEnc").value;
        mapToggleHiddenId("divSelectBuyEnc", "divPendingBuyEnclos");
        closeMenus();
        getFetch("getEnclosAvailablePosition", "type="+typeEnclos).then(rt => {
            divMap.querySelectorAll(".elem-enclosure").forEach(e => {
                e.remove();
            });
            rt.forEach(p => {
                let newDiv = elemEnclosure.cloneNode(true);
                newDiv.style.background = "#fff";
                newDiv.style.top = p.posY+"%";
                newDiv.style.left = p.posX+"%";
                newDiv.querySelector(".tag-enclos").innerHTML = typeEnclos;
                newDiv.addEventListener('click', () => {
                    getFetch("buyEnclosure", "type="+typeEnclos+"&px="+p.posX+"&py="+p.posY).then(rt2 => {
                        if(rt2.error)
                            alert(rt2.error);
                        refreshAll();
                        mapToggleHiddenId("divPendingBuyEnclos", "divSelectBuyEnc");
                        rqPending=false;
                    });
                });
                divMap.appendChild(newDiv);
            })
        });
    }
});
document.querySelector("#btBuyAnimal").addEventListener("click", () => {//Acheter animal
    if(!rqPending){
        rqPending=true;
        mapToggleHiddenId("divSelectBuyAnimal", "divPendingBuyAnimal");
        closeMenus();
        let animal = divMenu.querySelector("#selectBuyAnimal").value;
        console.log(animal);
        divMap.querySelectorAll(".elem-enclosure").forEach(div => {
            div.removeEventListener("click", () => {});
            div.addEventListener("click", function(){
                getFetch("buyAnimal", "name="+animal+"&enclos="+this.dataset.id).then(rt => {
                    console.log(rt);
                    if(rt.error)
                        alert(rt.error);
                    refreshAll();
                    mapToggleHiddenId("divPendingBuyAnimal", "divSelectBuyAnimal");
                    rqPending=false;
                });
            });
        });
    }
});


//FUNCTIONS ACTIONS
function refreshAll(){
    getFetch("getEnclosEmployeesAnimaux").then((rt) => {
        if(rt.employes)
        updateDivEmployees(rt.employes)
    if(rt.enclos)
    updateAllEnclos(rt.enclos)
})
}
function updateDivEmployees(employes){
    let nbEmployees = employes.length;
    let divAppendEmployees = divStat.querySelector("#appendEmployees");
    divAppendEmployees.innerHTML = "";
    divTitleEmployees.innerHTML = "Employee"+(nbEmployees>1?"s":"")+" ("+nbEmployees+")";
    employes.forEach((employe) => {
        let newDiv = elemMenuEmployee.cloneNode(true);
        newDiv.dataset.id = employe.id;
        newDiv.querySelector("img").src = newDiv.querySelector("img").dataset.p_icon+"/"+employe.img;
        newDiv.querySelector(".name").innerHTML = employe.name;
        newDiv.querySelector(".role").innerHTML = employe.role
        newDiv.querySelector(".experience").innerHTML = employe.experience == 0 ? "Newbie" : "Experience : "+employe.experience;
        divAppendEmployees.appendChild(newDiv);
    });
}
function updateAllEnclos(enclosList){
    divMap.querySelectorAll(".elem-enclosure").forEach(e => {
        e.remove();
    });
    enclosList.forEach(enclos => {
        let newDiv = elemEnclosure.cloneNode(true);
        newDiv.dataset.id = enclos.id;
        newDiv.style.background = "center/150% url('./images/"+enclos.type+".png')";
        newDiv.style.top = enclos.posY+"%";
        newDiv.style.left = enclos.posX+"%";
        newDiv.querySelector(".tag-enclos").innerHTML = enclos.type;
        if(enclos.animaux)
            updateAnimalsEnslos(newDiv, enclos.animaux)
    divMap.appendChild(newDiv);
});
}
function updateAnimalsEnslos(divEnclos, animals){
    animals.forEach(animal => {
        console.log(animal);
        let newDiv = elemAnimal.cloneNode(true);
        newDiv.querySelector(".elem-icon").src = pIconAnimals+animal.icon;
        newDiv.style.top = 0;
        if(animal.malade > 75 || animal.dort < 25 || animal.faim < 25)
            newDiv.style.background = "#622";
    divEnclos.appendChild(newDiv);
});
}

//FONCTION SCRIPT
function mapToggleHiddenId(hide, display){
    divMap.querySelector("#"+hide).classList.add("hidden");
    divMap.querySelector("#"+display).classList.remove("hidden");
}
function closeMenus(){
    divMenu.classList.add("hidden");
    btMenu.classList.remove("bg-"+colorTheme+"-200");
    btMenu.classList.remove("ring-"+colorTheme+"-700");

    divStat.classList.add("hidden");
    btStats.classList.remove("bg-"+colorTheme+"-200");
    btStats.classList.remove("ring-"+colorTheme+"-700");
}

refreshAll();