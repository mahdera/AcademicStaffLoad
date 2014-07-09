<HTML>

<HEAD>
<TITLE>Chapter 12</TITLE>

<SCRIPT LANGUAGE="JavaScript">
<!-- HIDE FROM OTHER BROWSERS
//
//  Cookie Functions - Second Helping  (21-Jan-96) 
//  Written by:  Bill Dortch, hIdaho Design <bdortch@netw.com>
//  The following functions are released to the public domain.

//
// "Internal" function to return the decoded value of a cookie
//
function getCookieVal (offset) {
  var endstr = document.cookie.indexOf (";", offset);
  if (endstr == -1)
    endstr = document.cookie.length;
  return unescape(document.cookie.substring(offset, endstr));
}

//
//  Function to return the value of the cookie specified by "name".
//
function GetCookie (name) {
  var arg = name + "=";
  var alen = arg.length;
  var clen = document.cookie.length;
  var i = 0;
  while (i < clen) {
    var j = i + alen;
    if (document.cookie.substring(i, j) == arg)
      return getCookieVal (j);
    i = document.cookie.indexOf(" ", i) + 1;
    if (i == 0) break;
  }
  return null;
}

//
//  Function to create or update a cookie.
//
function SetCookie (name, value) {
  var argv = SetCookie.arguments;
  var argc = SetCookie.arguments.length;
  var expires = (argc > 2) ? argv[2] : null;
  var path = (argc > 3) ? argv[3] : null;
  var domain = (argc > 4) ? argv[4] : null;
  var secure = (argc > 5) ? argv[5] : false;
  document.cookie = name + "=" + escape (value) +
    ((expires == null) ? "" : ("; expires=" + expires.toGMTString())) +
    ((path == null) ? "" : ("; path=" + path)) +
    ((domain == null) ? "" : ("; domain=" + domain)) +
    ((secure == true) ? "; secure" : "");
}

//  Function to delete a cookie. (Sets expiration date to current date/time)
//    name - String object containing the cookie name
//
function DeleteCookie (name) {
  var exp = new Date();
  exp.setTime (exp.getTime() - 1);  // This cookie is history
  var cval = GetCookie (name);
  document.cookie = name + "=" + cval + "; expires=" + exp.toGMTString();
}

// END OF COOKIE FUncTIONS

// SEARch AND REPLACE FUncTIONS
//
// SET UP ARGUMENTS FOR FUncTION CALLS
//
var caseSensitive = true;
var notCaseSensitive = false;
var wholeWords = true;
var anySubstring = false;


// SEARch FOR A TERM IN A TARGET STRING
//
// search(targetString,searchTerm,caseSensitive,wordOrSubstring) 
//
// where caseSenstive is a boolean value and wordOrSubstring is a boolean
// value and true means whole words, false means substrings
//
function search(target,term,caseSens,wordOnly) {

  var ind = 0;
  var next = 0;

  if (!caseSens) {
    term = term.toLowerCase();
    target = target.toLowerCase();
  }

  while ((ind = target.indexOf(term,next)) >= 0) {
    if (wordOnly) {
      var before = ind - 1;
      var after = ind + term.length; 
      if (!(space(target.charAt(before)) && space(target.charAt(after)))) {
        next = ind + term.length; 
        continue;
      }
    }
    return true;
  }

  return false;

}

// SEARch FOR A TERM IN A TARGET STRING AND REPLACE IT
//
// replace(targetString,oldTerm,newTerm,caseSensitive,wordOrSubstring) 
//
// where caseSenstive is a boolean value and wordOrSubstring is a boolean
// value and true means whole words, false means substrings
//
function replace(target,oldTerm,newTerm,caseSens,wordOnly) {

  var work = target;
  var ind = 0;
  var next = 0;

  if (!caseSens) {
    oldTerm = oldTerm.toLowerCase();
    work = target.toLowerCase();
  }

  while ((ind = work.indexOf(oldTerm,next)) >= 0) {
    if (wordOnly) {
      var before = ind - 1;
      var after = ind + oldTerm.length; 
      if (!(space(work.charAt(before)) && space(work.charAt(after)))) {
        next = ind + oldTerm.length; 
        continue;
      }
    }
    target = target.substring(0,ind) + newTerm + 
    target.substring(ind+oldTerm.length,target.length);
work = work.substring(0,ind) + newTerm + 
work.substring(ind+oldTerm.length,work.length);
next = ind + newTerm.length;
    if (next >= work.length) { break; } 
  }

  return target;

}

// chECK IF A chARACTER IS A WORD BREAK AND RETURN A BOOLEAN VALUE 
//
function space(check) {

  var space = " .,/<>?!`';:@#$%^&*()=-|[]{}" + '"' + "\\\n\t";

  for (var i = 0; i < space.length; i++)
    if (check == space.charAt(i)) { return true; }

  if (check == "") { return true; }
  if (check == null) { return true; }

  return false;

}

// END OF SEARch AND REPLACE FUncTIONS

// MAIN BODY OF SCRIPT
//
// Set up global variables
//
var width = 8;
var height = 12;
var letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

// Set up Expiry Date for cookies
//
var expiryDate = new Date();
expiryDate.setTime(expiryDate.getTime() + 365*24*60*60*1000); 
var deleteExpiry = new Date();
deleteExpiry.setTime(deleteExpiry.getTime() - 1);

// Function to calculate the spreadsheet
//
function calculate(form) {

  var index = 0;
  var next = 0;
  var expField = "";
  var expression = "";
  var fieldList = GetCookie("fieldList"); 

  if (fieldList != null) {
    while (index != fieldList.length) {
      next = fieldList.indexOf(";",index); 
      expField = fieldList.substring(index,next); 
      expression = GetCookie(expField); 
      form[expField].value = evaluateExp(form,expression); 
      index = next + 1;
    }
  }

}

// Function to evaluate an expression
//


function evaluateExp(form,expression) {

  var column = "";
  var index = 0;
  var nextExpField;
  var nextExpression = "";
  var nextResult = "";

  if (expression.charAt(0) == '"') {
    return(expression.substring(1,expression.length)); 
  }

  // Scan the expression for field names
  for (var x = 0; x < width; x ++) {
    column = letters.charAt(x);
    index = 0;
    index = expression.indexOf(column,index); 

    // If we find a field name, evaluate it 
    while(index >= 0) {

      // Check if the field has an expression associated with it
      nextExpField = expression.substring(index,expression.indexOf(";",index)); 

      // If there is an expression, evaluate--otherwise grab the value of the    // field 
      if ((nextExpression = GetCookie(nextExpField)) != null) {
        nextResult = evaluateExp(form,nextExpression); 
      } else {
        nextResult = form[nextExpField].value; 
        if ((nextResult == "") || (nextResult == null))
          nextResult = "0";
      }

      // Replace the field name with the result
      nextExpField = nextExpField + ";";
      nextResult = "(" + nextResult + ")";
      expression = replace(expression,nextExpField,nextResult,notCaseSensitive,anySubstring); 
      // Check if we have reached the end of the expression
      index = index + nextResult.length; 
      if (index >= expression.length - 1) { break; }

      // If not, search for another field name
      index = expression.indexOf(column,index); 
    }
  }

  // Evaluate the expression
  with (Math) {
    var result = eval(expression);
  }

  // Return the result
  return result;

}

// Function to save an expression
//
function saveExp(form) {

  var expField = form.expField.value;
  var fieldList = GetCookie("fieldList"); 
  var numExp = GetCookie("numExpressions"); 

  // Check the number of saved expressions
  if (numExp == "18") {
    alert("Too many expressions. Delete One first");
  } else {

    if (!checkExp(form.expression.value,expField + ";")) { return }

    // If there is room, save the expression and 
   Âupdate the number of expressions
SetCookie(form.expField.value,form.expression.value,expiryDate); 
    numExp = parseInt(numExp) + 1;
    SetCookie("numExpressions",numExp,expiryDate); 
    expField += ";"
    if (fieldList == null) {
      fieldList = expField;
    } else {
      fieldList = replace(fieldList,expField,"",notCaseSensitive,anySubstring); 
      fieldList += expField;
    }
    SetCookie("fieldList",fieldList,expiryDate); 

    // Recalculate the spreadsheet
    calculate(document.spreadsheet);

    alert("Expession for field " + form.expField.value + " is saved.");

  }

}

// Function to delete an expression
//
function deleteExp(form) {

  var fieldList = GetCookie("fieldList"); 
  var expField = form.expField.value;
  var numExp = GetCookie("numExpressions"); 
  var expression = GetCookie(form.expField.value);

  // Check if there is an expression to delete for the field
  if (expression != null) {

    // There is, so set the expiry date
    SetCookie(form.expField.value,"",deleteExpiry); 
    numExp = parseInt(numExp) - 1;
    SetCookie("numExpressions",numExp,expiryDate); 
    expField += ";";
    fieldList = replace(fieldList,expField,"",notCaseSensitive,anySubstring); 
    SetCookie("fieldList",fieldList,expiryDate); 

    // Update the field and recalculate the spreadsheet
    document.spreadsheet[form.expField.value].value = "";
    calculate(document.spreadsheet);

    alert("Expession for field " + form.expField.value + " is removed.");

  }

}

// Function to build form
//
function buildForm() {

  var numExp = 0;

  // Check if this is a new spreadsheet. If it is, 
    set the number of expressions to zero
if ((numExp = GetCookie("numExpressions")) == null) {
    SetCookie("numExpressions",0,expiryDate); 
  }

  // Build row header
  document.write("<TR><TD></TD>"); 
  for (var x = 0; x < width; x++) {
    document.write("<TD><DIV ALIGN=CENTER>" + 
        letters.charAt(x) + "</DIV></TD>");
}
  document.write("</TR>");

  // Build each field -- each is the same, with a different name
  for (var y = 1; y <= height; y++) {
    document.write("<TR><TD>" + y + "</TD>");
    for (var x = 0; x < width; x++) {
      document.write('<TD><INPUT TYPE=text SIZE=10 NAME="' + 
        letters.charAt(x) + y + '" onChange="calculate(this.form);"></TD>'); 
}
    document.write("</TR>"); 
  }

}


// Function check expressions
//

function checkExp(expression,expField) {

  var index =0;
  var next = 0;
  var checkNum = 0;
  var otherExpField = ""
  var otherExp = "";
  var lowerColumn = ""

  if (expression.charAt(0) == '"') { return true; }

  for (var x = 0; x < width; x++) {
    index =0;
    column = letters.charAt(x);
    lowerColumn = column.toLowerCase();

    // Check for field in this column
    index = expression.indexOf(column,0); 
    if (index < 0) {
      index = expression.indexOf(lowerColumn,0); 
    }

    // If we have a reference to this column, check the syntax
    while (index >= 0) {

      next = index + 1;

      // Check if letter is followed by a number, if not assume it is a Math    // method 
      checkNum = parseInt(expression.charAt(next)); 
      if ((checkNum == 0) && (expression.charAt(next) != "0") && (expression.charAt(index) == lowerColumn)) {
        if (next + 1 == expression.length) { break; }
        index = expression.indexOf(column,next+1); 
        if (index < 0) {
          index = expression.indexOf(lowerColumn,next+1);
        }
        continue;
      }

      // It is not a Math method so check that the letter was uppercase
      if (expression.charAt(index) == lowerColumn) {
        alert("Field names must use uppercase letters.");
        return false; 
      }

      // The letter was uppercase, so check that we have only numbers followed    // by a semicolon
      while(expression.charAt(++next) != ";") {
        checkNum = parseInt(expression.charAt(next)); 
        if ((checkNum == 0) && (expression.charAt(next) != "0")) { 
          alert("Field name format is incorrect (should be like A12; or B9;)."); 
          return false;
        }
        if (next == expression.length - 1) {
          alert("Field name format is incorrect (should be like A12; or B9;)."); 
          return false;
        }
      }

      otherExpField = expression.substring(index,next); 

      // Check for a circular expression 
      otherExp = GetCookie(otherExpField); 
      if (otherExp != null) {
        if (search(otherExp,expField,caseSensitive,anySubstring)) {
          alert("You have created a circular expression with field " +                 ÂotherExpField + ".");
          return false;
        }
      }

      if (next + 1 == expression.length) { break; }

      index = expression.indexOf(column,next+1); 
      if (index < 0) {
        index = expression.indexOf(lowerColumn,next+1); 
      }

    }

  }

  return true;

}

// STOP HIDING -->
</SCRIPT>

</HEAD>

<BODY BGCOLOR="iceblue">

<CENTER>

<FORM METHOD=POST NAME="spreadsheet">
<TABLE BORDER=0>

<SCRIPT LANGUAGE="JavaScript">
<!-- HIDE FROM OTHER BROWSERS

buildForm();

// STOP HIDING -->
</SCRIPT>

</TABLE>
</FORM>
<HR>

<FORM METHOD=POST>
<TABLE BORDER=1>

<TR>
<TD><DIV ALIGN=CENTER>Field Name</DIV></TD> 
<TD><DIV ALIGN=CENTER>Expression</DIV></TD> 
</TR>

<TR>
<TD><DIV ALIGN=CENTER><INPUT TYPE=text SIZE=10 NAME="expField"
   onChange="var exp = GetCookie(this.value); this.form.expression.value = 
  (exp == null) ? '' : exp;"></DIV></TD>
<TD><DIV ALIGN=CENTER><INPUT TYPE=text SIZE=50 NAME="expression"></DIV></TD>
<TD><DIV ALIGN=CENTER><INPUT TYPE=button VALUE="Apply" 
onClick="saveExp(this.form);"></DIV></TD> 
<TD><DIV ALIGN=CENTER><INPUT TYPE=button VALUE="Delete" 
onClick="deleteExp(this.form);"></DIV></TD> 
</TR>

</TABLE>
</FORM>
</CENTER>

</BODY>

</HTML>