"use strict";

window.addEventListener("DOMContentLoaded", (e) => {
    console.log("dom chargé");
    
    let sidenav = document.getElementById("mySidenav");
    let openBtn = document.getElementById("openBtn");
    let closeBtn = document.getElementById("closeBtn");
    
    openBtn.onclick = openNav;
    closeBtn.onclick = closeNav;
    
    
    function openNav() {
      sidenav.classList.add("active");
    }
    

    function closeNav() {
      sidenav.classList.remove("active");
    }
});

