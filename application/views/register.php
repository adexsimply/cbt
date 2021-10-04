<!DOCTYPE html>
<html>
<head>
<title>CSMT</title>

<style>
* {
  box-sizing: border-box;
}

body {
  font: 16px Arial;  
}

/*the container must be positioned relative:*/
.autocomplete {
  position: relative;
  display: inline-block;
}

input {
  border: 1px solid transparent;
  background-color: #f1f1f1;
 // padding: 10px;
 // font-size: 16px;
}

input[type=text] {
  background-color: #f1f1f1;
  width: 100%;
}

input[type=submit] {
  background-color: DodgerBlue;
  color: #fff;
  cursor: pointer;
}

.autocomplete-items {
  margin-top:-40px;
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}

.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff; 
  border-bottom: 1px solid #d4d4d4; 
}

/*when hovering an item:*/
.autocomplete-items div:hover {
  background-color: #e9e9e9; 
}

/*when navigating through the items using the arrow keys:*/
.autocomplete-active {
  background-color: DodgerBlue !important; 
  color: #ffffff; 
}
</style>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Meta tag Keywords -->
<link href="<?php echo base_url(); ?>assets/css/old/style.css" rel="stylesheet" type="text/css" media="all"/><!--stylesheet-css-->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/old/font-awesome.css"><!--fontawesome-->
    <style>
    .others{
	font-size: 16px;
    font-weight: 500;
    text-align: left;
    letter-spacing: 1px;
    float: left;
    width: 85%;
    height:43px;
    margin: 0 auto 3em;
    padding: 0.1em 10px;
    line-height: 40px;
    outline: none;
    border: none;
    box-sizing: border-box;
    color: #000;
	font-family: 'Raleway', sans-serif;
}

    </style>
  <script src="<?php echo base_url(); ?>assets/bundles/libscripts.bundle.js"></script>    
  <script src="<?php echo base_url(); ?>assets/bundles/vendorscripts.bundle.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.7.2.min.js"></script>
    <script>
    $(document).ready(function(){
       $("#class").change(function(){
          var d = document.getElementById("class").value;
          $("#classname").load("../lib/load.php", {count: d})
       })
    })
    </script>
</head>
<body>
	<div class="w3ls-main ">
		<div class="wthree-heading"><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
		<h1 style="font-size:25px; font-weight:bold; color:#6B3F96">  <br>CSMT SCHOOLS<br>CBT EXAM PORTAL</h1>
		</div>
			<div class="wthree-container">
				<div class="wthree-form">
					<div class="agileits-2">
						<h2>Create Account<br>
                        <span style="font-size:14px; text-transform:lowercase;"></span>
                        </h2>
                        
					</div>                    
					<form action="register_student" method="post">

						<textarea id="id01" hidden><?php $response = file_get_contents(base_url().'auth/get_students'); echo $response; ?></textarea>
                        <label style="color:#fff;">Search for Name </label>

  <div class="autocomplete" style="width:300px;">
						<div class="w3-user">
							<span><i class="fa fa-edit" aria-hidden="true"></i></span>
							<input type="text" name="searchname" id="searchname" placeholder="Surname First" required="">
						</div>
					</div>
                        
                     <!--    <label style="color:#fff;">Pin</label>
						<div class="w3-user">
							<span><i class="fa fa-edit" aria-hidden="true"></i></span>
							<input type="text" name="pin" placeholder="Registration Pin" required="">
						</div> -->
                        
                        
                         <label style="color:#fff;">Last Name:</label>
						<div class="w3-user">
							<span><i class="fa fa-user-o" aria-hidden="true"></i></span>
							<input readonly="" type="text" name="lname" placeholder="Last Name" id="lastname" required="">
						</div>
						<div class="clear"></div>
                         <label style="color:#fff;">Other Names:</label>
						<div class="w3-psw">
							<span><i class="fa fa-user" aria-hidden="true"></i></span>
							<input readonly="" type="text" name="fname" placeholder="Other Names" id="othernames" required="">
						</div>
						<div class="clear"></div>
                         <label style="color:#fff;">Registration Number:</label>
						<div class="w3-psw">

							<input readonly="" type="text" hidden name="student_id" placeholder="Registration Number" id="student_id" required="">
							<span><i class="fa fa-key" aria-hidden="true"></i></span>
							<input readonly="" type="text" name="uname" placeholder="Registration Number" id="adm_no" required="">
						</div>
						<div class="clear"></div>
                        <label style="color:#fff;">Password:</label>
						<div class="w3-psw">
							<span><i class="fa fa-lock" aria-hidden="true"></i></span>
							<input type="password" name="pword" minlength="3" placeholder="Password" required="">
						</div>
						<div class="clear"></div>
                         <label style="color:#fff;">Select Class:</label>
                        	<div class="w3-psw">
							<span><i class="fa fa-book" aria-hidden="true"></i></span>
						<select disabled class="others" name="class" id="class">
                    <option value=""></option>
                    <?php foreach ($class_list as $class) { ?>
                    <option value="<?php echo $class->class_name; ?>"><?php echo $class->class_name ?></option>
                  <?php } ?>
                    </select>
						<select readonly="" hidden class="others" name="class" id="class2">
                      <option value=""></option>
                    <?php foreach ($class_list as $class) { ?>
                    <option value="<?php echo $class->class_name; ?>"><?php echo $class->class_name ?></option>
                  <?php } ?>
                    </select>
						</div>
                        
        <!--                 <div class="clear"></div>
                         <label style="color:#fff;">Select School type:</label>
                        	<div class="w3-psw">
							<span><i class="fa fa-book" aria-hidden="true"></i></span>
						<select disabled class="others" name="type" id="type">
                            <option value="Day">Day</option>
                    <option value="Boarding">Boarding</option>
                    </select>
						<select readonly="" hidden class="others" name="type" id="type2">
                            <option value="Day">Day</option>
                    <option value="Boarding">Boarding</option>
                    </select>
						</div> -->
                        
                        
					<!-- 	<div class="clear"></div>
                        <label style="color:#fff;">Select Class Name</label>
						<div class="w3-psw">
							<span><i class="fa fa-file" aria-hidden="true"></i></span>
                            
						<select disabled class="others" name="subclass" id="classname">
                    <?php //subclasses();?>
                    </select>
						<select readonly="" hidden class="others" name="subclass" id="classname2">
                    <?php //subclasses();?>
                    </select>
						</div> -->
						<div class="clear"></div>
                        
                        
						<div class="w3l">
							<span><a href="<?php echo base_url('auth/logout'); ?>" style="color:#FFBF00;">Already registered? Login here.</a></span>  
						</div>
						<div class="clear"></div>
						<div class="w3l-submit">
							<input type="submit" value="Create Account" style="font-size:14px;">
						</div>
						<div class="clear"></div>
					</form>
				</div>
			</div>
	</div>
		<div class="agileits-footer">
			<p>&copy; CSMT <?php echo date("Y")?></p>
		</div>
</body>
</html>

<script type="text/javascript">

function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      a.setAttribute("style", "max-height:200px;overflow:scroll;");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        //console.log(arr[i]);
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].student_name.substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].student_name.substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].student_name.substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i].student_name + "'>";
          b.innerHTML += "<input type='hidden' value='" + arr[i].stud_id + "'>";
          b.innerHTML += "<input type='hidden' value='" + arr[i].adm_no + "'>";
          b.innerHTML += "<input type='hidden' value='" + arr[i].lastname + "'>";
          b.innerHTML += "<input type='hidden' value='" + arr[i].othernames + "'>";
          b.innerHTML += "<input type='hidden' value='" + arr[i].current_class + "'>";
          b.innerHTML += "<input type='hidden' value='" + arr[i].arm + "'>";
          b.innerHTML += "<input type='hidden' value='" + arr[i].school_type + "'>";
             // console.log(arr[i].label);
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
             document.getElementById('student_id').value = this.getElementsByTagName("input")[1].value;
              document.getElementById('adm_no').value = this.getElementsByTagName("input")[2].value;
              document.getElementById('lastname').value = this.getElementsByTagName("input")[3].value;
              document.getElementById('othernames').value = this.getElementsByTagName("input")[4].value;
              var classed = this.getElementsByTagName("input")[5].value;
              //console.log(classed);
              // if (classed =="JSS1") { classed2 = "JSS1" }
              // else if (classed =="JSS2") { classed2 = "JSS2" }
              // else if (classed =="JSS3") { classed2 = "JSS3" }
              // else if (classed =="SSS1") { classed2 = "SSS1" }
              // else if (classed =="SSS2") { classed2 = "SSS2" }
              // else if (classed =="SSS3") { classed2 = "SSS3" }
            //  classed = classed2;
              document.getElementById('class').value = classed;
              document.getElementById('class2').value = classed;
              var classname = this.getElementsByTagName("input")[7].value;
              if (classname=='1') {
              	classname2 ="Boarding";
              }
              else {
              	classname2 = "Day"; 
              }
             document.getElementById('type').value = classname2
             document.getElementById('type2').value = classname2
              ///
              var subclass = this.getElementsByTagName("input")[6].value
              if (subclass =='Sciences(Pure Science)') {subclassed='PURE SCIENCE'}
              	else if (subclass =='Sciences(Mixed Science)') {subclassed='MIXED SCIENCE'}
              	else if (subclass =='Arts(Social Science)') {subclassed='SOCIAL SCIENCE'}
              	else if (subclass =='Arts(Management Science)') {subclassed='MANAGEMENT SCIENCE'}
              		else { subclassed = subclass }

              if(classed == 'SSS1') { classed3 = 'SS1' }
              	else if(classed == 'SSS2') { classed3 = 'SS2' }
              		else if(classed == 'SSS3') { classed3 = 'SS3' }
              			else {classed3 = classed}


              	var classarm = classed3+" "+subclassed;
             //console.log(classarm.toUpperCase());
             var classarmUpper = classarm.toUpperCase();


			  var x = document.getElementById("classname");
			  //console.log(classarm);
			  //var txt = "All options: ";
			  var i;
			  for (i = 0; i < x.length; i++) {
			  	if (classarmUpper == x.options[i].text) {
			  		//console.log(x.options[i].text);

			  		//classname_value = document.getElementById("classname").value


			  		//console.log(classname_value);
			  		document.getElementById('classname').value = x.options[i].value;
			  		document.getElementById('classname2').value = x.options[i].value;
			  	}
			   
			  }
  
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {

    //console.log(document.getElementById('myInput').value)
      closeAllLists(e.target);
  });
}

var json1 = document.getElementById('id01').value;

var countries = JSON.parse(json1);

autocomplete(document.getElementById("searchname"), countries);
</script>
</script>
