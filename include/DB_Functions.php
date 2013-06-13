<?php
 /*
  * This class handles all the business logic of the client at on Server.
  */
class DB_Functions {
 
    private $db;
 
    //constructor
    function __construct() {
        require_once 'DB_Connect.php';
        // connecting to database
        $this->db = new DB_Connect();
        $this->db->connect();
    }
 
    // destructor
    function __destruct() {
 
    }
 
    /**
     * Storing new user
     * returns user details
     */
    public function storeUser($name, $email, $password) {
        $uuid = uniqid('', true);
        $hash = $this->hashSSHA($password);
        $encrypted_password = $hash["encrypted"]; // encrypted password
        $salt = $hash["salt"]; // salt
        $result = mysql_query("INSERT INTO users(unique_id, name, email, encrypted_password, salt, created_at) VALUES('$uuid', '$name', '$email', '$encrypted_password', '$salt', NOW())");
        // check for successful store
        if ($result) {
            // get user details
            $uid = mysql_insert_id(); // last inserted id
            $result = mysql_query("SELECT * FROM users WHERE uid = $uid");
            // return user details
            return mysql_fetch_array($result);
        } else {
            return false;
        }
    }
	
	/**
     * Get user by email and password.This is the initial method
     */
    public function getUserByEmailAndPassword1($email, $password) {
        $result = mysql_query("SELECT * FROM users WHERE email = '$email'") or die(mysql_error());
        // check for result
        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
            $result = mysql_fetch_array($result);
            $salt = $result['salt'];
            $encrypted_password = $result['encrypted_password'];
            $hash = $this->checkhashSSHA($salt, $password);
            // check for password equality
            if ($encrypted_password == $hash) {
                // user authentication details are correct
                return $result;
            }
        } else {
            // user not found
            return false;
        }
    }

 
    /**
     * Encrypting password
     * @param password
     * returns salt and encrypted password
     */
    public function hashSSHA($password) {
 
        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);
        return $hash;
    }
 
    /**
     * Decrypting password
     * @param salt, password
     * returns hash string
     */
    public function checkhashSSHA($salt, $password) {
 
        $hash = base64_encode(sha1($password . $salt, true) . $salt);
 
        return $hash;
    }
	
	
	/*
	 *####################################################################################################################################################################
	 *													
	 *														Methods for handling Android Client Requests.
	 *
	 *####################################################################################################################################################################
	 */
	
	/*
	 * Fetches  a random advert from  the database  targeted to the user. It uses a special Targeted Advertisement Algorith which ensures that a client can 
	 * only receive an advert which is relevant to him or her. This reduces user annoyance due to irrelevant adverts which dont make sense, hence improving 
	 * general user experience of the App.
	 */
	public function fetchRandomTargetedAdvert($email)
	{
		$age = 0;
		$gender;
		/*
		 * Fetch gender and  age from the database where userID = $email
		 */
		$result = mysql_query("SELECT * FROM users_android WHERE Email = '$email'") or die(mysql_error());
        // check for result
        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
			//user exists 
            while($row = mysql_fetch_assoc($result))
				{
					$today = getdate();
					
					$dob = date_parse($row['Date_of_Birth']);
					$age =  $today['year'] - $dob['year'];
					$gender = $row['Gender'];
				}//end of while
        }//end of if
		
		/*
		 * Select an advert based on user's age and gender
		 */
		 if($age >= 0 && $age <= 25 && $gender = "Male")
		 {
			 //Select an  advert from category 1a or 1g or g
			 $result = mysql_query("SELECT * FROM adverts WHERE ad_category = '1a' OR ad_category = '1g' OR ad_category = 'g' ORDER BY RAND() LIMIT 1") or die(mysql_error());
		 }
		 else if($age >= 0 && $age <= 25 && $gender = "Female")
		 {
			 //select an advert from category 1b or 1g or g
			 $result = mysql_query("SELECT * FROM adverts WHERE ad_category = '1b' OR ad_category = '1g' OR ad_category = 'g' ORDER BY RAND() LIMIT 1") or die(mysql_error());
		 }
		 else if($age > 25 && $age <= 40 && $gender = "Male")
		 {
			 //select an advert from categry 2a or 2g or g
			 $result = mysql_query("SELECT * FROM adverts WHERE ad_category = '2a' OR ad_category = '2g' OR ad_category = 'g' ORDER BY RAND() LIMIT 1") or die(mysql_error());
		 }
		 else if($age > 25 && $age <= 40 && $gender = "Female")
		 {
			 //select an advert from category 2b or 2g or g
			 $result = mysql_query("SELECT * FROM adverts WHERE ad_category = '2b' OR ad_category = '2g' OR ad_category = 'g' ORDER BY RAND() LIMIT 1") or die(mysql_error());
		 }
		 else if($age > 40 && $age <= 60 && $gender = "Male")
		 {
			 //select an advert from category 3a or 3g or g
			 $result = mysql_query("SELECT * FROM adverts WHERE ad_category = '3a' OR ad_category = '3g' OR ad_category = 'g' ORDER BY RAND() LIMIT 1") or die(mysql_error());
		 }
		 else if($age > 40 && $age <= 60 && $gender = "Female")
		 {
			 //select an advert from category 3b or 3g or g
			 $result = mysql_query("SELECT * FROM adverts WHERE ad_category = '3b' OR ad_category = '3g' OR ad_category = 'g' ORDER BY RAND() LIMIT 1") or die(mysql_error());
		 }
		 else if($age > 60 && $gender = "Male")
		 {
			 //select an advert from category 4a or 4g or g
			 $result = mysql_query("SELECT * FROM adverts WHERE ad_category = '4a' OR ad_category = '4g' OR ad_category = 'g' ORDER BY RAND() LIMIT 1") or die(mysql_error());
		 }
		 else if($age > 60 && $gender = "Female")
		 {
			 //select an advert from category 4b or 4g or g
			 $result = mysql_query("SELECT * FROM adverts WHERE ad_category = '4b' OR ad_category = '4g' OR ad_category = 'g' ORDER BY RAND() LIMIT 1") or die(mysql_error());
		 }
		 
		 
		 /*
		  * Get the lenght of the result set and  generate a random index from 0 to lenght() - 1
		  */
		$result_length = mysql_num_rows($result);
		
		
		$return_value = array();
		
			if( $result_length > 0)
			{
				while($row = mysql_fetch_assoc($result))
				{
					$return_value['advert'] =$row['Advert'];
					$return_value['ad_url'] =$row['Ad_URL'];
					//break;
				}
			}
			else
			{
				$return_value['advert'] ="no_ad";
				$return_value['ad_url'] ="no_url";
			}
			
		return $return_value;
	}//end of fetch advert
	
	/*
	 * Adds a Company Listing to my portfolio.
	 */
    public function addCompanyListingToMyPortfolio($company_name,$no_of_shares,$share_listing_id, $email) {
       
        $result = mysql_query("INSERT INTO my_portfolio(Share_Listing_ID,Email,No_Of_Shares,Company_Name) VALUES('$share_listing_id','$email','$no_of_shares','$company_name')");
		
        //check for successful store
        if ($result) {
			
			return true;
        } else {
            return false;
        }
    }
	
	/*
	 * Adds a Company Listing to my watchlist.
	 */
	public function addShareListingToMyWatchlist($share_listing_id, $email) {
       
        $result = mysql_query("INSERT INTO my_watchlist(Share_Listing_ID,Email) VALUES('$share_listing_id','$email')");
		
        //check for successful store
        if ($result) {
			
			return true;
        } else {
            return false;
        }
    }
	
	/**
     * Check whether android client user exists or not
     */
    public function doesAndroidUserExist($email) {
        $result = mysql_query("SELECT email from users_android WHERE email = '$email'");
        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
            // user existed
            return true;
        } else {
            // user not existed
            return false;
        }
    }
	
	/**
     * Check whether system administrator exists or not 
     */
    public function doesAdminExist($username) {
        $result = mysql_query("SELECT Username from administrators WHERE Username = '$username'");
        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
            // user existed
            return true;
        } else {
            // user not existed
            return false;
        }
    }
	
	/**
     * Get user by email and password.Used to login a  user into the system
     */
    public function getUserByEmailAndPassword($email, $password) {
        $result = mysql_query("SELECT * FROM users_android WHERE Email = '$email' AND Password = '$password'") or die(mysql_error());
        // check for result
        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
			//user exists and username-password pair matches
            return true;
        } else {
            // user not found
            return false;
        }
    }
	
	/*
	 * Fetches a users Watchlist data from database
	 */
	public function getMyWatchlist($email) {
        $result = mysql_query("SELECT all_share_listings.Company_Name AS cname,all_share_listings.Last_Traded_Price AS ltp, all_share_listings.Previous_Price AS pp,all_share_listings.Change AS c,my_watchlist.Watchlist_ID AS id FROM all_share_listings  , my_watchlist WHERE all_share_listings.Share_Listing_ID = my_watchlist.Share_Listing_ID AND Email = '$email'") or die(mysql_error());
        // check for result
        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
			//user exists and username-password pair matches
            return $result;
        } else {
            // user not found
            return false;
        }
    }
	
	/*
	 * Fetches a users Portfolio data from database
	 */
	public function getMyPortfolio($email) {
        $result = mysql_query("SELECT all_share_listings.Company_Name AS cname,all_share_listings.Last_Traded_Price AS ltp, all_share_listings.Previous_Price AS pp,all_share_listings.Change AS c,my_portfolio.No_Of_Shares AS shares,my_portfolio.Portfolio_ID AS id FROM all_share_listings  , my_portfolio WHERE all_share_listings.Share_Listing_ID = my_portfolio.Share_Listing_ID AND Email = '$email'") or die(mysql_error());
        // check for result
        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
			//user exists and username-password pair matches
            return $result;
        } else {
            // user not found
            return false;
        }
    }
	
	  /*
	   * Removes an Entry from users watchlist
	   */
	   public function removeMyWatchlistEntry($email,$watchlist_ID) {
       
        $result = mysql_query("DELETE FROM my_watchlist WHERE Watchlist_ID = '$watchlist_ID'");
		
        // check for successful deletion
        if ($result) {
			
			return true;
        } else {
            return false;
        }
    }
	
	  /*
	   * Removes an Entry from users portfolio
	   */
	   public function removeMyPortfolioEntry($email,$Portfolio_ID) {
       
        $result = mysql_query("DELETE FROM `equityserverdb`.`my_portfolio` WHERE `Portfolio_ID` = '$Portfolio_ID'");
		
        // check for successful deletion
        if ($result) {
			
			return true;
        } else {
            return false;
        }
    }
	 
	
	  /**
	   * Adds an entry into the my_watchlist table in the database
	   */
	   public function addEntryToMyWatchlist($email,$share_listing_id) {
       
        $result = mysql_query("INSERT INTO my_watchlist(Email,Share_Listing_ID) VALUES('$email', '$share_listing_id')");
		
        // check for successful store
        if ($result) {

            //$result = mysql_query("SELECT * FROM users WHERE username = $username");
            // return user details
			return true;
            return mysql_fetch_array($result);
        } else {
            return false;
        }
    }
	
	  /**
	   * Adds an entry into the my_portfolio table
	   */
	   public function addMyPortfolioEntry($company_name,$no_of_shares,$share_price,$share_listing_id,$email) {
       
        $result = mysql_query("INSERT INTO my_portfolio(Company_Name,No_Of_Shares,Share_Price,Share_Listing_ID) VALUES('$company_name', '$no_of_shares','$share_price','$share_listing_id')");
		
        // check for successful store
        if ($result) {

            //$result = mysql_query("SELECT * FROM users WHERE username = $username");
            // return user details
            //return mysql_fetch_array($result);
			return true;
        } else {
            return false;
        }
    }
	
	/*
	 *####################################################################################################################################################################
	 *													
	 *														Methods for Android Server.
	 *
	 *####################################################################################################################################################################
	 */
	 
	 /*
	  * This function logs in an Admin User to the Server Application.
	  */
	public function adminLogin($username, $password) {
        $result = mysql_query("SELECT * FROM administrators WHERE Username = '$username' AND Password = '$password'") or die(mysql_error());
        // check for result
        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
			//user exists and username-password pair matches
            return $result;
        } else {
            //user not found
            return false;
        }
    }
	
	  /**
	   * Signs up a android user into the system
	   *
	   * Note: This method is not safe and should be used for testing purposes
	   * Returns user details
	   */
	   public function signUpAndroidUser($name,$email,$password,$date_of_birth, $gender) {
       
        $result = mysql_query("INSERT INTO users_android(Name,Email,Password,Date_Of_Birth,Gender) VALUES('$name', '$email','$password','$date_of_birth','$gender')");
        // check for successful store
        if ($result) {

            //$result = mysql_query("SELECT * FROM users_android WHERE Email = $email");
            // return user details
            //return mysql_fetch_array($result);
			return true;
        } else {
            return false;
        }
    }
	
	/**
	 * Adds an Exxchange Rate entry into the database
	 */
	public function addExchangeRate($currency,$buying_rate,$selling_rate) {
       
        $result = mysql_query("INSERT INTO exchange_rates(Currency,Buying_Rate,Selling_Rate) VALUES('$currency', '$buying_rate','$selling_rate')");
        // check for successful store
        if ($result) {
			return $result;
        } else {
            return false;
        }
    }
	
	/**
	 * Add a Fixed deposit entry into the database
	 */
	public function addFixedDepositRate($range_from, $range_to,$one_month,$three_month,$six_month,$one_year) {
       
        $result = mysql_query("INSERT INTO fixed_deposit_rates(Range_From,Range_To,One_Month_Pa,Three_Month_Pa,Six_Month_Pa,One_Year_Pa) VALUES('$range_from', '$range_to','$one_month','$three_month','$six_month','$one_year')");
        // check for successful store
        if ($result) {
			return true;
        } else {
            return false;
        }
    }
	
	
	/**
	 * Adds a new sharelisting entry into the database///buggy..............................................................
	 */
	public function addShareListingEntry($company_name,$last_traded_price,$previous_price,$change) {
       
        $result = mysql_query("INSERT INTO `equityserverdb`.`all_share_listings`(`Company_Name`,`Last_Traded_Price`,`Previous_Price`,`Change`) VALUES('$company_name', '$last_traded_price','$previous_price','$change')");
		
        // check for successful store
        if ($result) {
			return true;
        } else {
            return false;
        }
    }
	
	/**
	 * Adds a new Administrator into the database.
	 */
	 public function  administratorSignUp($username,$password,$national_id_number,$name) {
       
        $result = mysql_query("INSERT INTO administrators(Username, National_ID_No,Password, Name) VALUES('$username','$national_id_number','$password','$name')");
		
        //check for successful store
        if($result) {
			return true;
        } else {
            return false;
        }
    }
	
	/**
	 * Adds a new advert into the database
	 */
	public function addNewAdvert($advert,$ad_url,$ad_category) {
       
        $result = mysql_query("INSERT INTO `equityserverdb`.`adverts`(`Advert`, `Ad_URL`,`ad_category`) VALUES('$advert', '$ad_url','$ad_category')");
		
        // check for successful store
        if ($result) {
			return true;
        } else {
            return false;
        }
    }
 
}//end  of class
 
?>