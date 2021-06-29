
function addCss(params) {
    var httpc = new XMLHttpRequest(); // simplified for clarity
    var url = "/views/editor/api_update_css.php";
    httpc.open("POST", url, true); // sending as POST

    httpc.onreadystatechange = function() { //Call a function when the state changes.
        if(httpc.readyState == 4 && httpc.status == 200) { // complete and no errors
            alert(httpc.responseText); // some processing here, or whatever you want to do with the response
        }
    };
    httpc.send(params);
}

function openProperties(e){
	console.log(e.innerHTML);
}

// drag and drop js

function allowDrop(ev) {
  ev.preventDefault();
}

function drag(ev) {
  console.log("DRAG=" + ev.target);
  console.log("DRAG=" + ev.target.id);
  ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
  console.log("DROP=" + ev.target.outerHTML);
  ev.preventDefault();
  var data = ev.dataTransfer.getData("text");
  console.log("DROPING=" + document.getElementById(data));
  console.log("DROPING=" + document.getElementById(data).id);
  var div_id = document.getElementById(data).id.substring(5);
  console.log("ID=" + div_id);
  console.log("MAIN ELEMENT=" + document.getElementById("perm-"+div_id).outerHTML);
  var clone = document.getElementById("perm-"+div_id).cloneNode(true);
  clone.style.display = "block";
  clone.id="div_id";
  ev.target.appendChild(clone);
}


function setRowAlignment(align){
	$('[class*="col"]').css('text-align', align);
}

function onClickRow(e){
	console.log(e);
	console.log(e.id);
	console.log($(e).attr("class"));
	console.log(e.children);
	insertAtCursor(e.outerHTML);
}


// content editable js 

var imported = document.createElement('script');
imported.src = '/js/tidy.js';
document.head.appendChild(imported);


options = {
  "indent":"auto",
  "indent-spaces":2,
  "wrap":120,
  "markup":true,
  "output-xml":false,
  "numeric-entities":true,
  "quote-marks":true,
  "quote-nbsp":false,
  "show-body-only":true,
  "quote-ampersand":false,
  "break-before-br":true,
  "uppercase-tags":false,
  "uppercase-attributes":false,
  "drop-font-tags":false,
  "tidy-mark":false
}

// GLOBAL 
var currentImage;
var oDoc = null;
var sDefTxt = null;
var isHTML = true;

function initDoc() {
    oDoc = document.getElementById("htmlEditorPane");
    sDefTxt = oDoc.innerHTML;
    if (document.nodeform.switchMode.checked) {
        setDocMode(true);
        isHTML = true;
    }
}

function formatDoc(sCmd, sValue) {
    console.log("Command = " + sCmd + " value=" + sValue);
    if (validateMode()) {
        if (sCmd == "formatBlock"){
            document.execCommand(sCmd, false, sValue);
        }
        else if (sCmd == "createlink"){
            if (sValue == ""){
            	//remove link
            	document.execCommand("unlink", false, false);
        	}
        	else {
        		document.execCommand(sCmd, false, sValue);
        	}
        }
        else {
            document.execCommand(sCmd, false, sValue);
        }
        oDoc.focus();
    }
}


function validateMode() {
    if (!document.nodeform.switchMode.checked) {
        return true;
    }
    alert("Uncheck \"HTML\".");
    oDoc.focus();
    return false;
}

function setDocMode(showHTML) {
    console.log("-----------------");
    if (oDoc == null) {
        console.log("oDoc is NULL !!");
        oDoc = document.getElementById("htmlEditorPane");
    }
    //console.log("setDocMode" + showHTML);
    //console.log("doc inner html" + tidy_html5(oDoc.innerHTML, options));
    var oContent;
    if (showHTML) {
        oContent = document.createTextNode(tidy_html5(oDoc.innerHTML, options));
        oDoc.innerHTML = "";
        var oPre = document.createElement("pre");
        oDoc.contentEditable = false;
        isHTML = false;
        oPre.id = "sourceText";
        oPre.contentEditable = true;
        oPre.appendChild(oContent);
        oDoc.appendChild(oPre);
        document.execCommand("defaultParagraphSeparator", false, "div");
        //console.log("HTML text=" + oPre.innerHTML);
    	oDoc.focus();
    } else {
        if (document.all) {
            oDoc.innerHTML = oDoc.innerText;
            console.log("Doc All Text=" + oDoc.innerHTML);
        } else {
            console.log("Doc TExt" + oDoc.innerHTML);
            oContent = document.createRange();
            oContent.selectNodeContents(oDoc.firstChild);
            oDoc.innerHTML = oContent.toString();
            //console.log("Rendered=" + oDoc.innerHTML);
        }
        oDoc.contentEditable = true;
        isHTML = true;
    	oDoc.focus();
    }
}


function insertAtCursor(text) {
    console.log("isHTML" + isHTML);
    if (isHTML) {
        insertHtmlAtCursor(text, true);
    }
    else {
        insertTextAtCursor(text);
    }
}

function insertTextAtCursor(text) {
    let selection = window.getSelection();
    let range = selection.getRangeAt(0);
    range.deleteContents();
    let node = document.createTextNode(text);
    range.insertNode(node);

    for (let position = 0; position != text.length; position++) {
        selection.modify("move", "right", "character");
    };
}
function insertHtmlAtCursor(html, selectPastedContent) {
    var sel, range;
    if (window.getSelection) {
        // IE9 and non-IE
        sel = window.getSelection();
        if (sel.getRangeAt && sel.rangeCount) {
            range = sel.getRangeAt(0);
            range.deleteContents();

            // Range.createContextualFragment() would be useful here but is
            // only relatively recently standardized and is not supported in
            // some browsers (IE9, for one)
            var el = document.createElement("div");
            el.innerHTML = html;
            var frag = document.createDocumentFragment(), node, lastNode;
            while ((node = el.firstChild)) {
                lastNode = frag.appendChild(node);
            }
            var firstNode = frag.firstChild;
            range.insertNode(frag);

            // Preserve the selection
            if (lastNode) {
                range = range.cloneRange();
                range.setStartAfter(lastNode);
                if (selectPastedContent) {
                    range.setStartBefore(firstNode);
                } else {
                    range.collapse(true);
                }
                sel.removeAllRanges();
                sel.addRange(range);
            }
        }
    } else if ((sel = document.selection) && sel.type != "Control") {
        // IE < 9
        var originalRange = sel.createRange();
        originalRange.collapse(true);
        sel.createRange().pasteHTML(html);
        if (selectPastedContent) {
            range = sel.createRange();
            range.setEndPoint("StartToStart", originalRange);
            range.select();
        }
    }
}

function insertImageAtCursor(src, selectPastedContent) {
	if (currentImage != null ){
    	currentImage.src = src;
	}
	else {
		var img = '<img class="img-fluid" src="' + src + '">';
		insertAtCursor(img);
	}
}

$("#htmlEditorPane").on("DOMNodeInserted", $.proxy(function(e) {
    console.log("Dom inserted");
    if (e.target.parentNode.getAttribute("contenteditable") === "true") {
        var newTextNode = document.createTextNode("");
        function antiChrome(node) {
            if (node.nodeType == 3) {
                newTextNode.nodeValue += node.nodeValue.replace(/(\r\n|\n|\r)/gm, "")
            }
            else if (node.nodeType == 1 && node.childNodes) {
                for (var i = 0; i < node.childNodes.length; ++i) {
                    antiChrome(node.childNodes[i]);
                }
            }
        }
        antiChrome(e.target);
        console.log(e.target);
        e.target.parentNode.replaceChild(newTextNode, e.target);
    }
}, this));


var texttags = [ 'H1', 'H2', 'H3', 'H4', 'H5', 'H6', 'H7', 'P' ];

$('#htmlEditorPane').keydown(function(e) {
    // trap the return key being pressed
    if (e.keyCode === 13) {
        console.log("Return pressed.." + e.keyCode);
        //console.log(e.target.innerHTML);
        var selection = window.getSelection();
          var range = selection.getRangeAt(0);
          var container = range.commonAncestorContainer;
          var nodeParent = container.parentNode;
          console.log("tageName=" + nodeParent.tagName);
          if (texttags.includes(nodeParent.tagName)){
              console.log("Text tag");
          	   e.preventDefault();
              insertAtCursor("<br/><br/>");
              document.getSelection().collapseToEnd();
          }

        //
        // insert 2 br tags (if only one br tag is inserted the cursor won't go to the next line)
        //if you are in a column then insert at sursor
        //insertAtCursor("<br/><br/>");
        //document.getSelection().collapseToEnd();
        //else insert deafult
        //document.execCommand('insertHTML', false, '<br><br>');
        // prevent the default behaviour of return key pressed
    }
});

// image editor

var editorScrollTop = 0;
var editorScrollLeft = 0;

function setScrollPosition(){
    var elmnt = document.getElementById("htmlEditorPane");
    editorScrollLeft = elmnt.scrollLeft;
    editorScrollTop = elmnt.scrollTop;
}

function enableImageResizeInDiv(id) { // id = htmlEditorPane
    var resizing = false;
    var editor = document.getElementById(id);
    var editorRect = editor.getBoundingClientRect();
    
        
    var createDOM = function (elementType, className, styles) {
        let ele = document.createElement(elementType);
        ele.className = className;
        setStyle(ele, styles);
        return ele;
    };
    var setStyle = function (ele, styles) {
        for (key in styles) {
            ele.style[key] = styles[key];
        }
        return ele;
    };
    var removeResizeFrame = function () {
        document.querySelectorAll(".resize-frame,.resizer").forEach((item) => item.parentNode.removeChild(item));
    };
    var offset = function offset(el) {
        const rect = el.getBoundingClientRect(),
        scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
        scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        return { top: rect.top + scrollTop, left: rect.left + scrollLeft }
    };
    var clickImage = function (img) {
        removeResizeFrame();
        currentImage = img;
        
        var imgRect = img.getBoundingClientRect(); //left, top, right, bottom, x, y, width, and height
        var imgHeight = imgRect.height;
        var imgWidth = imgRect.width;

        var top = imgRect.top  - editorRect.top + editorScrollTop;
        var left = imgRect.left  - editorRect.left + editorScrollLeft;

        console.log("click top=" + top + " left " + left);
        console.log("Editor top=" + editorScrollTop + " left " + editorScrollLeft);


        editor.append(createDOM('span', 'resize-frame', {
            margin: '10px',
            position: 'absolute',
            top: (top + imgHeight - 20) + 'px',
            left: (left + imgWidth - 20) + 'px',
            border: 'solid 3px red',
            width: '10px',
            height: '10px',
            cursor: 'se-resize',
            zIndex: 1
        }));

        editor.append(createDOM('span', 'resizer top-border', {
            position: 'absolute',
            top: (top + 10) + 'px',
            left: (left + 10) + 'px',
            border: 'dashed 1px grey',
            width: (imgWidth - 10 )+ 'px',
            height: '0px'
        }));

        editor.append(createDOM('span', 'resizer left-border', {
            position: 'absolute',
            top: (top + 10) + 'px',
            left: (left + 10) + 'px',
            border: 'dashed 1px grey',
            width: '0px',
            height: (imgHeight - 10) + 'px'
        }));

        editor.append(createDOM('span', 'resizer right-border', {
            position: 'absolute',
            top: (top - 10) + 'px',
            left: (left + imgWidth - 10) + 'px',
            border: 'dashed 1px grey',
            width: '0px',
            height: (imgHeight-10) + 'px'
        }));

        editor.append(createDOM('span', 'resizer bottom-border', {
            position: 'absolute',
            top: (top + imgHeight - 10) + 'px',
            left: (left - 10) + 'px',
            border: 'dashed 1px grey',
            width: (imgWidth-10) + 'px',
            height: '0px'
        }));

        document.querySelector('.resize-frame').onmousedown = () => {
            resizing = true;
            return false;
        };
        window.onresize = function(){
            editorRect = editor.getBoundingClientRect();
            refresh();
            currentImage.click();
        };
        editor.onmouseup = () => {
    		//console.log("onmouseup ");
            if (resizing) {
                currentImage.style.width = document.querySelector('.top-border').offsetWidth + 'px';
                currentImage.style.height = document.querySelector('.left-border').offsetHeight + 'px';
                refresh();
                currentImage.click();
                resizing = false;
                return false;
            }
            return true;
        };

        editor.onmousemove = (e) => {
    		//console.log("onmousemove ");
            if (currentImage && resizing) {
                let height = e.pageY - offset(currentImage).top;
                let width = e.pageX - offset(currentImage).left;
                height = height < 1 ? 10 : height;
                width = width < 1 ? 10 : width;

                var imgRect = img.getBoundingClientRect();

                const top = imgRect.top  - editorRect.top + editorScrollTop;
                const left = imgRect.left  - editorRect.left + editorScrollLeft;

                console.log("mouse modeve top=" + top + " left " + left);
                setStyle(document.querySelector('.resize-frame'), {
                    top: (top + height - 10) + 'px',
                    left: (left + width - 10) + "px"
                });

                setStyle(document.querySelector('.top-border'), { width: width + "px" });
                setStyle(document.querySelector('.left-border'), { height: height + "px" });
                setStyle(document.querySelector('.right-border'), {
                    left: (left + width) + 'px',
                    height: height + "px"
                });
                setStyle(document.querySelector('.bottom-border'), {
                    top: (top + height) + 'px',
                    width: width + "px"
                });
            return false;
            }
            return true;
        };
    };
    var bindClickListener = function () {
        editor.querySelectorAll('img').forEach((img, i) => {
            img.onclick = (e) => {
                if (e.target === img) {
                    clickImage(img);
                }
            };
        });
    };
    var refresh = function () {
        bindClickListener();
        removeResizeFrame();
        if (!currentImage) {
            return;
        }
        var img = currentImage;
        var imgHeight = img.offsetHeight;
        var imgWidth = img.offsetWidth;

        var imgRect = img.getBoundingClientRect();

        const top = imgRect.top  - editorRect.top + editorScrollTop;
        const left = imgRect.left  - editorRect.left + editorScrollLeft;
        console.log("refersh top=" + top + " left " + left);

        editor.append(createDOM('span', 'resize-frame', {
            position: 'absolute',
            top: (top + imgHeight) + 'px',
            left: (left + imgWidth) + 'px',
            border: 'solid 2px red',
            width: '6px',
            height: '6px',
            cursor: 'se-resize',
            zIndex: 1
        }));

        editor.append(createDOM('span', 'resizer', {
            position: 'absolute',
            top: (top) + 'px',
            left: (left) + 'px',
            border: 'dashed 1px grey',
            width: imgWidth + 'px',
            height: '0px'
        }));

        editor.append(createDOM('span', 'resizer', {
            position: 'absolute',
            top: (top) + 'px',
            left: (left + imgWidth) + 'px',
            border: 'dashed 1px grey',
            width: '0px',
            height: imgHeight + 'px'
        }));

        editor.append(createDOM('span', 'resizer', {
            position: 'absolute',
            top: (top + imgHeight) + 'px',
            left: (left) + 'px',
            border: 'dashed 1px grey',
            width: imgWidth + 'px',
            height: '0px'
        }));
    };
    var reset = function () {
        if (currentImage != null) {
            currentImage = null;
            resizing = false;
            removeResizeFrame();
        }
        bindClickListener();
    };
    editor.addEventListener('scroll', function () {
        reset();
    }, false);
    editor.addEventListener('mouseup', function (e) {
        if (!resizing) {
            const x = (e.x) ? e.x : e.clientX;
            const y = (e.y) ? e.y : e.clientY;
            let mouseUpElement = document.elementFromPoint(x, y);
            if (mouseUpElement) {
                let matchingElement = null;
                if (mouseUpElement.tagName === 'IMG') {
                    matchingElement = mouseUpElement;
                }
                if (!matchingElement) {
                    reset();
                } else {
                    clickImage(matchingElement);
                }
            }
        }
    });
}