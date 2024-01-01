function preview_img() {
    var file = document.getElementById('prod_img').files[0];
    var reader = new FileReader();
    var upl_img = document.getElementById('upl_img')

    reader.onloadend = function () {
       upl_img.src = reader.result;
    }

    if (file) {
        reader.readAsDataURL(file);
    } else {
        upl_img.src = "D:\\'Softare engineering 2 assignments'\\'Group Projects'\\developement_web\\App\\icons";
    }
}