/****************
VARIABLE LIBRARY
****************/

/***Numbers***/
var anna_clicks = 0;

/***ARROWS***/
var left_arrow = document.getElementById('Left');

/***ANNA***/
var anna = document.getElementById('Anna');
var speech = document.getElementById('Text_x5F_bubble');
var speech_bubble = document.getElementById('speech_x5F_bubble');
anna.style.opacity = "1"
anna.style.transform = "translate(0px)"
anna.style.transition = "all 1.75s"

/***SANTA***/
var santa_sleigh = document.getElementById('Sleigh');

/***CLOUDS AND SNOW***/
var clouds = document.getElementById('Clouds');
var snow = document.getElementById('Snowfall');


/**************
MAIN FUNCTIONS
**************/

/***ARROWS***/

//Left
left_arrow.addEventListener('mouseover', function(){
    left_arrow.style.transform = "translate(-20px)"
    left_arrow.style.transition = "all 0.75s"
});
left_arrow.addEventListener('mouseout', function(){
    left_arrow.style.transform = "translate(0px)"
    left_arrow.style.transition = "all 0.75s"
});
left_arrow.addEventListener('click', function(){
    location.href = "scene2.html"
});

/***ANNA***/
anna.addEventListener('click', function(){
    anna_clicks++;
    if (anna_clicks == 1){
        anna.style.opacity = "0"
        anna.style.transform = "translate(555px)"
        anna.style.transition = "all 1.75s"
        house_body.style.cursor = "pointer"
        
        //Body & Santa transition
        
        house_body.addEventListener('click', function(){
            anna.style.opacity = "1"
            santa_sleigh.style.opacity = "1"
            santa_sleigh.style.transform = "translate(0px)"
            santa_sleigh.style.transition = "all 2.5s"
            anna.style.transform = "translate(0px)"
            anna.style.transition = "all 1.75s"
            speech.innerHTML = "<tspan x='0' y='0' class='st81 st82'>" + "Hooray! Santa is here!" + "</tspan>" + "<tspan x='0' y='16.8' class='st81 st82'>" + "I never knew that his reindeers could fly!" + "</tspan>" + "<tspan x='0' y='33.6' class='st81 st82'>" + "Click on the chimney to continue." + "</tspan>"
});
    }
    if (anna_clicks == 2){
        anna.style.opacity = "0"
        anna.style.transform = "translate(555px)"
        anna.style.transition = "all 1.75s"
        
        //chimney interaction
        chimney.style.cursor = "pointer"
        chimney.addEventListener('click', function(){
            giftdrop.style.opacity = "1"
            giftdrop.style.transform = "translate(0px, 130px)"
            giftdrop.style.transition = "all 1.75s"
            anna.style.opacity = "1"
            anna.style.transform = "translate(0px)"
            anna.style.transition = "all 1.75s"
            speech.innerHTML = "<tspan x='0' y='0' class='st81 st82'>" + "It seems like Santa has just dropped a present" + "</tspan>" + "<tspan x='0' y='16.8' class='st81 st82'>" + "from the sky!" + "</tspan>" + "<tspan x='0' y='33.6' class='st81 st82'>" + "Click on the door to enter the house." + "</tspan>"
});    
    }
    if (anna_clicks >= 3){
        anna.style.opacity = "0"
        anna.style.transform = "translate(555px)"
        anna.style.transition = "all 1.75s"
        door.style.cursor = "pointer"
        //opening the door
        door.addEventListener('click', function(){
            location.href = "scene4.html"
});
    }
});

/***HOUSE ELEMENTS***/
var door = document.getElementById('Door');
var house_body = document.getElementById('Body_2_');
var chimney = document.getElementById('Chimney');
var giftdrop = document.getElementById('Gift');

/***SNOWING***/
clouds.addEventListener('click', function(){
    snow.style.opacity = "1"
    snow.style.transform = "translate(0px, 150px)"
    snow.style.transition = "all 1s"
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