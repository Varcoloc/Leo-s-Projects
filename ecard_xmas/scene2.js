/****************
VARIABLE LIBRARY
****************/

/***Numbers***/
var anna_clicks = 0;

/***ARROWS***/
var left_arrow = document.getElementById('Left');
var right_arrow = document.getElementById('Right');

/***ANNA***/
var anna = document.getElementById('Anna');
var speech = document.getElementById('Text_x5F_bubble');
var speech_bubble = document.getElementById('speech_x5F_bubble');
anna.style.opacity = "1"
anna.style.transform = "translate(0px)"
anna.style.transition = "all 1.75s"

/***SNOWMAN***/
var big_circle = document.getElementById('Big');
var med_circle = document.getElementById('Medium');
var sm_circle = document.getElementById('Small');
var left_arm = document.getElementById('Left_x5F_arm');
var right_arm = document.getElementById('Right_x5F_arm');
var nose = document.getElementById('Nose');
var eye1 = document.getElementById('Eye1');
var eye2 = document.getElementById('Eye2');

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
    location.href = "scene1.html"
});

//Right
right_arrow.addEventListener('mouseover', function(){
    right_arrow.style.transform = "translate(20px)"
    right_arrow.style.transition = "all 0.75s"
});
right_arrow.addEventListener('mouseout', function(){
    right_arrow.style.transform = "translate(0px)"
    right_arrow.style.transition = "all 0.75s"
});
right_arrow.addEventListener('click', function(){
    location.href = "scene3.html"
});

/***ANNA***/
anna.addEventListener('click', function(){
    anna_clicks++;
    if (anna_clicks == 1){
        anna.style.opacity = "1"
        speech.innerHTML = "<tspan x='0' y='0' class='st21 st22 st23'>" + "Once you are done building," + "</tspan>" + "<tspan x='0' y='16.8' class='st21 st22 st23'>" + "Click on the right yellow arrow to continue." + "</tspan>" + "<tspan x='0' y='33.6' class='st21 st22 st23'>" + "Type 'snowman' to build" + "</tspan>" + "<tspan x='0' y='50.4' class='st21 st22 st23'>" + "Or click on the objects to build" + "</tspan>"
    }
    if (anna_clicks == 2){
        anna.style.opacity = "0"
        anna.style.transform = "translate(555px)"
        anna.style.transition = "all 1.75s"
        big_circle.style.cursor = "pointer"
        med_circle.style.cursor = "pointer"
        sm_circle.style.cursor = "pointer"
        left_arm.style.cursor = "pointer"
        right_arm.style.cursor = "pointer"
        nose.style.cursor = "pointer"
        eye1.style.cursor = "pointer"
        eye2.style.cursor = "pointer"
    }
});

/***SNOWMAN BUILDING***/
med_circle.addEventListener('click', function(){
    med_circle.style.transform = "translate(-116px, -87px)"
    med_circle.style.transition = "all 1.5s"
});

sm_circle.addEventListener('click', function(){
    sm_circle.style.transform = "translate(106px, -157px)"
    sm_circle.style.transition = "all 1.75s"
});
nose.addEventListener('click', function(){
    nose.style.transform = "translate(-82px, -228px)"
    nose.style.transition = "all 2s"
});
left_arm.addEventListener('click', function(){
    left_arm.style.transform = "translate(-95px, -200px) rotate(4deg)"
    left_arm.style.transition = "all 1.75s"
});
right_arm.addEventListener('click', function(){
    right_arm.style.transform = "translate(23px, -147px) rotate(-4deg)"
    right_arm.style.transition = "all 1.75s"
});
eye1.addEventListener('click', function(){
    eye1.style.transform = "translate(73px, -240px)"
    eye1.style.transition = "all 2s"
});
eye2.addEventListener('click', function(){
    eye2.style.transform = "translate(73px, -240px)"
    eye2.style.transition = "all 2s"
});

/***SNOWING***/
clouds.addEventListener('click', function(){
    snow.style.opacity = "1"
    snow.style.transform = "translate(0px, 150px)"
    snow.style.transition = "all 1s"
});

/***STOP SNOWING & SNOWMAN BUILDING USING THE KEYBOARD CONTROLS***/
var snowclicks = 0;
function snowing(e){
    console.log(snowclicks);
    snowclicks++;
    var evtobj=window.event? event : e
    var unicode=evtobj.charCode? evtobj.charCode : evtobj.keyCode
    var actualkey=String.fromCharCode(unicode)
    if (actualkey == "q"){
        snow.style.opacity = "0"
        }
    if (actualkey == "s"){
        med_circle.style.transform = "translate(-116px, -87px)"
        med_circle.style.transition = "all 1.5s"
    }
    if (actualkey == "n"){
        sm_circle.style.transform = "translate(106px, -157px)"
        sm_circle.style.transition = "all 1.75s"
    }
    if (actualkey == "o"){
        nose.style.transform = "translate(-82px, -228px)"
        nose.style.transition = "all 2s"
    }
    if (actualkey == "w"){
        left_arm.style.transform = "translate(-95px, -200px) rotate(4deg)"
        left_arm.style.transition = "all 1.75s"
    }
    if (actualkey == "m"){
        right_arm.style.transform = "translate(23px, -147px) rotate(-4deg)"
        right_arm.style.transition = "all 1.75s"
    }
    if (actualkey == "a"){
        eye1.style.transform = "translate(73px, -240px)"
        eye1.style.transition = "all 2s"    
    }
    if (actualkey == "n" && snowclicks == 7){
        eye2.style.transform = "translate(73px, -240px)"
        eye2.style.transition = "all 2s"
    }
}
document.onkeypress = snowing;