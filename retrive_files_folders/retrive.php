<?php
try {
    $data = json_decode(file_get_contents('php://input'));
    $dir  = "../images/Media";
    function scan_dir($folder_location)
    {
        // echo "in fuct";
        //retrive all the folder items
        $scanned_directory = array_diff(scandir($folder_location), array('..', '.'));
        //looping each dir item
        foreach ($scanned_directory as $item) {
            // echo "foreach";
            // echo $item;
            //check is it dir
            // echo $folder_location . "/" . $item;
            if (is_dir($folder_location . "/" . $item)) {
                scan_dir($folder_location . "/" . $item);
                echo "<br/> it is a folder";
                // Something
            } else if (is_file($folder_location . "/" . $item)) // check is it file
            {
                echo "<br/> it is a file";
                //do somesthing
                // Something
            }
        }
    }
    scan_dir($dir);

    $output['images']  = $old;
    $output['status']  = 200;
    $output['message'] = "Data retrived successfully";
    echo json_encode($output);
    exit();
} catch (Exception $e) {
    $output['status']  = 400;
    $output['data']    = null;
    $output['message'] = $e->getMessage();
    echo json_encode($output);
    exit;
}
