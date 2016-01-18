/*************************util.js*************************
*
Javascript utility functions for horrieinternational.com
*
*************************util.js*************************/

function checkFormFields(formToCheck, errorDiv, ignoreList)
{
    //Thanks I.E. for not allowing default values... Set it to null just so we know what the value is
    if(!ignoreList)
        ignoreList = null;
    var myForm = document.getElementById(formToCheck);
    var myDiv = document.getElementById(errorDiv);
    var msg = "";
    var elmnts = myForm.elements;
    var ignore = !ignoreList ? new Array() : ignoreList;

    //console.log("ignore :" + ignore.toString());
    if(ignoreList != null)
            console.log("ignore list :" + ignoreList.toString());
    //console.log("index of middlename " + ignore.indexOf("middlename"));

    //Reset the display colors for each input name (if one or more was red, turn it white)
    for(var i = 0; i < elmnts.length; i++)
    {
        var field = document.getElementById("err" + elmnts[i].name);
        if(field)
            field.style.color = "white";
    }

    //Check to see if any textfields or textareas are blank
    for(var i = 0; i < elmnts.length; i++)
    {
        if(elmnts[i].type == "text" || elmnts[i].type == "textarea")
        {
                if(elmnts[i].value == "" && ignore.indexOf(elmnts[i].name) < 0)
                {
                        msg = "Error: you must fill in the <strong>" + elmnts[i].name + "</strong> field";
                        myDiv.style.display = "inline";
                        myDiv.innerHTML = msg;

                        var field = document.getElementById("err" + elmnts[i].name);
                        field.style.color = "red";

                        return false;
                }

                if(elmnts[i].name == "email")
                {
                        //alert(/[_a-zA-Z0-9\.-]+?@[_a-zA-Z0-9\.-]+?\.[a-zA-Z]{2,4}$/.test(elmnts[i].value));

                        //regex for checking email format
                        if(/^[_a-zA-Z0-9.-]+@[_a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/.test(elmnts[i].value) == false)
                        {
                                msg = "Error: Invalid email format";
                                myDiv.style.display = "inline";
                                myDiv.innerHTML = msg;

                                var field = document.getElementById("err" + elmnts[i].name);
                                field.style.color = "red";

                                return false;
                        }

                }

                if(elmnts[i] == "message")
                {
                        //Do sanitization here!
                }
        }
    }

    return true;
}

function promptDeletePhoto(filename, photoid)
{
    if (confirm("Do you really want to delete this photo?"))
    {
        window.location.assign("deletephoto.php?dbname=" + filename + "&id=" + photoid);
    }
}

function playSound(filename)
{
    var sound = new Audio(filename);
    sound.play();
}

var startX = -1;
var startY = -1;
var searchActive = false;

function activateSearch()
{
    if(!searchActive)
    {
            showOverlay();
            moveDiv('searchbox', getStartCoords(), getCenterCoords('searchbox'));
            showCloseButton();
            searchActive = true;
            playSound("../sounds/bwip.mp3");
    }
}

function deactivateSearch()
{
    if(searchActive)
    {
            hideOverlay();
            moveDiv('searchbox', getCurrentCoords('searchbox'), getStartCoords());
            hideCloseButton();
            searchActive = false;
            playSound("../sounds/bwip.mp3");
    }
}

function getCenterCoords(divId)
{
    var targetDiv = $('#' + divId);
    
    if(targetDiv.length)
    {
            return { x: Math.round( ($(window).width() - $("#" + divId).width()) / 2 ), y: Math.round( ($(window).height() / 2) - $("#" + divId).height())};	
    }
    else
    {
            return { x: 0, y: 0};
    }
}

function getStartCoords()
{
    return { x: startX, y: startY };
}

function getCurrentCoords(divId)
{
    var targetDiv = $('#' + divId);
    
    if(targetDiv.length)
    {
            return { x: Math.round(targetDiv.offset().left), y: Math.round(targetDiv.offset().top) };
    }
    else
    {
            return { x: 0, y: 0};
    }
}

function moveDiv(divId, startCoords, endCoords)
{	
    var targetDiv = $('#' + divId);
    
    if (!targetDiv.length)
    {
        console.log("Error: target div does not exist");
        return;
    }
    else
    {
            var offset = targetDiv.offset();
            
            startX = Math.round(offset.left);
            startY = Math.round(offset.top);
            
            var endX = endCoords.x; 
            var endY = endCoords.y; 
            
            var steps = 10;

            var curX = startX;
            var curY = startY;
            
            var movDistX = Math.abs(endX - startX) / steps;
            var movDistY = Math.abs(endY - startY) / steps;
                       
            var id = setInterval(function() {
                if(startX < endX) {
                    if((curX + movDistX) > endX) {
                        curX = endX;
                    }
                    else {
                        curX += movDistX;
                    }
                }
                else if(startX > endX) {
                    if((curX - movDistX) < endX) {
                        curX = endX;
                    }
                    else {
                        curX -= movDistX;
                    }				
                }
                            
                if(startY < endY) {
                    if((curY + movDistY) > endY) {
                        curY = endY;
                    }
                    else {
                        curY += movDistY;
                    }
                }
                else if(startY > endY) {
                    if((curY - movDistY) < endY) {
                        curY = endY;
                    }
                    else {
                        curY -= movDistY;
                    }				
                }
                    
                if (curX == endX && curY == endY){
                        clearInterval(id);
                }
                    
                targetDiv.offset({left: Math.round(curX), top: Math.round(curY)});
            }, 20);
    }
}

/**
 * toggleOverlay(): Sets the overlay div to "visible," dimming the screen.
 * @access  public
 * @return  void
 */
function showOverlay()
{
    var el = document.getElementById("overlay");
    el.style.visibility = "visible";
}

function hideOverlay()
{
    active = false;
    var el = document.getElementById("overlay");
    el.style.visibility = "hidden";
}

function showCloseButton()
{
    var el = document.getElementById("close-button");
    el.style.display = "block";
}

function hideCloseButton()
{
    var el = document.getElementById("close-button");
    el.style.display = "none";
}

function deleteWarning(postid)
{
    if(confirm("Are you sure you want to delete post: " + postid + "?"))
    {
        window.location.replace("newsadmin.php?deleteid=" + postid);
    }
}

function validateTextAreaInput(textAreaId)
{
    var textArea = _el(textAreaId);
    if(CKEDITOR.instances.posttext.getData().length > 0)
    {
        //validate html tags etc
        alert("Creating new news story!");
        return true;
    }
    else
    {
        alert("News Story text cannot be left blank");
        return false;
    }
}

function resetForm()
{
    el("posttext").innerHTML = "";
}

function _el(elem)
{
    return document.getElementById(elem);
}

//On document load
$(document).ready(function() {
    
    $('.horrie-head').mouseOverSound('sound/horrie.wav');
    
    $('#right-bar').attachSearchBox($('#search-box'));
    
    $("#search-link").on('click', function() {
        console.log("clicked search");
        $('#search-box').slideRight($("#right-bar"));    
    });
    
    $('#searchform').on('submit', function(e) {
        e.preventDefault();
        if($('#searchquery').val().length > 0)
            this.submit();
        else
            $('#searchquery').focus();
    });
});