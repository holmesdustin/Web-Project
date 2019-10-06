<!-- Banner -->
<section id="banner">
	<div class="inner">
		<h1>OMDb Movie Search Engine<br>
			created by Team Gao</h1>

		<div class="input-group md-form form-sm form-2 pl-0">
			<input class="form-control" style="font-size:unset; border-right-color: transparent;" id="inputKey" type="text" placeholder="Search Movies by Title, Keyword..." aria-label="Search">
			<button type="button" style="border-left-color: transparent;" id="button"><i class="fas fa-search fa-lg" aria-hidden="true"></i></button>
		</div>

	</div>
</section>
<div id="result_showed" class="container-fluid relative row"></div>

<script>
	var input = document.getElementById("inputKey");
	input.addEventListener("keyup", function(event) {
		if (event.keyCode === 13) {
			event.preventDefault();
			document.getElementById("button").click();
		}
	});
</script>

