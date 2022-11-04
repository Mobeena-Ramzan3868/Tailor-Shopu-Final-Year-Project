function topFunction() {
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}


function leftFunction() {

    document.getElementById("navbar").style.display = "none";
    document.getElementById("footer").style.marginLeft = "5%";
    document.getElementById("scroll").style.marginLeft = "5%";
    document.getElementById("Closenavbar").style.display = "flex";



}

function closeFunction() {
    document.getElementById("footer").style.marginLeft = "16%";
    document.getElementById("scroll").style.marginLeft = "16%";
    document.getElementById("navbar").style.display = "flex";
    document.getElementById("Closenavbar").style.display = "none";

}