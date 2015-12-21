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
            
            //console.log("start xy: (" + startX + ", " + startY + ")");
            //console.log("end xy: (" + endX + ", " + endY + ")");
            
            var id = setInterval(function()
            {
                    if(startX < endX)
                    {
                            if((curX + movDistX) > endX)
                            {
                                    curX = endX;
                            }
                            else
                            {
                                    curX += movDistX;
                            }
                    }
                    else if(startX > endX)
                    {
                            if((curX - movDistX) < endX)
                            {
                                    curX = endX;
                            }
                            else
                            {
                                    curX -= movDistX;
                            }				
                    }
                            
                    if(startY < endY)
                    {
                            if((curY + movDistY) > endY)
                            {
                                    curY = endY;
                            }
                            else
                            {
                                    curY += movDistY;
                            }
                    }
                    else if(startY > endY)
                    {
                            if((curY - movDistY) < endY)
                            {
                                    curY = endY;
                            }
                            else
                            {
                                    curY -= movDistY;
                            }				
                    }
                    
                    if (curX == endX && curY == endY)
                    {
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

/**
 * centerDialog(): Centers the dialog div on the screen
 * @access  public
 * @param   String dialogId		The id of our status update dialog div
 * @return  void
 */
function centerDialog(dialogId)
{
    var dlgDiv = document.getElementById(dialogId);

    if(dlgDiv)
    {
        dlgDiv.style.left = ((window.innerWidth / 2) - (dlgDiv.offsetWidth / 2)) + "px";
        dlgDiv.style.top = ((window.innerHeight / 2) - (dlgDiv.offsetHeight)) + "px";
    }
    else
    {
        console.error("Could not obtain dialog div");
    }
}

function selectSearchWords(searchStr)
{
    var el = document.getElementById('main');
    
    if(el)
    {
        replaceKeywords(el, searchStr);
    }
}

/**
 * replaceKeywords(): Finds all instances of "keyword" in the DOM and highlights them.
 * replaceKeywords starts at the node "domNode" and recurses through its subtree searching
 * for nodes of type TEXT_NODE that contain one or more instances of the string "keyword."
 * The TEXT_NODE is then replaced by at least 3 divs. One containing the original text to the left
 * of the keyword, one containing the keyword (with highlighting CSS style), and one containing
 * the original text to the right of the keyword. Should the keyword appear more than once in the text,
 * the aforementioned process will start from the left of the string, appending 2 divs at a time (one
 * for the text to the left, and one for the keyword, and then finally append the final right div).
 * All of these divs are appended to "newNode" which is then appended to the parent of the TEXT_NODE
 * in which "keyword" was found. Finally"domNode" (said TEXT_NODE) is removed from the parent node,
 * completing the switcharoo. 
 * @access  public
 * @param   {DOM object} domNode
 * @param   {String} keyword
 * @return  void
 */
function replaceKeywords(domNode, keyword)
{
    //If domNode is an ELEMENT_NODE it can contain TEXT_NODE or other ELEMENT_NODE children.
    //Otherwise it must be a TEXT_NODE and we will search through the text
    if(domNode.nodeType === Node.ELEMENT_NODE)
    {
        var children = domNode.childNodes;
        for(var i=0; i < children.length; i++)
        {
            var child = children[i];

            replaceKeywords(child, keyword);
        }
    }
    else if (domNode.nodeType === Node.TEXT_NODE)
    {
            // Process text nodes
            var text = domNode.nodeValue;
            var match = text.indexOf(keyword);
            var parent = domNode.parentNode;
            var newNode = document.createElement('div');
            newNode.className = "nohighlight";
            
            //If keyword occurs at least once
            if(match != -1)
            {
                    var left = "";
                    var right = "";
                    
                    //for all occurrences of "keyword" build up a string: <div class=nohighlight>left</div><div class=highlight>keyword</div> ...
                    while(match != -1)
                    {
                            //store all the text to the left and right of the keyword
                            left = text.substr(0, match);
                            right = text.substr(match + keyword.length);
                            
                            //This might happen if we come across malformed HTML
                            if (parent == null)
                            {
                                    console.log("ERROR: +++PARENT WAS NULL!+++");
                                    match = -1;
                                    continue;
                            }
                            
                            //Create left and keyword div nodes and add style
                            var leftNode = document.createElement('div');
                            var keywordNode = document.createElement('div');
                            leftNode.className = "nohighlight";
                            keywordNode.className = "highlight rounded";
                            
                            //create text node for text left of keyword, add it to left div, add left div to newNode
                            var leftNodeText = document.createTextNode(left);
                            leftNode.appendChild(leftNodeText);
                            newNode.appendChild(leftNode);
                            
                            //create text node for the keyword, add it to keyword div, add keyword div to newNode
                            var content = document.createTextNode(keyword);
                            keywordNode.appendChild(content);
                            newNode.appendChild(keywordNode);
                            
                            //start searching from the beginning of the remaining text to the right of the keyword
                            text = right;
                            match = text.indexOf(keyword);
                    }
                    
                    //Finish the string with ... <div class=nohighlight>right</div>
                    //Create right div node
                    var rightNode = document.createElement('div');
                    rightNode.className = "nohighlight";
                    
                    //Create text node for the right div node and add div to newNode
                    var rightNodeText = document.createTextNode(right);
                    rightNode.appendChild(rightNodeText);
                    newNode.appendChild(rightNode);
    
                    //Add newNode 
                    parent.insertBefore(newNode, domNode);
                    parent.removeChild(domNode);
                    parent.scrollIntoView();
            }
    }
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
$(document).ready(function()
{
    $('#searchform').on('submit', function(e)
    {
        e.preventDefault();
        if($('#searchquery').val().length > 0)
            this.submit();
        else
            $('#searchquery').focus();
    });
});