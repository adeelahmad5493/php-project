<?php
   include 'connect_db.php';
    
?>

<!DOCTYPE html>
<html>

<head>
    <title> Khired Employee Management system </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id = "top_menu">

    </div>
    <div id = "left_menu">

    </div>

    <div id = "form_outer_div">

    <div id = "form_inner_div">
        <form name = "employe_info" action= "searchFromDB.php" method="POST" id = "employee_search_form">
            
        <div id = "first_fieldset_div">
            <fieldset>
                Name: &nbsp;
                    <input type="text" name = "name" value = "" id = "name">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                JOB DESCRIPTION: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text" name = "job_desc" value = "" id = "description">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                DISTANCE: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <select name="distance" id="office_distance">
                        <option value="5km"> 5 KM </option>
                        <option value="10km"> 10 KM </option>
                        <option value="15km"> 15 KM </option>
                    </select> <br><br>  

                JOB: &nbsp;&nbsp;&nbsp;&nbsp;
                    <select name="job" id="job" onchange = "loadRoles(this.value)">
                        <option value="1">JOB(S)</option>
                        <?php
                            $q = "SELECT * FROM employees GROUP BY(JOB)";
                            $result = mysqli_query($conn, $q);
                            while($rows = mysqli_fetch_array($result))
                            {?>
                                <option value = "<?php echo $rows['JOB']; ?>"> <?php echo $rows['JOB']; ?> </option>

                        <?php
                            } 
                        ?>
                    </select> 
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                KEYWORDS:
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type = "text" name = "key_words" value = "" id = "words">
            
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                <select name="assign" id="job_assign">
                    <option value="1"> Assignment </option>
                </select>  <br><br>

                ROLE:  &nbsp;&nbsp;
                    <select name="role" id="job_roles">
                    </select>  <br><br>
                STATUS: &nbsp;
                    <select name="status" id="job_status">
                        <option value="active"> ACTIVE </option>
                        <option value="registered"> REGISTERED </option>
                        <option value="enquiry"> ENQUIRY </option>
                        <option value="inactive"> INACTIVE </option>
                    </select> <br><br>

                DAYS/NIGHTS:
                    <select name="shift" id="job_shift">
                        <option value="day"> DAY </option>
                        <option value="night"> NIGHT </option>
                        <option value="both"> BOTH </option>
                    </select> <br><br>       

                TYPE:
                    <select name="type" id="job_type">
                        <option value="temp"> TEMP </option>
                        <option value="perm"> PERM </option>
                        <option value="ttp"> TTP </option>
                    </select>

            </fieldset>
            </div>
            <br>

        
        <div id = "second_fieldset_div">

        <fieldset>
                <button name = "show_no_of_workers"  id = "show_no_of_workers" disabled> TOTAL WORKER : 0 </button> 

                <div id = "buttons_search_clear">
                    <button name = "search" id = "search_btn" onclick = "submit_form()"> SEARCH </button>
                    <button name = "clear_search" id = "clear_btn"> CLEAR SEARCH </button>
                    
                </div>
        </fieldset>
        </div>
        <br>

        <div id = "third_fieldset_div">
            <fieldset>
                <div id = "show_result">
                    <div id = "noResultsLogo">
                        <img src = "logo.jpg" alt = "Image not found" style = "width:200px; height:200px;">
                    </div>
                    <div id = "show_table">
                    </div>
                </div>
                <div id = "nothingToShowText">
                    <h4>  Nothing to see here yet</h4>
                </div>
            </fieldset>
        </div>
    </form>

    </div>
    </div>


<script type="text/javascript">
	function loadRoles(datavalue){
		$.ajax({
			url: 'loadRoles.php?job='+datavalue,
			type: 'GET',
		success: function(result){
            var object = JSON.parse(result);
            var len = object.length;

            for(var i = 0; i < len; i++)
            {
                var o = new Option(" "+object[i], ""+object[i]);
                $(o).html(" "+object[i]);
                $("#job_roles").append(o);    
            }        
		},
        error: function (request, error) {


                alert(" Can't do because: " + error);
        },
	});
    }
  
    function submit_form()
    {
        $("#employee_search_form").submit(function(e){
            e.preventDefault();

            var form = $(this);
            var url = form.attr('action');

            var name = document.getElementById("name").value;
            var job = document.getElementById("job").value;
            var role = document.getElementById("job_roles").value;
            var status = document.getElementById("job_status").value;
            var shift = document.getElementById("job_shift").value;
            var type = document.getElementById("job_type").value;
            var descr = document.getElementById("description").value;
            var words = document.getElementById("words").value;
            var distance = document.getElementById("office_distance").value;

            $.ajax({
                url : 'searchFromDB.php',
                type : 'POST',
                data : {name : name, job : job, status : status, shift : shift, job_descr : descr, key_words : words, role : role, type : type, distance : distance},
                success: function(data)
                {        
                    alert(data);
                    var obj =  JSON.parse(data);
                    //alert(obj.length)
                    var count = 0;
                    for(var prop in obj[0]) {
                        ++count;
                    }
                    document.getElementById("show_no_of_workers").innerHTML = 'Total Workers: '+obj.length;

                    if(count > 0)
                    {
                    $('#first_fieldset_div').hide();
                    $('#noResultsLogo').hide();
                    $('#nothingToShowText').hide();

                    var body = document.getElementById("show_table");
                    var tbl = document.createElement("table");
                    var tblBody = document.createElement("tbody");

                        var row = document.createElement("tr");
                        var cell = document.createElement("td");
                        var cellText = document.createTextNode("NAME");
                        cell.appendChild(cellText);
                        row.appendChild(cell);

                        var cell = document.createElement("td");
                        var cellText = document.createTextNode("JOB");
                        cell.appendChild(cellText);
                        row.appendChild(cell);

                        var cell = document.createElement("td");
                        var cellText = document.createTextNode("SHIFT");
                        cell.appendChild(cellText);
                        row.appendChild(cell);

                        var cell = document.createElement("td");
                        var cellText = document.createTextNode("STATUS");
                        cell.appendChild(cellText);
                        row.appendChild(cell);

                        var cell = document.createElement("td");
                        var cellText = document.createTextNode("ROLE");
                        cell.appendChild(cellText);
                        row.appendChild(cell);

                        var cell = document.createElement("td");
                        var cellText = document.createTextNode("TYPE");
                        cell.appendChild(cellText);
                        row.appendChild(cell);

                        tblBody.appendChild(row);

                    for (var i = 0; i < obj.length; i++) {
                        //var row = document.createElement("tr");

                        var row = document.createElement("tr");
                        var cell = document.createElement("td");
                        var cellText = document.createTextNode(""+obj[i].name);
                        cell.appendChild(cellText);
                        row.appendChild(cell);

                        var cell = document.createElement("td");
                        var cellText = document.createTextNode(""+obj[i].job);
                        cell.appendChild(cellText);
                        row.appendChild(cell);

                        var cell = document.createElement("td");
                        var cellText = document.createTextNode(""+obj[i].shift);
                        cell.appendChild(cellText);
                        row.appendChild(cell);

                        var cell = document.createElement("td");
                        var cellText = document.createTextNode(""+obj[i].status);
                        cell.appendChild(cellText);
                        row.appendChild(cell);

                        var cell = document.createElement("td");
                        var cellText = document.createTextNode(""+obj[i].role);
                        cell.appendChild(cellText);
                        row.appendChild(cell);

                        var cell = document.createElement("td");
                        var cellText = document.createTextNode(""+obj[i].type);
                        cell.appendChild(cellText);
                        row.appendChild(cell);

                    tblBody.appendChild(row);
                    }

                    tbl.appendChild(tblBody);
                    body.appendChild(tbl);
                    tbl.setAttribute("border", "2");
                    }
                }
                });
            });     
        }
        
</script>

</body>
</html>