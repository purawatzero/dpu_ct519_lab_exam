<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//Purawat Verukanjana
if ( empty($_REQUEST['id']) !== false ){ header("Locaion: ./index.php"); }
?>

<html>
<head>
    <link href="https://unpkg.com/tabulator-tables@5.2.3/dist/css/tabulator_midnight.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://unpkg.com/tabulator-tables@5.2.3/dist/js/tabulator.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link href="/dist/css/tabulator_simple.min.css" rel="stylesheet">
</head>
<body>
<title>Purawat Verukanjana 645162010023</title>
    <?php 
        $db = u_mysqli_connect();
        $dataset = u_mysqli_query($db, "SELECT * FROM Hero WHERE Hero_id = ".$_REQUEST['id'].";");
        // n_print($dataset);
    ?>

    <img src="<?php echo "./".$dataset[0]['Picture_link'];?>" alt="..." style="width:25%;">
        <h2 class="card-title"><b><?php echo $dataset[0]['Name']; ?></b></h2>
        <p class="card-text"><?php echo $dataset[0]['Detail']; ?></p>
        <h4 class="card-title"> Appeared in ...</h4>
        <?php li_movie( $db, $dataset[0]['Hero_id'] )?>
        <br>
        <a href="./index.php">HOME</a>

    <br><br>
    <h4>Developed by : <a href="http://localhost:9923/index.html"> Purawat Verukanjana </a></h4>
</body>
</html>


<?php //function
    function u_mysqli_connect(){
        $host     = 'sv_db';
        $db       = '0023_Lab_Exam';
        $user     = 'purawat.v.user';
        $password = 'purawat.v.password';
        $port     = 3306;
        $charset  = 'utf8mb4';
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $db = new mysqli($host, $user, $password, $db, $port);
        $db->set_charset($charset);
        $db->options(MYSQLI_OPT_INT_AND_FLOAT_NATIVE, 1);
        return $db;
    }
    function u_mysqli_query($db, $sql){
        $db = u_mysqli_connect();
        $res = $db->query($sql);
        $dataset = array();
        $count=0;
        while ($row = $res->fetch_assoc()) {
            $count++;
            $row['id'] = $count;
            $dataset[] = $row;
        }
        return $dataset;
    }
    function n_print($ar){
        echo "<pre>";
        print_r($ar);
        echo "</pre>";
    }
    function li_movie($db, $hr_id){
        $dataset = u_mysqli_query($db, "SELECT * FROM Movie A INNER JOIN Hero_in_movie B ON B.Movie_id = A.Movie_id WHERE B.Hero_id = '$hr_id';");
        foreach($dataset as $key => $val){
            echo "<li>  <a href=".$val['Trailer_link']."' target='_blank'> ".$val['Name']." </a></li>";
        }
        // n_print($dataset);
    }
?>