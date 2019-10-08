<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

if (isset($_POST["search"])) {
    searchByKeyword($_POST["search"]);
};

if (isset($_POST["firstName"])) {
    emailTeamMessage($_POST["firstName"], $_POST["lastName"], $_POST["email"], $_POST["message"]);
};

/**
 * This function is used to send the team member message about feedback
 *
 * @param [type] $firstName
 * @param [type] $lastName
 * @param [type] $email
 * @param [type] $message
 * @return void
 */
function emailTeamMessage($firstName, $lastName, $email, $message)
{
    $mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'noreply.teamgao@gmail.com';            // SMTP username
    $mail->Password   = 'P@ssw0rdtoor';                               // SMTP password
    $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('noreply.teamgao@gmail.com', 'Team Gao');
    $mail->addAddress('gao_yujing@columbusstate.edu', 'Yujing Gao');     // Add a recipient
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Thank you! Your message has been sent to our team.';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}

/**
 * This Function is used to get search result from a specific URL
 */
function searchByKeyword($keyword)
{
    $originalKeyword = $keyword;
    require('config.php');
    //$keyword = trim($keyword); //Strip whitespace (or other characters) from the beginning and end of a string
    //$keyword = str_replace(" ", "+", $keyword);
    $keyword = parseKeyword($keyword);
    $url = "http://www.omdbapi.com/?apikey=" . config('api_key') . "&s=" . $keyword;
    $handle = curl_init();
    curl_setopt($handle, CURLOPT_URL, $url);
    curl_setopt_array(
        $handle,
        array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
        )
    );
    $output = curl_exec($handle);
    $response = json_decode($output, true);
    echo '<div class="col-xs-12 col-sm-12 col-lg-12"><br><hr class="my-4"><br></div>'; // add a line to seperate search bar and result content
    if ($response['Response'] == 'False') {
        echo '<div class="col-xs-12 col-sm-12 col-lg-12"><h4 class="text-center"><i class="fas fa-sad-cry fa-lg"></i>&nbsp;Sorry, we couldn\'t find any result on the keyword: \'' . $originalKeyword . '\'.</h4></div>';
        echo '<div class="col-xs-12 col-sm-12 col-lg-12"><hr class="my-4"><br></div>'; // add a line to seperate search bar and result content
    } else {
        $result_num = sizeof($response["Search"]);

        for ($x = 0; $x < $result_num; $x++) {
            //echo $x % 4 == 0 ? '<div class="col-xs-12 col-sm-12 col-lg-12"><br><hr class="my-4"><br></div>' : ''; // add break lines 
            echo '<div class="col-xs-12 col-sm-6 col-lg-3">';
            echo '<div class="card text-center" style="width: 100%; height: 90%; border-radius: 20px;">';
            getDetailsByID($response["Search"][$x]["imdbID"]);
            echo '</div>';
            echo '</div>';
            echo '<br><hr class="my-4"><br>';
            echo '</div>';
        }

        echo '<div class="col-xs-12 col-sm-12 col-lg-12"><p class="text-center">You\'ve reached the end of results.</p><br></div>';
    }

    curl_close($handle);
}

/**
 * This function is used to parse keyword input
 */
function parseKeyword($keyword)
{
    $keyword = trim($keyword);
    $keywordPieces = explode(" ", $keyword);
    $keyword = "";
    for ($x = 0; $x < sizeof($keywordPieces)-1; $x++) {
        if ($keywordPieces[$x] != "")
        {
            $keyword = $keyword . $keywordPieces[$x] . "+";
        }
        
    }
    $keyword = $keyword . $keywordPieces[sizeof($keywordPieces)-1];
    return $keyword;
}

/*
 * This function is used for more detail about the movie by searching its imdbID
*/
function getDetailsByID($id)
{
    $url = "http://www.omdbapi.com/?apikey=" . config('api_key') . "&i=" . $id;
    $handle = curl_init();
    curl_setopt($handle, CURLOPT_URL, $url);
    curl_setopt_array(
        $handle,
        array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
        )
    );
    $output = curl_exec($handle);
    $response = json_decode($output, true);
    echo '<img class="card-img-top img-fluid" style="height: 70%; width: auto; border-radius: 20px 20px 0px 0px;" src="' . ($response["Poster"] == 'N/A' ? '../template/assets/images/nopicture.JPG' : $response["Poster"]) . '" alt="Poster of Movie">';
    echo '<div class="card-body">';
    echo '<h5 class="card-title">' . $response["Title"] . ' - ' . $response["Year"] . '</h5>';
    $plot = $response["Plot"];

    echo '<p class="card-text">' . formatPlot($plot) . '</p>';
    echoDetailModal($response);
}

/**
 * This function is used for echoing the detail modal 
 *
 * @return void
 */
function echoDetailModal($response)
{
    $imdbID = $response['imdbID'];
    $title = $response['Title'];
    $released = $response['Released'];
    $plot = $response['Plot'];
    $rated = $response['Rated'];
    $director = $response['Director'];
    $actors = $response['Actors'];
    $country = $response['Country'];
    $genre = $response['Genre'];

    echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalForID' . $imdbID . '">Read More</button>';
    echo '<div class="modal fade" id="modalForID' . $imdbID . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center">' . $title . '</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 text-left mb-2"><b>Released: &nbsp;</b>' . $released . '</div>
                    <div class="col-12 text-left mb-2"><b>Rated: &nbsp;</b>' . $rated . '</div>
                    <div class="col-12 text-left mb-2"><b>Genre: &nbsp;</b>' . $genre . '</div>
                    <div class="col-12 text-left mb-2"><b>Director: &nbsp;</b>' . $director . '</div>
                    <div class="col-12 text-left mb-2"><b>Actors: &nbsp;</b>' . $actors . '</div>
                    <div class="col-12 text-left mb-2"><b>Country: &nbsp;</b>' . $country . '</div>
                    <div class="col-12 text-left mb-2"><b>Plot: &nbsp;</b>' . $plot . '</div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>';
}
/**
 * Make the plot length consistent to beatify the card
 *
 * @return string
 */
function formatPlot($plot)
{
    $maxCharacter = 160;
    while (strlen($plot) < $maxCharacter) {
        $plot = $plot . ' ';
    }
    $plotBrief = strlen($plot) > $maxCharacter ? substr($plot, 0, $maxCharacter) . ' ...' : $plot;
    return $plotBrief;
}
/**
 * Displays site name.
 */
function site_name()
{
    echo config('name');
}


/**
 * Displays site url provided in conig.
 */
function site_url()
{
    echo config('site_url');
}

/**
 * Displays site version.
 */
function site_version()
{
    echo config('version');
}

/**
 * Website navigation.
 */
function nav_menu()
{
    $nav_menu = '';
    $nav_items = config('nav_menu');
    foreach ($nav_items as $uri => $name) {
        $class = '';
        if (isset($_SERVER['QUERY_STRING'])) {
            $class = str_replace('page=', '', $_SERVER['QUERY_STRING']) == $uri ? 'active' : '';
        }
        $url = config('site_url') . '/' . (config('pretty_uri') || $uri == '' ? '' : '?page=') . $uri;
        $icon = $name == 'Trending' ? '<i class="fas fa-hat-wizard"></i>' : ($name == 'About Us' ? '<i class="fas fa-users"></i>' : ($name == 'Contact Us' ? '<i class="fas fa-paper-plane"></i>' : '<i class="fab fa-fort-awesome"></i>'));
        $nav_menu .= '<li class="nav-item ' . $class . '"> <a href="' . $url . '" title="' . $name . '" class="nav-link ' . '">' . $icon . '&nbsp;&nbsp;' . $name . '</a>' . '</li>';
    }
    echo trim($nav_menu);
}

/**
 * Displays page title. It takes the data from
 * URL, it replaces the hyphens with spaces and
 * it capitalizes the words.
 */
function page_title()
{
    $page = isset($_GET['page']) ? htmlspecialchars($_GET['page']) : 'Home';
    echo ucwords(str_replace('-', ' ', $page));
}

/**
 * Displays page content. It takes the data from
 * the static pages inside the pages/ directory.
 * When not found, display the 404 error page.
 */
function page_content()
{
    $page = isset($_GET['page']) ? $_GET['page'] : 'home';
    $path = getcwd() . '/' . config('content_path') . '/' . $page . '.php';
    if (!file_exists($path)) {
        $path = getcwd() . '/' . config('content_path') . '/404.php';
    }
    // echo file_get_contents($path);
    require config('content_path') . '/' . $page . '.php';
}

/**
 * Starts everything and displays the template.
 */
function init()
{
    require config('template_path') . '/template.php';
}
