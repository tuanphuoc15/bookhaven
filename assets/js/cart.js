const cards = document.querySelectorAll(".card");

window.addEventListener("scroll", () => {

cards.forEach(card => {

const cardTop = card.getBoundingClientRect().top;

if(cardTop < window.innerHeight - 50){
card.classList.add("show");
}

});

});
function showToast(){

const toast = document.getElementById("toast");

toast.style.display = "block";

setTimeout(()=>{
toast.style.display = "none";
},2000);

}