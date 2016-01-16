SearchTextHighlighter = function() {
    
    this.selectSearchWords = function(searchStr)
    {
        var el = document.getElementById('main');
        
        if(el) {
            replaceKeywords(el, searchStr);
        }
    },

    /**
     * replaceKeywords(): Finds all instances of "keyword" in the DOM and highlights them.
     * replaceKeywords starts at the node "domNode" and recurses through its subtree searching
     * for nodes of type TEXT_NODE that contain one or more instances of the string "keyword."
     * The TEXT_NODE is then replaced by at least 3 divs. One containing the text to the left
     * of the keyword, one containing the keyword itself (with highlighting CSS style), and one containing
     * the text to the right of the keyword. Should the keyword appear more than once in the text,
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
    this.replaceKeywords = function(domNode, keyword)
    {
        //If domNode is an ELEMENT_NODE it can contain TEXT_NODE or other ELEMENT_NODE children.
        //Otherwise it must be a TEXT_NODE and we will search through the text
        if(domNode.nodeType === Node.ELEMENT_NODE) {
            var children = domNode.childNodes;
            for(var i=0; i < children.length; i++) {
                var child = children[i];
                replaceKeywords(child, keyword);
            }
        }
        else if (domNode.nodeType === Node.TEXT_NODE) {
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
                    if (parent == null) {
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
    },
    
     this.activateSearch = function()
    {
        if(!searchActive) {
            showOverlay();
            moveDiv('searchbox', getStartCoords(), getCenterCoords('searchbox'));
            showCloseButton();
            searchActive = true;
            playSound("../sounds/bwip.mp3");
        }
    }

    this. deactivateSearch = function() {
        if(searchActive) {
            hideOverlay();
            moveDiv('searchbox', getCurrentCoords('searchbox'), getStartCoords());
            hideCloseButton();
            searchActive = false;
            playSound("../sounds/bwip.mp3");
        }
    }
}