<section id="banner">
	<div class="inner">
		<h1>Team Gao Movie Search Engine<br />
			Powered by OMDb</h1>

		<div class="input-group md-form form-sm form-2 pl-0">
			<input class="form-control" style="font-size:unset; border-right-color: transparent;" id="inputKey" type="text" placeholder="Search Movies by Title, Keyword..." aria-label="Search" />
			<button type="button" style="border-left-color: transparent;" id="button"><i class="fas fa-search fa-lg" aria-hidden="true"></i></button>
		</div>

		<br /><br /><br />
		<h3 style="color: #9c9c9c;">
			Supported By: &nbsp;&nbsp;<i class="fab fa-php"></i> &nbsp;&nbsp;&nbsp;<i class="fab fa-js-square"></i>&nbsp;&nbsp;&nbsp;
			<i class="fab fa-bootstrap"></i>&nbsp;&nbsp;&nbsp;<i class="fab fa-css3-alt"></i>
		</h3>
	</div>
</section>

<div id="result_loading" class="container relative" style="display: none;">
	<br />
	<hr class="my-4">
	<div class="row justify-content-center">
		<div class="col-2">
			<div class="spinner"></div>
		</div>
		<div class="col-2">
			<div class="spinner"></div>
		</div>
		<div class="col-2">
			<div class="spinner"></div>
		</div>
		<div class="col-12">
		<h2 class="text-center">Loading Results...</h2>
		</div>
		
	</div>

	<br />
	<hr class="my-4">
	<br />

</div>

<div id="result_showed" class="container-fluid relative row">

</div>
<a id="back-to-top" href="#" class="back-to-top" role="button"><i class="fas fa-chevron-circle-up fa-3x"></i></a>
<script>
	var input = document.getElementById("inputKey");
	input.addEventListener("keyup", function(event) {
		if (event.keyCode === 13) {
			event.preventDefault();
			document.getElementById("button").click();
		}
	});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.5.0/lottie.js" type="text/javascript"></script>
<script>
	var loader = document.getElementsByClassName("spinner");

	function loadBMAnimation(loader) {
		var animation = bodymovin.loadAnimation({
			container: loader,
			renderer: "svg",
			loop: true,
			autoplay: true,
			path: "https://gist.githubusercontent.com/YujingGao96/bb86846950ec53511a0f6ebc090f655f/raw/c6a7cd7a593869da98a1ad0c80de10694270dce3/fidget-spinner.json"
		});
	}

	for (var i = 0; i < loader.length; i++) {
		loadBMAnimation(loader[i]);
	}
</script>
