var addBtn = document.getElementById("add-btn");

var modal = document.getElementById("add-modal");

var cancel = document.getElementById("cancel-add");

addBtn.onclick = function(){
    modal.style.display = "block";
}

cancel.onclick = function(){
    modal.style.display = "none";
}

window.onclick = function(event){
    if(event.target == modal){
        modal.style.display = "none";
    };
}
