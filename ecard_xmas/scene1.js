/****************
VARIABLE LIBRARY
****************/

/***Numbers***/
var clicks = 0;
var elsa_clicks = 0;

/***MERRY CHRISTMAS CENTER***/
var Merry_Xmas = document.getElementById('Merry_x5F_Xmas');

/***ARROW***/
var arrow1 = document.getElementById('Arrow_1_');

/***SIGN***/
var sign1 = document.getElementById('Sign');
var signdate = document.getElementById('Text');

/***SLEIGH***/

//Sled
var sled1 = document.getElementById('Sled');

//Santa
var santa = document.getElementById('Santa');

//Chair
var chair = document.getElementById('Chair');

//Reindeers
var reindeers = document.getElementById('Reindeers');

/***HOUSE***/
var house1 = document.getElementById('House1');

/***ELSA***/
var elsa = document.getElementById('Elsa');
var speech = document.getElementById('Text_x5F_bubble');
var speech_bubble = document.getElementById('speech_x5F_bubble');
elsa.style.opacity = "1"
elsa.style.transform = "translate(0px)"
elsa.style.transition = "all 1.75s"

/***CLOUDS AND SNOW***/
var clouds = document.getElementById('Clouds');
var snow = document.getElementById('Snowfall');


/**************
MAIN FUNCTIONS
**************/

/***ARROW NEXT PAGE***/
arrow1.addEventListener('mouseover',    function(){
    arrow1.style.transform = "translate(20px)"
    arrow1.style.transition = "all 0.75s"
});
    arrow1.addEventListener('mouseout', function(){
    arrow1.style.transform = "translate(0px)"
    arrow1.style.transition = "all 0.75s"
});

/***Adding Sleigh Stuff***/

//Adding Reindeers
santa.addEventListener('click', function(){
    reindeers.style.opacity = "1"
    reindeers.style.transition = "all 1s"
    elsa.style.opacity = "1"
    elsa.style.transform = "translate(0px)"
    elsa.style.transition = "all 1.75s"
    speech.innerHTML = "<tspan x='0' y='0' class='st87 st88'>" + "Santa has a total of eight reindeers." + "</tspan>" + "<tspan x='0' y='16.8' class='st87 st88'>" + "Their names are Dasher, Dancer, Prancer, Vixen," + "</tspan>" + "<tspan x='0' y='33.6' class='st87 st88'>" + "Comet, Cupid, Duner, Blixem, and Rudolph." + "<tspan x='0' y='50.4' class='st87 st88'>" + "Click on the yellow arrow to continue." + "</tspan>"
    
    /***CLICK TO GO TO NEXT PAGE***/
    arrow1.addEventListener('click', function(){
        location.href = "scene2.html"
    });
});

/***ELSA***/
speech_bubble.addEventListener('click', function(){
    elsa_clicks++;
    if (elsa_clicks == 1){
         speech.innerHTML = "<tspan x='0' y='0' class='st87 st88'>" + "Let's start by clicking the sign four times." + "</tspan>"
    }
    if (elsa_clicks == 2){
        elsa.style.opacity = "0"
        elsa.style.transform = "translate(-555px)"
        elsa.style.transition = "all 1.75s"
        sign1.style.cursor = "pointer"
        signdate.style.cursor = "pointer"
        
        /***Date Changing***/
         sign1.addEventListener('click', function(){
        clicks++;
        if (clicks == 1){
            signdate.innerHTML = "DEC 22"
        }
        if (clicks == 2){
            signdate.innerHTML = "DEC 23"
        }
        if (clicks == 3){
            signdate.innerHTML = "DEC 24"
        }
        if (clicks == 4){
            signdate.innerHTML = 'DEC 25'
            Merry_Xmas.style.opacity = "1"
            Merry_Xmas.style.transition = "all 1s"
            elsa.style.opacity = "1"
            elsa.style.transform = "translate(0px)"
            elsa.style.transition = "all 1.75s"
            speech.innerHTML = "<tspan x='0' y='0' class='st87 st88'>" + "It's Christmas Day! I am so excited!" + "</tspan>" + "<tspan x='0' y='16.8' class='st87 st88'>" + "Click the house next." + "</tspan>"
            
            //Adding Santa
            house1.addEventListener('click', function(){
                santa.style.opacity = "1";
                santa.style.transition = "all 1s"
                santa.style.cursor = "pointer"
                elsa.style.opacity = "1"
                elsa.style.transform = "translate(0px)"
                elsa.style.transition = "all 1.75s"
                speech.innerHTML = "<tspan x='0' y='0' class='st87 st88'>" + "You got Santa to come out!" + "</tspan>" + "<tspan x='0' y='16.8' class='st87 st88'>" + "Santa is the father figure of Christmas" + "</tspan>" + "<tspan x='0' y='33.6' class='st87 st88'>" + "Click on him next." + "</tspan>"
});
    }
});
    }
    if (elsa_clicks >= 3){
        elsa.style.opacity = "0"
        elsa.style.transform = "translate(-555px)"
        elsa.style.transition = "all 1.75s"
        house1.style.cursor = "pointer"
    }
});

/***SNOWING***/
clouds.addEventListener('click', function(){
    snow.style.opacity = "1"
    snow.style.transform = "translate(0px, 150px)"
    snow.style.transition = "all 1s"
    elsa.style.opacity = "1"
    elsa.style.transform = "translate(0px)"
    elsa.style.transition = "all 1.75s"
    speech.innerHTML = "<tspan x='0' y='0' class='st87 st88'>" + "To stop snowing, press the Q key" + "</tspan>"
});

/***STOP SNOWING***/
function snowing(e){
    var evtobj=window.event? event : e
    var unicode=evtobj.charCode? evtobj.charCode : evtobj.keyCode
    var actualkey=String.fromCharCode(unicode)
    if (actualkey=="q")
        snow.style.opacity = "0"
}
document.onkeypress = snowing