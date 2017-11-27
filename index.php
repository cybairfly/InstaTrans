<html>
<head>

<script type="text/javascript" src="http://www.google.com/jsapi">
</script>
<script type="text/javascript">
  google.load("language", "1");
</script>

<script language="javascript">

function watchTextAreas(isKeyPress) {
	if(!isKeyPress) {

		var box = document.createElement('div');
		box.setAttribute('id', 'overlay-box');
		box.setAttribute('style', 'overflow: hidden; position: absolute; bottom: 0px; right: 0px; padding: 10px; width: auto; font-family: arial; font-size: 50px; text-align: right; color: orange; background: black;');
		document.body.appendChild(box);

		var allTextAreas = "";
		for (var i=0; allTextAreas[i] != "undefined"; i++) {
			var allTextAreas = document.getElementsByTagName('textarea')[i];
			if (allTextAreas[i] != "undefined") {
				allTextAreas.setAttribute('onKeyUp', 'watchTextAreas(1);');
				allTextAreas.setAttribute('onFocus', 'this.style="background:orange;"');
				allTextAreas.setAttribute('onBlur', 'this.style="background:silver;"');
			}
		}
	}

	else {

		var aE = document.activeElement;
		var CaretPos = 0;

		if (aE == "[object HTMLTextAreaElement]") {
			// IE Support***************************************************************************************
			if (document.selection) {
				aE.focus ();
				var Sel = document.selection.createRange ();
				Sel.moveStart ('character', -aE.value.length);
				CaretPos = Sel.text.length;
			}
			//**************************************************************************************************
			// Firefox support
			else if (aE.selectionStart || aE.selectionStart == '0' || aE.selectionStart == '-1') {

					origin = aE.selectionStart; // 1
					CaretPos = origin; // 1

					var currentStart = CaretPos - 1; // 0
					var currentEnd = CaretPos; // 1
					var chunk = "";
					
			do {
		//			var len = textarea.value.length;
					//get selection contents
					var sel = aE.value.substring(currentStart, currentEnd); //W

		//			alert(sel + "  currentStart: " + currentStart + "  currentEnd: " + currentEnd);

					currentStart--; // -2
					currentEnd--; // -1

					var chunk = sel + chunk;
		//			alert (activeElement);

				} while (sel != " " && sel !="");
			// -1 + 1 = 0
			var wordStart = currentEnd + 1;
			
					var currentStart = wordStart; // 0
					var currentEnd = wordStart + 1; // 1
			
			do {
		//			var len = textarea.value.length;
					//get selection contents
					var sel = aE.value.substring(currentStart, currentEnd); // W

		//			alert(sel + "  currentStart: " + currentStart + "  currentEnd: " + currentEnd);			

					currentStart++; // 2
					currentEnd++; // 3
				
				} while (sel != " " && sel != "");
			
		//	alert (CaretPos);
			
			var wordEnd = currentStart;
			
		//	alert ('wordEnd: ' + wordEnd);
			
			var word = aE.value.substring(wordStart, wordEnd);
			
			var textarea2 = document.getElementById('textarea2');
			textarea2.value = chunk;
			
			google.language.translate(word, "", "en", function(result) {
				if (!result.error) {
					var overlayBox = document.getElementById("overlay-box");
					overlayBox.innerHTML = result.translation;
					google.language.getBranding("overlay-box");
				}
			});
			
//			var overlayBox = document.getElementById('overlay-box');
	//		overlayBox.innerHTML = word;

	//		return (word);
			}
		}
	}
}









function setCaretPosition(aE, pos, pos2){
	if(aE.setSelectionRange)
	{
		aE.focus();
		aE.setSelectionRange(pos,pos2);
	}
	else if (aE.createTextRange) {
		var range = aE.createTextRange();
		range.collapse(true);
		range.moveEnd('character', pos);
		range.moveStart('character', pos);
		range.select();
	}
}

function blah() { alert('hi'); }

function display() {
	var textarea = document.getElementById("textarea");

	var len = textarea.value.length;
	var start = textarea.selectionStart;
	var end = textarea.selectionEnd;
	var sel = textarea.value.substring(start, end);

   // This is the selected text and alert it
	alert(sel);
}
</script>
		</head>

<body onload="watchTextAreas();">
<div id="wrap">
		<textarea cols="40" rows="40" id="textarea">
“Perfection is reached not when there is nothing more to add, but when there is nothing more to subtract.” ~ Antoine de Saint-Exupéry
		</textarea>
		<textarea cols="40" rows="40">0</textarea>
		<textarea cols="40" rows="40">0</textarea>
		<textarea cols="40" rows="40" id="textarea2">0</textarea>
        <input type="button" value="Use Ranges"  /> 
		<input type="button" value="Set Ranges" onclick="display();" /> 
	</form>
</div>
</body>
</html>






<!--

<html>
<head>
<script language="javascript">
<!-- //Begin Hide
function checkMessage(myForm) {
if (/[\"\'\/\\]/.test(myForm.charcount.value)){
alert("Invalid Message! This message included invalid characters.")
return (false)
}
return (true)
}

function countit(what){
formcontent=what.form.charcount.value
displaycount.innerHTML=formcontent.length
}

function storeCaret(textE1) {
if (textE1.createTextRange) 
textE1.caretPos = document.selection.createRange().duplicate();
displaycount.innerHTML= texte1.caretPos
}

</script>
</HEAD>
<BODY>
<form onSubmit="return checkMessage(this)">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="100%" colspan="2">
<textarea rows="12" name="charcount" onkeyup="return countit(this)" cols="60" wrap="virtual" onclick="storeCaret(this);"></textarea>
</td>
</tr>
<tr>
<td valign="top" width="35%">Current Character Position:</td>
<td><div id="displaycount" size="20">&nbsp;&nbsp;</div></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td align=left><input type="submit" value="Submit" id=submit1 name=submit1>
&nbsp;<input type="reset" value="Reset" id=reset1 name=reset1></td>
</tr>
</table>
</form>
</body>
</html-->