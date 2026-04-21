const showBtn = document.getElementById("loadtxt");
const sysBtn = document.getElementById("loadScript");
const DBBtn = document.getElementById("count1");
const roleBtn = document.getElementById("count2");
const listBtn = document.getElementById("list");

if(listBtn){
    listBtn.addEventListener("click",function () {
        fetch("user_list.php")
        .then(response => response.text())
        .then(data => {
            document.getElementById("list").innerHTML= data;
        });
    })
}


if(roleBtn){
    roleBtn.addEventListener("click",function () {
        fetch("role_count.php")
        .then(response => response.text())
        .then(data => {
            document.getElementById("countRoles").innerHTML= data;
        });
    })
}

if(DBBtn){
    DBBtn.addEventListener("click",function () {
        fetch("count.php")
        .then(response => response.text())
        .then(data => {
            document.getElementById("countUsers").innerHTML= data;
        });
    })
}

if(sysBtn){
    sysBtn.addEventListener("click",function () {
        fetch("txt.php")
        .then(response => response.text())
        .then(data => {
            document.getElementById("fetchScript").innerHTML= data;
        });
    })
}

if(showBtn){
    showBtn.addEventListener("click",function () {
        fetch("message.php")
        .then(response => response.text())
        .then(data => {
            document.getElementById("result").innerHTML= data;
        });
    })
}
