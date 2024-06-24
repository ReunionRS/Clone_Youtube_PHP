window.onload = function () {
    document.getElementById("user-icon").onclick = openUserMenu;

    document.getElementById("close-user-menu").onclick = closeUserMenu;

    if (document.getElementById("close-register")) {
        document.getElementById("close-register").onclick = closeRegister;

        document.getElementById("close-login").onclick = closeLogin;
    }

    function openUserMenu() {
        document.getElementById("user-menu").style.display = "block";
        openLogin();
    }

    function closeUserMenu() {
        document.getElementById("user-menu").style.display = "none";
        if (document.getElementById("register")) {
            document.getElementById("register").style.display = "none";
            document.getElementById("login").style.display = "none";
        }
    }

    function openLogin() {
        if (document.getElementById("register")) {
            document.getElementById("login").style.display = "flex";
            document.getElementById("register").style.display = "none";
        }
    }

    function closeLogin() {
        if (document.getElementById("register")) {
            document.getElementById("login").style.display = "none";
            document.getElementById("register").style.display = "flex";
        }

    }

    function closeRegister() {
        if (document.getElementById("register")) {
            document.getElementById("register").style.display = "none";
            document.getElementById("login").style.display = "flex";
        }
    }
    if(document.getElementById("user-icon1")){
        document.getElementById("user-icon1").onclick = openUserUpload;
        document.getElementById("close-user-upload").onclick = closeUserUpload;
    }

    function openUserUpload() {
        document.getElementById("user-upload").style.display = "block";
    }

    function closeUserUpload() {
        document.getElementById("user-upload").style.display = "none";
    }



}


