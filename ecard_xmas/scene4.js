/****************
VARIABLE LIBRARY
****************/

/***Numbers***/
var fireswitch = 0;
var elsa_clicks = 0;
var plus_clicks = 0;
var tree_clicks = 0;
var pr_clicks = 0;
var pr2_clicks = 0;
var pr3_clicks = 0;

/***ARROWS***/
var left_arrow = document.getElementById('Left');

/***ELSA***/
var elsa = document.getElementById('Elsa');
var speech = document.getElementById('Text_x5F_bubble');
var speech_bubble = document.getElementById('speech_x5F_bubble');
elsa.style.opacity = "1"
elsa.style.transform = "translate(0px)"
elsa.style.transition = "all 1.75s"

/***FACT BOXES***/
var fact1 = document.getElementById('fact1');
var fact2 = document.getElementById('fact2');
var summary = document.getElementById('fact_x5F_summary');

/***FIREPLACE STUFF***/
var fire_pit = document.getElementById('Logs');
var fire = document.getElementById('fire');

/***DECORATION BUTTON***/
var plus = document.getElementById('plus');

/***DECORATIONS***/
//Christmas Tree
var christmas_tree = document.getElementById('Tree');
var star = document.getElementById('Star_1_');
var bot_decorations = document.getElementById('Bot');
var bot_secondary_decorations = document.getElementById('Bot_x5F_mid_x5F_section2');
var mid_secondary_decorations = document.getElementById('Bot_x5F_mid_x5F_section1');
var mid_decorations = document.getElementById('Mid_1_');
var top_secondary_decorations = document.getElementById('Top_x5F_Mid');
var top_decorations = document.getElementById('Top_Deco');
var gifts = document.getElementById('Gift');

//Room Decorations
var strap = document.getElementById('Strap');
var bell1 = document.getElementById('Bell1_1_');
var bell2 = document.getElementById('Bell2');
var stocking1 = document.getElementById('Stocking1');
var stocking2 = document.getElementById('Stocking2_1_');
var stocking3 = document.getElementById('Stocking3');
var fire_deco = document.getElementById('Fire_x5F_deco');
var circle_tree = document.getElementById('Circle_x5F_Tree');
var bow = document.getElementById('bow');
var candycane = document.getElementById('CandyCane');

/***PRESENTS***/
var pr1 = document.getElementById('Box_1_');
var pr2 = document.getElementById('Box_2_');
var pr3 = document.getElementById('Box_3_');


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
    location.href = "scene3.html"
});

/***ELSA***/
elsa.addEventListener('click', function(){
    elsa_clicks++;
    if (elsa_clicks == 1){
        elsa.style.opacity = "1"
        speech.innerHTML = "<tspan x='0' y='0' class='st17 st28'>" + "The house seems pretty empty right now." + "</tspan>" + "<tspan x='0' y='16.8' class='st17 st28'>" + "See if you can decorate it a little." + "</tspan>"
        fact1.style.cursor = "pointer"
        fact2.style.cursor = "pointer"
        fire_pit.style.cursor = "pointer"
    }
    if (elsa_clicks == 2){
        elsa.style.opacity = "0"
        elsa.style.transform = "translate(-555px)"
        elsa.style.transition = "all 1.75s"
    }
    if (elsa_clicks == 3){
        elsa.style.opacity = "1"
        speech.innerHTML = "<tspan x='0' y='0' class='st17 st28'>" + "A button has popped up for you to add" + "</tspan>" + "<tspan x='0' y='16.8' class='st17 st28'>" + "decorations. Enjoy!" + "</tspan>"
        plus.style.display = "block"
        plus.style.cursor = "pointer"
    }
    if (elsa_clicks >= 4){
        elsa.style.opacity = "0"
        elsa.style.transform = "translate(-555px)"
        elsa.style.transition = "all 1.75s"
    }
});

/***FIRE ON AND OFF***/
fire_pit.addEventListener('click', function(){
    console.log(fireswitch);
    fireswitch++;
    if (fireswitch == 1){
        fire.style.opacity = "1"
        fire.style.transition = "all 1s"
    }
    if (fireswitch == 2){
        fire.style.opacity = "0"
        fire.style.transition = "all 1s"
    }
    if (fireswitch >= 2){
        fireswitch = 0;
    }
});

/***FACT BOXES WITH ELSA***/
fact1.addEventListener('click', function(){
    elsa.style.opacity = "1"
    elsa.style.transform = "translate(0px)"
    elsa.style.transition = "all 1.75s"
    speech.innerHTML = "<tspan x='0' y='0' class='st17 st28'>" + "The Christmas Tree is a decorated tree." +"</tspan>" + "<tspan x='0' y='16.8' class='st17 st28'>" + "Let us decorate it a little." + "</tspan>"
});
fact2.addEventListener('click', function(){
    elsa.style.opacity = "1"
    elsa.style.transform = "translate(0px)"
    elsa.style.transition = "all 1.75s"
    speech.innerHTML = "<tspan x='0' y='0' class='st17 st28'>" + "There are hidden decorations all over the place." +"</tspan>" + "<tspan x='0' y='16.8' class='st17 st28'>" + "Let's decorate the room a bit." + "</tspan>"
});

/***ADDING DECORATIONS***/
plus.addEventListener('click', function(){
    plus_clicks++;
    if (plus_clicks == 1){
        star.style.opacity = "1"
        star.style.transition = "all 1s"
    }
    if (plus_clicks == 2){
        bot_decorations.style.opacity = "1"
        bot_decorations.style.transition = "all 1s"
    }
    if (plus_clicks == 3){
        bot_secondary_decorations.style.opacity = "1"
        bot_secondary_decorations.style.transition = "all 1s"
    }
    if (plus_clicks == 4){
        mid_decorations.style.opacity = "1"
        mid_decorations.style.transition = "all 1s"
    }
    if (plus_clicks == 5){
        mid_secondary_decorations.style.opacity = "1"
        mid_secondary_decorations.style.transition = "all 1s"
    }
    if (plus_clicks == 6){
        top_secondary_decorations.style.opacity = "1"
        top_secondary_decorations.style.transition = "all 1s"
    }
    if (plus_clicks == 7){
        top_decorations.style.opacity = "1"
        top_decorations.style.transition = "all 1s"
        christmas_tree.style.cursor = "pointer"
    }
    if (plus_clicks == 8){
        gifts.style.opacity = "1"
        gifts.style.transition = "all 1s"
        elsa.style.opacity = "1"
        elsa.style.transform = "translate(0px)"
        elsa.style.transition = "all 1.75s"
        speech.innerHTML = "<tspan x='0' y='0' class='st17 st28'>" + "Gifts! Gotta love presents am I right?" + "</tspan>" + "<tspan x='0' y='16.8' class='st17 st28'>" + "Try Opening one" + "</tspan>"
        pr1.style.cursor = "pointer"
        pr2.style.cursor = "pointer"
        pr3.style.cursor = "pointer"
        
        /***Christmas Tree Function Special lighting***/
        christmas_tree.addEventListener('click', function(){
        console.log(tree_clicks);
        tree_clicks++;
        if (tree_clicks == 1){
        christmas_tree.style.fill = "yellow"
        christmas_tree.style.transition = "all 1.25s"
        }
        if (tree_clicks == 2){
        christmas_tree.style.fill = "black"
        christmas_tree.style.transition = "all 1.25s"
        }
        if (tree_clicks >= 2){
        tree_clicks = 0;
        }
        });
    }
    if (plus_clicks == 9){
        strap.style.opacity = " 1"
        strap.style.transition = "all 1s"
    }
    if (plus_clicks == 10){
        bell1.style.opacity = "1"
        bell1.style.transition = "all 1s"
    }
    if (plus_clicks == 11){
        bell2.style.opacity = "1"
        bell2.style.transition = "all 1s"
    }
    if (plus_clicks == 12){
        stocking1.style.opacity = "1"
        stocking1.style.transition = "all 1s"
    }
    if (plus_clicks == 13){
        stocking2.style.opacity = "1"
        stocking2.style.transition = "all 1s"
    }
    if (plus_clicks == 14){
        stocking3.style.opacity = "1"
        stocking3.style.transition = "all 1s"
    }
    if (plus_clicks == 15){
        fire_deco.style.opacity = "1"
        fire_deco.style.transition = "all 1s"
    }
    if (plus_clicks == 16){
        circle_tree.style.opacity = "1"
        circle_tree.style.transition = "all 1s"
    }
    if (plus_clicks == 17){
        bow.style.opacity = "1"
        bow.style.transition = "all 1s"
    }
    if (plus_clicks == 18){
        candycane.style.opacity = "1"
        candycane.style.transition = "all 1s"
        elsa.style.opacity = "1"
        elsa.style.transform = "translate(0px)"
        elsa.style.transition = "all 1.75s"
        speech.innerHTML = "<tspan x='0' y='0' class='st17 st28'>" + "Good Job! You decorated the entire room!" + "</tspan>" + "<tspan x='0' y='16.8' class='st17 st28'>" + "Click on the piece of paper to view the" + "</tspan>" + "<tspan x='0' y='33.6' class='st17 st28'>" + "interactions. Thank You for playing!" + "</tspan>"
        plus.style.cursor = "default"
        plus.style.display = "none"
        
        /***VIEW SUMMARY***/
        summary.addEventListener('click', function(){
        location.href = "summary.html"
        });
        summary.style.cursor = "pointer"
        candycane.style.cursor = "pointer"
    }
});

/***CANDY CANE BONUS FACT***/
candycane.addEventListener('click', function(){
    elsa.style.opacity = "1"
    elsa.style.transform = "translate(0px)"
    elsa.style.transition = "all 1.75s"
    speech.innerHTML = "<tspan x='0' y='0' class='st17 st28'>" + "The candy cane is my favourite treat!" + "</tspan>"
});

/***PRESENTS***/
var bear = document.createElement('img');
pr1.addEventListener('click', function(){
    console.log(pr_clicks);
    pr_clicks++;
    if (pr_clicks == 1){
        bear.src = "Bear.png";
        bear.style.cursor = "pointer"
        document.body.appendChild(bear);
        elsa.style.opacity = "1"
        elsa.style.transform = "translate(0px)"
        elsa.style.transition = "all 1.75s"
        speech.innerHTML = "<tspan x='0' y='0' class='st17 st28'>" + "You got a teddy bear!" + "</tspan>" + "<tspan x='0' y='16.8' class='st17 st28'>" + "Click on the gift to take it." + "</tspan>"
    }
    if (pr_clicks == 2){
        document.body.removeChild(bear);
    }
});
var train = document.createElement('img');
pr2.addEventListener('click', function(){
    pr2_clicks++;
    if (pr2_clicks == 1){
        train.src = "Train.png"
        train.style.cursor = "pointer"
        document.body.appendChild(train);
        elsa.style.opacity = "1"
        elsa.style.transform = "translate(0px)"
        elsa.style.transition = "all 1.75s"
        speech.innerHTML = "<tspan x='0' y='0' class='st17 st28'>" + "You got a model train!" + "</tspan>" + "<tspan x='0' y='16.8' class='st17 st28'>" + "Click on the gift to take it." + "</tspan>"
    }
    if (pr2_clicks == 2){
        document.body.removeChild(train);
    }
});
var car = document.createElement('img');
pr3.addEventListener('click', function(){
    pr3_clicks++;
    if (pr3_clicks == 1){
        car.src = "Car.png"
        car.style.cursor = "pointer"
        document.body.appendChild(car);
        elsa.style.opacity = "1"
        elsa.style.transform = "translate(0px)"
        elsa.style.transition = "all 1.75s"
        speech.innerHTML = "<tspan x='0' y='0' class='st17 st28'>" + "You got a model car!" + "</tspan>" + "<tspan x='0' y='16.8' class='st17 st28'>" + "Click on the gift to take it." + "</tspan>"
    }
    if (pr3_clicks == 2){
        document.body.removeChild(car);
    }
});

/***IF GIFT IS CLICKED ON REMOVE***/
car.addEventListener('click', function(){
    document.body.removeChild(car);
});
train.addEventListener('click', function(){
    document.body.removeChild(train);
});
bear.addEventListener('click', function(){
    document.body.removeChild(bear);
});