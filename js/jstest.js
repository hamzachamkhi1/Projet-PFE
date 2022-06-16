var persons = 0;
if (document.getElementById("radio2")!=null && document.getElementById("radio2").checked) 
    document.getElementById("radio1").checked ="true"

if(document.getElementById("radio1")!=null )
document.getElementById("radio1").addEventListener("change",()=>{
    if (document.getElementById("radio1").checked) {
        FadeIn("return",30);
        FadeIn("return1",30);
        document.getElementById("return").style.pointerEvents ="auto";
        document.getElementById("return").required =true;

    }
});

if(document.getElementById("radio2")!=null )
document.getElementById("radio2").addEventListener("change",()=>{
    if (document.getElementById("radio2").checked) {
        FadeOut("return",30);
        FadeOut("return1",30);
        document.getElementById("return").style.pointerEvents ="none";
        document.querySelector("#return1 + input").required =false;
    }
});
function verif(){

  if(persons==0 || parseInt(document.getElementById('adult').innerHTML)==0)
    document.getElementById('num').required = true;
  else
    document.getElementById('num').required = false;
}
function add(id){
    if(persons==5 && id!='adult' && parseInt(document.getElementById('adult').innerHTML)==0){
        document.getElementById('caution').innerHTML='<div id="sub-caution" style="background-color: #e8334b; border:2px white dashed;padding:1rem;opacity:0;"><img style="height:30px;float:left;position:relative;transform:translate(8px,-8px)"src="../img/caution.png" alt="caution"><p style="color:white;margin-left:50px">At least one adult must be added!</p></div>';
        FadeIn('sub-caution');
        setTimeout(() => {
            FadeOut('sub-caution');
            setTimeout(() => {
                document.getElementById('caution').innerHTML="";
            }, 1000);
        }, 3000);
    }
    else if(persons < 6){
    persons++;
    document.getElementById(id).innerHTML = String(parseInt(document.getElementById(id).innerHTML) + 1);
    document.getElementById(id+"_input").stepUp(1);
    console.log(document.getElementById(id+"_input").value) 
    verif();
    }
    else{
        document.getElementById('caution').innerHTML='<div id="sub-caution" style="background-color: #e8334b; border:2px white dashed;padding:1rem;opacity:0;"><img style="height:30px;float:left;position:relative;transform:translate(8px,-8px)"src="../img/caution.png" alt="caution"><p style="color:white;margin-left:50px">Only 6 Persons are allowed!</p></div>';
        FadeIn('sub-caution');
        setTimeout(() => {
            FadeOut('sub-caution');
            setTimeout(() => {
                document.getElementById('caution').innerHTML="";
            }, 1000);
        }, 3000);
    }
}
function minus(id){
    if(parseInt(document.getElementById(id).innerHTML)>0){
        persons--;
        document.getElementById(id).innerHTML = String(parseInt(document.getElementById(id).innerHTML) - 1);
        document.getElementById(id+"_input").stepDown(1)
        console.log(document.getElementById(id+"_input").value) 
        verif();
    }
}

var x, i, j, l, ll, selElmnt, a, b, c;
/*look for any elements with the class "custom-select":*/
x = document.getElementsByClassName("custom-select");
l = x.length;
for (i = 0; i < l; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  ll = selElmnt.length;
  /*for each element, create a new DIV that will act as the selected item:*/
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /*for each element, create a new DIV that will contain the option list:*/
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < ll; j++) {
    /*for each option in the original select element,
    create a new DIV that will act as an option item:*/
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /*when an item is clicked, update the original select box,
        and the selected item:*/
        var y, i, k, s, h, sl, yl;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        sl = s.length;
        h = this.parentNode.previousSibling;
        for (i = 0; i < sl; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            yl = y.length;
            for (k = 0; k < yl; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
      /*when the select box is clicked, close any other select boxes,
      and open/close the current select box:*/
      e.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
    });
}
function closeAllSelect(elmnt) {
  /*a function that will close all select boxes in the document,
  except the current select box:*/
  var x, y, i, xl, yl, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  xl = x.length;
  yl = y.length;
  for (i = 0; i < yl; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < xl; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);

