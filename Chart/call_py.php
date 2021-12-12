
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<!--call-->
    <div>
        <?php
        $dataFile = '/var/www/plots/Chart/Data/stock_data_frome.cs';
        $command = escapeshellcmd("/usr/bin/python3 /var/www/plots/Chart/python/plot.py Date Close T10Y3M red {$dataFile}");

        exec($command, $output,$status);
        print_r($status) ;
        print_r($output[0]) ;
//        print_r($status) ;
        ?>
    </div>
</body>
</html>