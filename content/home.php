<!-- Banner -->
<section id="banner">
	<div class="inner">
		<h1>OMDb Movie Search Engine<br>
			Created by Team Gao</h1>

		<div class="input-group md-form form-sm form-2 pl-0">
			<input class="form-control" style="font-size:unset; border-right-color: transparent;" id="inputKey" type="text" placeholder="Search Movies by Title, Keyword..." aria-label="Search">
			<button type="button" style="border-left-color: transparent;" id="button"><i class="fas fa-search fa-lg" aria-hidden="true"></i></button>
		</div>

		<br><br><br>
		<h3 style="color: #9c9c9c;">
			Supported By: &nbsp;&nbsp;<i class="fab fa-php"></i> &nbsp;&nbsp;&nbsp;<i class="fab fa-js-square"></i>&nbsp;&nbsp;&nbsp;
			<i class="fab fa-bootstrap"></i>&nbsp;&nbsp;&nbsp;<i class="fab fa-css3-alt"></i>
			&nbsp;&nbsp;&nbsp;<i class="fas fa-code"></i>
		</h3>
	</div>
</section>

<div id="result_loading" class="container-fluid relative row" style="display: none;">
	<div class="container">
		<br>
		<hr class="my-4">
		<h2 class="text-center">Loading Results...</h2>
		<div class="progress">
			<div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">
				<span class="sr-only">70% Complete</span>
			</div>
		</div>
		<br>
		<hr class="my-4">
		<br>
	</div>
</div>

<div id="result_showed" class="container-fluid relative row">
	
</div>

<script>
	var input = document.getElementById("inputKey");
	input.addEventListener("keyup", function(event) {
		if (event.keyCode === 13) {
			event.preventDefault();
			document.getElementById("button").click();
		}
	});
</script>