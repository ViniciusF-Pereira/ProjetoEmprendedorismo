var img = document.getElementsByClassName('Imagem_produto_x')[0];

var img1 = document.getElementsByClassName('produtos_x_images_1')[0];
var img2 = document.getElementsByClassName('produtos_x_images_2')[0];

img1.addEventListener("click", function() { img.style.backgroundImage = img1.style.backgroundImage; });
img2.addEventListener("click", function() { img.style.backgroundImage = img2.style.backgroundImage; });