/*************************util.js*************************
*
Javascript utility functions for horrieinternational.com
*
*************************util.js*************************/

function promptDelete(filename, object, redirectUrl)
{
    if (confirm("Do you really want to delete this " + object.toString() + "?"))
    {
        window.location.assign(redirectUrl);
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
    var el = _el("overlay");
    el.style.visibility = "visible";
}

function hideOverlay()
{
    active = false;
    var el = _el("overlay");
    el.style.visibility = "hidden";
}

function showCloseButton()
{
    var el = _el("close-button");
    el.style.display = "block";
}

function hideCloseButton()
{
    var el = _el("close-button");
    el.style.display = "none";
}

function deleteWarning(postid)
{
    if(confirm("Are you sure you want to delete post: " + postid + "?"))
    {
        window.location.replace("newsadmin.php?deleteid=" + postid);
    }
}

function validateTextAreaInput(textAreaId, editing)
{
    var textArea = _el(textAreaId);
    if(CKEDITOR.instances.posttext.getData().length > 0)
    {
        if (editing) {
            alert("Updating news story!");        
        } else {
            alert("Creating new news story!");
        }

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
    _el("posttext").innerHTML = "";
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
        console.log("search box: " + Math.round($("#right-bar").position().left) + "px" + " right bar: " + Math.round($("#right-bar").position().left)); 
        var direction = $('#search-box').css("left") === parseInt($("#right-bar").position().left) + "px" ? "right" : "left";
        $('#search-box').fadeSlide($("#right-bar"), direction);    
    });
    
    $('#searchform').on('submit', function(e) {
        e.preventDefault();
        if($('#searchquery').val().length > 0)
            this.submit();
        else
            $('#searchquery').focus();
    });
});

$(window).resize(function () {
        $('#search-box').hide();
        $('#right-bar').attachSearchBox($('#search-box'));
        $('#search-box').resizeTo($('#right-bar'));
});
