<?php
//getting input search
$searchText = $_GET["searchKey"];
print"User's search: ".$searchText;
    //connect to database: natbkawards_db
    //set up 4 parameters
    $server = "localhost";
    $user = "root";
    $password = "root";
    $database = "cunyColleges_db";

    //for later use(fro gph - good programing habit)
    $databaseTable = "cunyColleges_table";

    //make a connection to the tdatabase - use php funtion: mysqli_connect()
    $mycon = mysqli_connect($server, $user, $password, $database) or die("no connection established");
    //print"connected";

    //create a string variable that holds the SQL command
    $SQLselect = "SELECT * FROM " . $databaseTable." WHERE MATCH(college,address,city,state,zipcode,telephone,website) "."AGAINST ('".$searchText."' IN NATURAL LANGUAGE MODE)"." ORDER BY ".$databaseTable."."."id";
    
    //$SQLselect = "select authorImage from " . $databaseTable;
    


    //to run the above SQL command = PHP has a funtion: mysqli_query()
    //store the results of the run in a variable
    $results = mysqli_query($mycon, $SQLselect) or die(" query did not run");
    

    //is there any records 
    $numrecs = mysqli_num_rows($results);
    $firstrec = true;//display table
    $maximages = 5; //maxnumber of the image
    $imagenumber = 1; //to display table row
    $count = 1;
    if ($numrecs > 0) {
        if ($firstrec == true){
            print "<table border = '1'>";
            $firstrec = false;
        } 
        print "<tr>";
            print"<th>Id</th>";
            print"<th>College</th>";
            print"<th>Address</th>";
            print"<th>City</th>";
            print"<th>State</th>";
            print"<th>Zip Code</th>";
            print"<th>Telephone</th>";
            print"<th>Website</th>";
        print "</tr>";
            while ($recordArray = mysqli_fetch_row($results)) {
               if ($imagenumber ==1) {
                print "<tr>";              
                
                //extracting field's values
                $id = $recordArray[0];
                $collge = $recordArray[1];
                $address = $recordArray[2];
                $city = $recordArray[3];
                $state = $recordArray[4];
                $zipcode = $recordArray[5];
                $telephone = $recordArray[6];
                $website = $recordArray[7];
                //string variable that holds all book's information
                $collegesdata = $id.",".$collge.",".$address.",".$city.",".$state.",".$zipcode.",".$telephone.",".$website;

                print"<td>$id</td>";
                print"<td>$collge</td>";
                print"<td>$address</td>";
                print"<td>$city</td>";
                print"<td>$state</td>";
                print"<td>$zipcode</td>";
                print"<td>$telephone</td>";
                print"<td>$website</td>";
            }
            print "</tr>";
        }

        print "</table>";
    }
    // else print " No record(s) found";

?>
