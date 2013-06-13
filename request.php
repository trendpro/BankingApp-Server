<?php
    //include db handler
    require_once 'include/DB_Functions.php';
    $db = new DB_Functions();

/**
 * File to handle all API requests
 * Accepts GET and POST
 *
 * Each request will be identified by TAG
 * Response will be JSON data
 */
 
/**
 * check for POST request
 */
	
 if (isset($_POST['tag']) && $_POST['tag'] != '') {
    // get tag
    $tag = $_POST['tag'];
 
    // response Array
    $response = array("tag" => $tag, "success" => 0, "error" => 0);
 	
    // check for tag type
    if ($tag == 'login') {
        // Request type is check Login
        $email = $_POST['email'];
        $password = $_POST['password'];
 
        // check for user
        $user = $db->getUserByEmailAndPassword($email, $password);
        if ($user != false) {
            //user found
            //echo json with success = 1 and the secret key and access key
            $response["success"] = 1;
            
            echo json_encode($response);
        } else {
            // user not found
            // echo json with error = 1
            $response["error"] = 1;
            $response["error_msg"] = "Incorrect login credentials";
            echo json_encode($response);
        }
    } 
	else if ($tag == 'get_my_portfolio') {
        //Request type is get my portfolio
		$email = $_POST['email'];
		
        //select users portfolio
        $result = $db->getMyPortfolio($email);
		//var_dump($result);
        $no_of_rows = mysql_num_rows($result);
		
        if ($no_of_rows > 0) {
            $response["success"] = 1;
            $rate_response = array();
			
				while($row = mysql_fetch_assoc($result))
				{
					$rate_response['Company_Name'] = $row['cname'];
					$rate_response['no_of_shares'] = $row['shares'];
					$rate_response['share_price'] = $row['pp'];
					$rate_response['total'] = $row['shares']*$row['pp'];
					$rate_response['portfolio_ID'] = $row['id'];
					$rate_response['success'] = 1;
					$data[] = $rate_response;
				}
			//Find a way to send an array of jason objects
			$response["JSONArr"] = $data;
            echo json_encode($response);
        } else {
            // exchange rates table could not be selected or is not there
            // echo json with error = 1
            $response["error"] = 1;
            $response["error_msg"] = "Unable to Fetch Exhnage Rates";
            echo json_encode($response);
        }
    } 
	else if ($tag == 'get_my_watchlist') {
        // Request type is get my wactlist
		$email = $_POST['email'];
		
        // select users watchlist data
        $result = $db->getMyWatchlist($email);
		//var_dump($result);
        $no_of_rows = mysql_num_rows($result);
		
        if ($no_of_rows > 0) {
            $response["success"] = 1;
            $rate_response = array();
			
				while($row = mysql_fetch_assoc($result))
				{
					$rate_response['Company_Name'] = $row['cname'];
					$rate_response['Last_Traded_Price'] = $row['ltp'];
					$rate_response['Previous_Price'] = $row['pp'];
					$rate_response['Change'] = $row['c'];
					$rate_response['Watchlist_ID'] = $row['id'];
					$rate_response['success'] = 1;
					$data[] = $rate_response;
				}
			//Find a way to send an array of jason objects
			$response["JSONArr"] = $data;
            echo json_encode($response);
        } else {
            // exchange rates table could not be selected or is not there
            // echo json with error = 1
            $response["error"] = 1;
            $response["error_msg"] = "Unable to Fetch Exchange Rates";
            echo json_encode($response);
        }
    } 
	else if ($tag == 'get_top_losers') {
        //Request type get top losers in share listing
		 
        //select losers from sharelisting table 
        $result = mysql_query("SELECT * from  all_share_listings order by `Change` asc");//complex query
        $no_of_rows = mysql_num_rows($result);
		
        if ($no_of_rows > 0) {
            $response["success"] = 1;
            $rate_response = array();
			
				while($row = mysql_fetch_assoc($result))
				{
					$rate_response['Company_Name'] = $row['Company_Name'];
					$rate_response['Last_Traded_Price'] = $row['Last_Traded_Price'];
					$rate_response['Previous_Price'] = $row['Previous_Price'];
					$rate_response['Change'] = $row['Change'];
					$rate_response['Share_Listing_ID'] = $row['Share_Listing_ID'];
					$rate_response['success'] = 1;
					$data[] = $rate_response;
				}
			//Find a way to send an array of jason objects
			$response["JSONArr"] = $data;
            echo json_encode($response);
        } else {
            // exchange rates table could not be selected or is not there
            // echo json with error = 1
            $response["error"] = 1;
            $response["error_msg"] = "Unable to Fetch Exhnage Rates";
            echo json_encode($response);
        }
    } 
	else if ($tag == 'get_top_gainers') {
        // Request type get top gainers in share listing
		 
        // select gainers from sharelisting table 
        $result = mysql_query("SELECT * from  all_share_listings order by `Change` desc");//complex query!!!!!!!!!!!
        $no_of_rows = mysql_num_rows($result);
		
        if ($no_of_rows > 0) {
			$response["success"] = 1;
            $rate_response = array();
			
				while($row = mysql_fetch_assoc($result))
				{
					$rate_response['Company_Name'] = $row['Company_Name'];
					$rate_response['Last_Traded_Price'] = $row['Last_Traded_Price'];
					$rate_response['Previous_Price'] = $row['Previous_Price'];
					$rate_response['Change'] = $row['Change'];
					$rate_response['Share_Listing_ID'] = $row['Share_Listing_ID'];
					$rate_response['success'] = 1;
					$data[] = $rate_response;
				}
			//Find a way to send an array of jason objects
			$response["JSONArr"] = $data;
            echo json_encode($response);
        } else {
            //top gainers data could not be selected or is not there
            // echo json with error = 1
            $response["error"] = 1;
            $response["error_msg"] = "Unable to Fetch Exhnage Rates";
            echo json_encode($response);
        }
    }
	else if ($tag == 'add_my_portfolio_entry') {
        //Request type add my portfolio entry
        $company_name = $_POST['company_name'];
        $no_of_shares = (integer)$_POST['no_of_shares'];
		$share_listing_id = $_POST['share_listing_id'];
		$email = $_POST['email'];
 
        //write portfolio details to database
        $signup = $db->addCompanyListingToMyPortfolio($company_name,$no_of_shares,$share_listing_id,$email);
        if ($signup != false) {
            //portfolio entry successfully added
            //echo json with success = 1 and the secret key and access key
            $response["success"] = 1;
            
            echo json_encode($response);
        } else {
     		//failed to add portfolio entry
            // echo json with error = 1
            $response["error"] = 1;
            //$response["error_msg"] = "Incorrect email or password!";
            echo json_encode($response);
        }
    }
	else if ($tag == 'add_my_watchlist_entry') {
        //Request type add my watchlist entry
        $email = $_POST['email'];
        $share_listing_id = $_POST['share_listing_id'];
		
 
        //write watchlist details to database
        $signup = $db->addEntryToMyWatchlist($email,$share_listing_id);
        if ($signup != false) {
            //my watchlist entry successfully added
            //echo json with success = 1 and the secret key and access key
            $response["success"] = 1;
            
            echo json_encode($response);
        } else {
     		//Failed to add entry to my watchlist
            // echo json with error = 1
            $response["error"] = 1;
            //$response["error_msg"] = "Incorrect email or password!";
            echo json_encode($response);
        }
    }
	else if ($tag == 'fetch_ad') {
        //Request type fetch ad
        $email = $_POST['username'];
 
        //fetch a targeted advert from the database based on user information we know
        $signup = $db->fetchRandomTargetedAdvert($email);
       
        $response["success"] = 1;
		$response["advert"] = $signup['advert'];
		$response["ad_url"] = $signup['ad_url'];
            
        echo json_encode($response);
    }
	else if ($tag == 'remove_my_portfolio_entry') {
        //Request type remove my portfolio entry
        $email = $_POST['username'];
        $portfolio_ID = $_POST['portfolio_ID'];
		
		$signup = $db->removeMyPortfolioEntry($email,$portfolio_ID);
		//var_dump($signup);
		
        if ($signup != false) {
            //portfolio entry successfully deleted
            //echo json with success = 1 and the secret key and access key
            $response["success"] = 1;
            
            echo json_encode($response);
        } else {
     		//Server could not delete portfolio entry
            //echo json with error = 1
            $response["error"] = 1;
            //$response["error_msg"] = "Incorrect email or password!";
            echo json_encode($response);
        }
    }
	else if ($tag == 'remove_my_watchlist_entry') {
        //Request type remove my portfolio entry
        $email = $_POST['username'];
        $watchlist_ID = $_POST['watchlist_ID'];
		
 
        //write remove my watchlist entry
        $signup = $db->removeMyWatchlistEntry($email,$watchlist_ID);
        if ($signup != false) {
            //user successfully saved
            //echo json with success = 1 and the secret key and access key
            $response["success"] = 1;
            
            echo json_encode($response);
        } else {
     		//Server could not remove watchlist entry
            //echo json with error = 1
            $response["error"] = 1;
            //$response["error_msg"] = "Incorrect email or password!";
            echo json_encode($response);
        }
    }
	else if ($tag == 'get_exchange_rates') {
        // Request type is get exchange rates
		 
        //select exchange rates from database
        $query = mysql_query("SELECT * from  exchange_rates");
        $no_of_rows = mysql_num_rows($query);
		
        if ($no_of_rows > 0) {
            //table has exchange rates
            //echo json with success = 1
            $response["success"] = 1;
			$rate_response = array();
			
				while($row = mysql_fetch_assoc($query))
				{
					$rate_response['Currency'] = $row['Currency'];
					$rate_response['Buying_Rate'] = $row['Buying_Rate'];
					$rate_response['Selling_Rate'] = $row['Selling_Rate'];
					$rate_response['success'] = 1;
					$data[] = $rate_response;
				}
			//Find a way to send an array of jason objects
			$response["JSONArr"] = $data;
            echo json_encode($response);
            
        } else {
            // exchange rates table could not be selected or is not there
            // echo json with error = 1
            $response["error"] = 1;
            $response["error_msg"] = "Unable to Fetch Exhnage Rates";
            echo json_encode($response);
        }
    } 
	else if ($tag == 'get_fixed_deposit_rates') {
        // Request type is get fixed deposit rates
		 
        //select fixed deposit rates from the database
        $result = mysql_query("SELECT * from  fixed_deposit_rates");
        $no_of_rows = mysql_num_rows($result);
		
        if ($no_of_rows > 0) {
            //table has fixed deposit rates
            //echo json with success = 1
            $response["success"] = 1;
			
			$rate_response = array();
			
				while($row = mysql_fetch_assoc($result))
				{
					$rate_response['Range_From'] = $row['Range_From'];
					$rate_response['Range_To'] = $row['Range_To'];
					$rate_response['One_Month_Pa'] = $row['One_Month_Pa'];
					$rate_response['Three_Month_Pa'] = $row['Three_Month_Pa'];
					$rate_response['Six_Month_Pa'] = $row['Six_Month_Pa'];
					$rate_response['One_Year_Pa'] = $row['One_Year_Pa'];
					$rate_response['success'] = 1;
					$data[] = $rate_response;
				}
			//Find a way to send an array of jason objects
			$response["JSONArr"] = $data;
            echo json_encode($response);
			
        } else {
            // exchange rates table could not be selected or is not there
            // echo json with error = 1
            $response["error"] = 1;
            $response["error_msg"] = "Unable to Fetch Fixed deposit Rates";
            echo json_encode($response);
        }
    } 
	else if ($tag == 'signup') {
        //Request type is signup user
        $email = $_POST['email'];
        $password = $_POST['password'];
		$name = $_POST['name'];
		$dob = $_POST['dob'];
		$gender = $_POST['gender'];
 
        //write user details to database
        $signup = $db->signUpAndroidUser($name,$email,$password,$dob,$gender);
        if ($signup != false) {
            //user successfully saved
            //echo json with success = 1 and the secret key and access key
            $response["success"] = 1;
            
            echo json_encode($response);
        } else {
     		//User signup failed!
            //echo json with error = 1
            $response["error"] = 1;
            //$response["error_msg"] = "Incorrect email or password!";
            echo json_encode($response);
        }
    }
	else 
	{
        echo "Invalid Request";
    }
} 
else 
{
    echo "Access Denied!";
}
?>