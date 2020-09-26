<?php

require_once("../wp-load.php");
include("connection.php");
include("simple_html_dom.php");



$count=1;


$query=$con->prepare("SELECT * FROM sub_cats_url");
        $query->execute();
        $results=$query->get_result();
        if($results->num_rows>0)
        {
            while($row=$results->fetch_assoc())
            {
             
                $category_url=$row['sub_cat_url'];

                $ch = curl_init();
                                    curl_setopt($ch, CURLOPT_URL,$category_url);
                                    curl_setopt($ch,CURLOPT_POST, false);
                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                    $output = curl_exec($ch);
                                    curl_close($ch);

                                    $html= new simple_html_dom();
                                    $html->load($output);


                                    foreach($html->find('div[class=ZmHEEd ]') as $app_conatiner)
                                    {
                                        foreach($app_conatiner->find('div[class=Vpfmgd]') as $app_img_box)
                                        {

                                            foreach($app_img_box->find('div[class=RZEgze]') as $app_img_boxx)
                                            {
                                                foreach($app_img_boxx->find('a') as $app_link)
                                                {
                                                    echo '<br>';
                                                    $app_link=trim($app_link->href);
                                                    $app_link="https://play.google.com".$app_link;
                                                    // echo $link=$sublink->plaintext;
                                                    echo $sub_link;
                                                    echo '<br>';
                                                }
                                            }
                                        }

                                     }


                                     echo'<h2>Counter'.$row['sub_url_id'].'</h2> ';
                                     echo'<h2>Next Category</h2>';










            }// While Loop End

        }    // If end For Record Check

        else
        {
            echo "No record in found in table ";
        }






?>