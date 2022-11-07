<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer type="text/javascript" src="/templates/scripts.js"></script>
</head>
<body class="bg-gray-100 tracking-wider tracking-normal h-full">

<div class="flex flex-col min-h-screen">

<?php require_once("partials/header.php") ?>

<div class="container w-full flex flex-wrap mx-auto px-2 py-8 lg:pt-16 mt-6">
<?php require_once("partials/menu.php") ?>

    <div class="w-full lg:w-4/5 p-8 mt-6 lg:mt-0 text-gray-900 leading-normal bg-white border border-gray-400 border-rounded">
<?php
if($page === 'base') {
    require_once("container.php") ;
} else {
    require_once("$page.php");
}
?>
    </div>

</div>
<?php require_once("partials/footer.php") ?>
</div>

<script>
    /*Toggle dropdown list*/
    /*https://gist.github.com/slavapas/593e8e50cf4cc16ac972afcbad4f70c8*/

    let navMenuDiv = document.getElementById("nav-content");
    let navMenu = document.getElementById("nav-toggle");

    let helpMenuDiv = document.getElementById("menu-content");
    let helpMenu = document.getElementById("menu-toggle");

    document.onclick = check;

    function check(e){
        let target = (e && e.target) || (event && event.srcElement);


        //Nav Menu
        if (!checkParent(target, navMenuDiv)) {
            // click NOT on the menu
            if (checkParent(target, navMenu)) {
                // click on the link
                if (navMenuDiv.classList.contains("hidden")) {
                    navMenuDiv.classList.remove("hidden");
                } else {navMenuDiv.classList.add("hidden");}
            } else {
                // click both outside link and outside menu, hide menu
                navMenuDiv.classList.add("hidden");
            }
        }

        //Help Menu
        if (!checkParent(target, helpMenuDiv)) {
            // click NOT on the menu
            if (checkParent(target, helpMenu)) {
                // click on the link
                if (helpMenuDiv.classList.contains("hidden")) {
                    helpMenuDiv.classList.remove("hidden");
                } else {helpMenuDiv.classList.add("hidden");}
            } else {
                // click both outside link and outside menu, hide menu
                helpMenuDiv.classList.add("hidden");
            }
        }

    }

    function checkParent(t, elm) {
        while(t.parentNode) {
            if( t == elm ) {return true;}
            t = t.parentNode;
        }
        return false;
    }


</script>
</body>
</html>