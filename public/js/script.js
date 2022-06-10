var i = 0;
console.log("bonjour");
function slideShow(){
  setTimeout(slideShow, 3000);
  var x;
  const slide = document.getElementsByClassName("slide");
  for(x = 0; x < slide.length; x++){
    slide[x].style.display = "none";
  }
  i++;
  if(i > slide.length){i = 1}
  slide[i -1].style.display = "block";
}
slideShow();