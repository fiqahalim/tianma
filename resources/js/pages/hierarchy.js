$("#menu-item").click(function(){
    $(".sub-menu").toggle();
});

$("#child-item1").click(function(){
    $(".child-menu1").toggle();
});

$("#child-item2").click(function(){
    $(".child-menu2").toggle();
});

$("#child-item3").click(function(){
    $(".child-menu3").toggle();
});

$("#child-item4").click(function(){
    $(".child-menu4").toggle();
});

$("#child-item5").click(function(){
    $(".child-menu5").toggle();
});

$("#child-item6").click(function(){
    $(".child-menu6").toggle();
});

$("#child-item7").click(function(){
    $(".child-menu7").toggle();
});

$("#child-item8").click(function(){
    $(".child-menu8").toggle();
});

$("#child-item9").click(function(){
    $(".child-menu9").toggle();
});

$("#child-item10").click(function(){
    $(".child-menu10").toggle();
});

$("#child-item11").click(function(){
    $(".child-menu11").toggle();
});

$("#child-item12").click(function(){
    $(".child-menu12").toggle();
});

const btn = document.getElementById('child-item1');

btn.addEventListener('click', function handleClick() {
  const initialText = 'Hide All';

  if (btn.textContent.toLowerCase().includes(initialText.toLowerCase())) {
    btn.innerHTML =
      btn.textContent = 'Show All';
  } else {
    btn.textContent = initialText;
  }
});
