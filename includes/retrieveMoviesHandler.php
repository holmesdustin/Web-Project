<?php

if (isset($_POST["search"])) {
    searchByKeyword($_POST["search"]);
};

/**
 * This Function is used to get search result from a specific URL
 */
function searchByKeyword($keyword)
{
    $originalKeyword = $keyword;
    require('config.php');
    $keyword = parseKeyword($keyword);
    $url = "http://www.omdbapi.com/?apikey=" . config('omdb_api_key') . "&s=" . $keyword;
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
    if ($response['Response'] == 'False') {
        echo '<div class="col-xs-12 col-sm-12 col-lg-12"><h4 class="text-center"><i class="fas fa-sad-cry fa-lg"></i>&nbsp;Sorry, we couldn\'t find any result on the keyword: \'' . $originalKeyword . '\'.</h4></div>';
        echo '<div class="col-xs-12 col-sm-12 col-lg-12"><hr class="my-4"><br></div>'; // add a line to seperate search bar and result content
    } else {
        $result_num = sizeof($response["Search"]);

        for ($x = 0; $x < $result_num; $x++) {
            echo '<div class="col-xs-12 col-sm-6 col-lg-4 col-xl-3">';
            echo '<div class="card shadow text-center" style="border-radius: 20px; height: 90%;">';
            getDetailsByID($response["Search"][$x]["imdbID"]);
            echo '</div>';
            echo '<div style="height: 10%;">';
            echo '<br><hr class="my-4" ><br>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }

        echo '<div class="col-xs-12 col-sm-12 col-lg-12"><p class="text-center" style="color: #888;">You\'ve reached the end of results.</p><br></div>';
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
    for ($x = 0; $x < sizeof($keywordPieces) - 1; $x++) {
        if ($keywordPieces[$x] != "") {
            $keyword = $keyword . $keywordPieces[$x] . "+";
        }
    }
    $keyword = $keyword . $keywordPieces[sizeof($keywordPieces) - 1];
    return $keyword;
}

/*
 * This function is used for more detail about the movie by searching its imdbID
*/
function getDetailsByID($id)
{
    $url = "http://www.omdbapi.com/?apikey=" . config('omdb_api_key') . "&i=" . $id;
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
    echo '<img class="card-img-top img-fluid" style="height: 60%; border-radius: 20px 20px 0px 0px;" src="' . ($response["Poster"] == 'N/A' ? '../template/assets/images/nopicture.JPG' : $response["Poster"]) . '" alt="Poster of Movie">';
    echo '<div class="card-body" style="height: 40%;">';
    echo '<h5 class="card-title my-0" style="height: 15%;">' . $response["Title"] . ' - ' . $response["Year"] . '</h5>';
    $plot = $response["Plot"];

    echo '<p class="card-text my-0" style= "height: 65%;">' . formatPlot($plot) . '</p>';
    echoDetailModal($response);
    echo '</div>';
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
    echo '<div style="height: 20%;">';
    echo '<button type="button" class="btn btn-dark btn-lg" data-toggle="modal" data-target="#modalForID' . $imdbID . '">Read More</button>';
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
    echo '</div>';
}
/**
 * Make the plot length consistent to beatify the card
 *
 * @return string
 */
function formatPlot($plot)
{
    $maxCharacter = 160;
    if (strlen($plot) >= $maxCharacter) {
        return substr($plot, 0, $maxCharacter) . '...';
    } else {
        $diff = $maxCharacter - strlen($plot) + 3;
        for ($i = 0; $i < $diff; $i++) {
            $plot = $plot . ' &numsp;';
        }
        return $plot;
    }
}
