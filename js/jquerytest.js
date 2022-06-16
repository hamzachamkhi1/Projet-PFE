//$('#r1').css("visibility", "hidden");
$("#a0").css("visibility", "visible");
$("#a1").css("visibility", "visible");
$("#a2").css("visibility", "hidden");
$("#a3").css("visibility", "hidden");
$("#a4").css("visibility", "hidden");
$("#resvhotel").css("height", "22em");

$("#rooms").change(function () {
  var noOfRooms = $(this).val();
  


  //$('.drop1').css({opacity: 0.0, visibility: "visible"}).animate({opacity: 1.0});
  $("#a0").css("visibility", "visible");
  $("#a0").css("opacity", "0");

  $("#a1").css("visibility", "visible");
  $("#a1").css("opacity", "0");

  $("#a2").css("visibility", "visible");
  $("#a2").css("opacity", "0");

  $("#a3").css("visibility", "visible");
  $("#a3").css("opacity", "0");

  $("#a4").css("visibility", "visible");
  $("#a4").css("opacity", "0");


  //$('#r1').css("visibility", "visible");

  //delaying the button animation

  var buttonDelay = function () {
  
  };

  setTimeout(buttonDelay, 500);

  /*var inputDelay=function(){
      $('#r1').css("visibility", "visible");
    };
  
  setTimeout(inputDelay,1500);*/

  var fadeInInput = function () {
    //$('#r1').css({opacity: 0}).animate({opacity: 1.0});


    if (noOfRooms === "1") {
      $("#resvhotel").css("height", "22em")
      $("#a0").css({ opacity: 0 }).fadeTo(500, 1);
      $("#a1").css({ opacity: 0 }).fadeTo(500, 1);
      
    }

    if (noOfRooms === "2") {
      $("#resvhotel").css("height", "33em")
      $("#a0").css({ opacity: 0 }).fadeTo(500, 1);
      $("#a1").css({ opacity: 0 }).fadeTo(500, 1);
      $("#a2").css({ opacity: 0 }).fadeTo(500, 1);
      
    }

    if (noOfRooms === "3") {
      $('#resvhotel').css("height", "44em");
      $("#a0").css({ opacity: 0 }).fadeTo(500, 1);
      $("#a1").css({ opacity: 0 }).fadeTo(500, 1);
      $("#a2").css({ opacity: 0 }).fadeTo(500, 1);
      $("#a3").css({ opacity: 0 }).fadeTo(500, 1);
     
    }
  };

  setTimeout(fadeInInput, 1200);
});

$("#ag").css("visibility", "hidden");
$("#ag1").css("visibility", "hidden");


$("#enfant").change(function () {
  var noOenf = $(this).val();
  


  //$('.drop1').css({opacity: 0.0, visibility: "visible"}).animate({opacity: 1.0});

  $("#ag").css("visibility", "visible");
  $("#ag").css("opacity", "0");

  $("#ag1").css("visibility", "visible");
  $("#ag1").css("opacity", "0");

  var fadeInInput = function () {
    //$('#r1').css({opacity: 0}).animate({opacity: 1.0});
    if (noOenf === "0") {
      
      
    }
    if (noOenf === "1") {
      $("#ag").css({ opacity: 0 }).fadeTo(500, 1);
     
     
    }

    if (noOenf === "2") {
      $("#ag").css({ opacity: 0 }).fadeTo(500, 1);
      $("#ag1").css({ opacity: 0 }).fadeTo(500, 1);
     
      
    }

    
  };

  setTimeout(fadeInInput, 1200);
});



$("#ag2").css("visibility", "hidden");
$("#ag2-").css("visibility", "hidden");


$("#enfant2").change(function () {
  var noOenf = $(this).val();
  


  //$('.drop1').css({opacity: 0.0, visibility: "visible"}).animate({opacity: 1.0});

  $("#ag2").css("visibility", "visible");
  $("#ag2").css("opacity", "0");

  $("#ag2-").css("visibility", "visible");
  $("#ag2-").css("opacity", "0");

  var fadeInInput = function () {
    //$('#r1').css({opacity: 0}).animate({opacity: 1.0});
    if (noOenf === "0") {
      
      
    }
    if (noOenf === "1") {
      $("#ag2").css({ opacity: 0 }).fadeTo(500, 1);
     
     
    }

    if (noOenf === "2") {
      $("#ag2").css({ opacity: 0 }).fadeTo(500, 1);
      $("#ag2-").css({ opacity: 0 }).fadeTo(500, 1);
     
      
    }

    
  };

  setTimeout(fadeInInput, 1200);
});

$("#ag3").css("visibility", "hidden");
$("#ag3-").css("visibility", "hidden");


$("#enfant3").change(function () {
  var noOenf = $(this).val();
  


  //$('.drop1').css({opacity: 0.0, visibility: "visible"}).animate({opacity: 1.0});

  $("#ag3").css("visibility", "visible");
  $("#ag3").css("opacity", "0");

  $("#ag3-").css("visibility", "visible");
  $("#ag3-").css("opacity", "0");

  var fadeInInput = function () {
    //$('#r1').css({opacity: 0}).animate({opacity: 1.0});
    if (noOenf === "0") {
      
      
    }
    if (noOenf === "1") {
      $("#ag3").css({ opacity: 0 }).fadeTo(500, 1);
     
     
    }

    if (noOenf === "2") {
      $("#ag3").css({ opacity: 0 }).fadeTo(500, 1);
      $("#ag3-").css({ opacity: 0 }).fadeTo(500, 1);
     
      
    }

    
  };

  setTimeout(fadeInInput, 1200);
});


$("#ag4").css("visibility", "hidden");
$("#ag4-").css("visibility", "hidden");


$("#enfant4").change(function () {
  var noOenf = $(this).val();
  


  //$('.drop1').css({opacity: 0.0, visibility: "visible"}).animate({opacity: 1.0});

  $("#ag4").css("visibility", "visible");
  $("#ag4").css("opacity", "0");

  $("#ag4-").css("visibility", "visible");
  $("#ag4-").css("opacity", "0");

  var fadeInInput = function () {
    //$('#r1').css({opacity: 0}).animate({opacity: 1.0});
    if (noOenf === "0") {
      
      
    }
    if (noOenf === "1") {
      $("#ag4").css({ opacity: 0 }).fadeTo(500, 1);
     
     
    }

    if (noOenf === "2") {
      $("#ag4").css({ opacity: 0 }).fadeTo(500, 1);
      $("#ag4-").css({ opacity: 0 }).fadeTo(500, 1);
     
      
    }

    
  };

  setTimeout(fadeInInput, 1200);
});
